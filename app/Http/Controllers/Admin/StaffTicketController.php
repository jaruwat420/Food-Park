<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\TicketsDataTable;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TicketsDataTable $dataTable)
    {
        // return view ('staff.tickets.index');
        return $dataTable->render ('staff.tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $ticket = Ticket::find($id);

            $status = TicketStatus::select('id', 'name', 'label')->get();

            $staffs = User::where('role', 'staff')
                        ->select('id', 'name')
                        ->get();

            $priorities = [
                ['value' => 'low', 'label' => 'ต่ำ'],
                ['value' => 'medium', 'label' => 'ปานกลาง'],
                ['value' => 'high', 'label' => 'สูง']
            ];

            return response()->json([
                'ticket' => $ticket,
                'staffs' => $staffs,
                'status' => $status,
                'priorities' => $priorities
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error('Ticket update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {

            DB::beginTransaction();

            // ตรวจสอบ status
            $status = TicketStatus::where('name', $request->status_id)
                ->select('id', 'name')
                ->first();

            if (!$status) {
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบสถานะที่ระบุ'
                ], 400);
            }

            // หา ticket
            $ticket = Ticket::where('id', $request->ticket_id)->first();
            if (!$ticket) {
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบ Ticket'
                ], 404);
            }

            // เก็บค่าเดิม
            $oldStatusId = $ticket->status_id;

            // อัพเดท ticket
            $ticket->update([
                'status_id' => $status->id,
                'priority' => $request->priority,
                'assigned_to' => $request->assigned_to
            ]);


            if ($oldStatusId != $status->id) {
                $ticket->history()->create([
                    'user_id' => Auth::id() ?? null,
                    'changed_field' => 'status_id',
                    'old_value' => $oldStatusId,
                    'new_value' => $status->id
                ]);
            }

            // บันทึก Comment แยกต่างหาก
            if ($request->filled('ticket_comment')) {
                Comment::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => Auth::id() ?? null,
                    'content' => $request->ticket_comment
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'อัพเดทข้อมูลสำเร็จ'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function view (string $id)
    {
        try {
            $ticket = Ticket::with([
                'status',
                'category',
                'location',
                'department',
                'attachments',
                'comments'
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'ticket' => $ticket,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }
}
