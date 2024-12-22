<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketHistory;
use App\Models\Locations;
use App\Models\Department;
use App\Models\User;
use App\Models\Category;
use App\Models\TicketSubject;
use App\Models\Comment;
use App\Models\Attachments;
use Illuminate\Support\Facades\Storage;

use DB;
use Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index (Request $request)
    {
        // User
        $user = Auth::user();
        // Locations
        $locations = Locations::all();
        // Depart
        $departments = Department::all();
        // Category
        $categories = Category::all();
        // Subject
        $subjects = TicketSubject::all();

        return view ('frontend.ticket.index', compact('user', 'locations', 'departments', 'categories', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tickets = Ticket::with(['status'])->latest()->get();
        $locations = Locations::all();
        $departments = Department::all();
        $categories = Category::all();
        $staffs = User::staff()->get();
        $subjects = TicketSubject::where('is_active', true)
                                ->orderBy('order')
                                ->get();

        return view('frontend.ticket.create', compact(
            'locations',
            'departments',
            'categories',
            'subjects',
            'tickets',
            'staffs'
        ));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //dd($request->all());
            // Validation
            $validated = $request->validate([
                'inputProblem' => 'required',
                'subject_id' => 'required|exists:ticket_subjects,id',
                'userName' => 'required|string|max:255',
                'userEmail' => 'required|email',
                'location_id' => 'required|exists:locations,id',
                'department_id' => 'required|exists:departments,id',
                'inputDetail' => 'required|string|min:10',
                'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120'
            ]);

            $ticket = DB::transaction(function () use ($request) {
                $subject = TicketSubject::findOrFail($request->subject_id);
                $defaultStatus = TicketStatus::where('name', 'new')->firstOrFail();

                // สร้าง ticket
                $ticket = Ticket::create([
                    'title' => $subject->name,
                    'description' => strip_tags($request->inputDetail),
                    'user_name' => $request->userName,
                    'user_email' => $request->userEmail,
                    'user_id' => Auth::id(),
                    'category_id' => $request->inputProblem,
                    'status_id' => $defaultStatus->id,
                    'priority' => 'low',
                    'location_id' => $request->location_id,
                    'department_id' => $request->department_id,
                    'assigned_to' => null,
                    'ticket_id' => $this->generateTicketId(),
                    'subject_id' => $subject->id
                ]);

                if ($request->has('files')) {
                    foreach ($request->input('files') as $tempPath) {
                        $fileName = basename($tempPath);
                        $newPath = 'attachments/' . $ticket->ticket_id . '/' . $fileName;

                        Storage::makeDirectory(dirname($newPath));

                        if (Storage::disk('public')->exists($tempPath)) {
                            Storage::disk('public')->move($tempPath, $newPath);

                            $ticket->attachments()->create([
                                'file_name' => $fileName,
                                'file_path' => $newPath,
                                'file_type' => pathinfo($fileName, PATHINFO_EXTENSION)
                            ]);
                        }
                    }
                }

                // บันทึกประวัติ
                $ticket->history()->create([
                    'user_id' => Auth::id(),
                    'changed_field' => 'created',
                    'old_value' => null,
                    'new_value' => "Ticket {$ticket->ticket_id} created by " . ($request->userName ?? 'Guest')
                ]);

                return $ticket;
            });

            Storage::disk('public')->deleteDirectory('temp');

            return response()->json([
                'success' => true,
                'message' => 'สร้างคำร้องสำเร็จ',
                'ticket' => $ticket->load([
                    'user',
                    'category',
                    'status',
                    'location',
                    'department',
                    'subject',
                    'attachments'
                ]),
                'redirect_url' => route('tickets.show', $ticket->id)
            ]);

        } catch (\Exception $e) {
            \Log::error('Ticket creation error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            Storage::disk('public')->deleteDirectory('temp');

            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในการสร้างคำร้อง: ' . $e->getMessage()
            ], 500);
        }

    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status_id' => 'required|exists:ticket_statuses,id'
        ]);

        $oldStatus = $ticket->status->name;
        $newStatus = TicketStatus::find($request->status_id)->name;

        // อัพเดทสถานะ
        $ticket->update([
            'status_id' => $request->status_id
        ]);

        // บันทึกประวัติการเปลี่ยนสถานะ
        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'changed_field' => 'status',
            'old_value' => $oldStatus,
            'new_value' => $newStatus
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket status updated successfully'
        ]);
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id'
        ]);

        $oldAssignee = $ticket->assignedTo ? $ticket->assignedTo->name : null;
        $newAssignee = User::find($request->assigned_to)->name;

        // อัพเดทผู้รับผิดชอบ
        $ticket->update([
            'assigned_to' => $request->assigned_to
        ]);

        // บันทึกประวัติการมอบหมาย
        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'changed_field' => 'assigned_to',
            'old_value' => $oldAssignee,
            'new_value' => $newAssignee
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket assigned successfully'
        ]);
    }

    public function updatePriority(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'priority' => 'required|in:low,normal,high,urgent'
        ]);

        $oldPriority = $ticket->priority;

        // อัพเดทความสำคัญ
        $ticket->update([
            'priority' => $request->priority
        ]);

        TicketHistory::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'changed_field' => 'priority',
            'old_value' => $oldPriority,
            'new_value' => $request->priority
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket priority updated successfully'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * show the form for editing the specified resource.
     */
    public function show(Ticket $ticket)
    {

        $ticket->load([
            'user',
            'assigned',
            'category',
            'status',
            'location',
            'department',
            'subject'
        ]);

        return view('frontend.ticket.show', compact('ticket'));
    }

    public function getUserTickets()
    {
        $tickets = Ticket::where('user_id', Auth::id())
        ->with([
            'user',
            'status',
            'category',
            'location',
            'department'
        ])
        ->latest()
        ->get();

        return response()->json($tickets);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function generateTicketId()
    {
        $prefix = 'IT-';
        $year = date('Y');
        $month = date('m');

        $count = Ticket::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count();

        $sequence = str_pad($count + 1, 4, '0', STR_PAD_LEFT);

        return $prefix . $year . $month . '-' . $sequence;
    }

    public function detail(String $id)
    {
        $ticket = Ticket::where('id', $id)
            ->with(['category', 'status', 'location', 'department'])
            ->first();
        return view('frontend.ticket.detail', compact('ticket'));
    }

    public function storeComment(Request $request)
    {
        try {
            $request->validate([
                'content' => 'required',
                'ticket_id' => 'required|exists:tickets,id'
            ]);

            $comment = Comment::create([
                'ticket_id' => $request->ticket_id,
                'user_id' => Auth::id(),
                'content' => $request->content
            ]);

            // โหลดข้อมูล user
            $comment->load('user');

            return response()->json([
                'success' => true,
                'comment' => [
                    'user_name' => $comment->user->name ?? 'ผู้ใช้',
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->format('d/m/Y H:i')
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }
}
