<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Ticket;
use App\Models\TicketStatus;
use Auth;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index (Request $request)
    {
        $user = Auth::user();

        return view ('frontend.ticket.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tickets = Ticket::with(['status'])->latest()->get();
        return view ('admin.ticket.create', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            dd($request->all());
            $validated = $request->validate([
                'inputProblem' => 'required',
                'inputSubjectID' => 'required',
                'inputDetail' => 'required',
                'inputSubjectLocation' => 'required',
                'inputSubjectDepartment' => 'required',
            ]);

            $defaultStatus = TicketStatus::where('name', 'new')->first();

            if (!$defaultStatus) {
                $defaultStatus = TicketStatus::create([
                    'name' => 'new',
                    'label' => 'ใหม่',
                    'color' => 'primary',
                    'order' => 1
                ]);
            }

            // Create ticket
            $ticket = Ticket::create([
                'title' => $request->inputSubjectID,
                'description' => $request->inputDetail,
                'user_id' => Auth::id(),
                'category_id' => $request->inputProblem,
                'status_id' => $defaultStatus->id,
                'priority' => 'normal',
                'assigned_to' => null
            ]);

            // Create history
            $ticket->history()->create([
                'user_id' => Auth::id(),
                'action' => 'created',
                'description' => 'Ticket was created'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully',
                'ticket' => $ticket->load('category', 'status'),
                'redirect_url' => route('tickets.show', $ticket->id)
            ]);

        } catch (\Exception $e) {
            \Log::error('Ticket creation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error creating ticket: ' . $e->getMessage()
            ], 500);
        }
    }

    private function sendNotificationEmail($ticket)
    {
        Mail::to($ticket->user->email)->send(new TicketCreated($ticket));

        $itTeamEmail = config('mail.it_team');
        Mail::to($itTeamEmail)->send(new NewTicketNotification($ticket));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', [
            'ticket' => $ticket->load([
                'user',
                'category',
                'status',
                'assignedTo',
                'comments.user',
                'attachments',
                'history.user'
            ])
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

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status_id' => 'required|exists:ticket_statuses,id'
        ]);

        $oldStatus = $ticket->status->name;
        $newStatus = TicketStatus::find($request->status_id)->name;

        $ticket->update([
            'status_id' => $request->status_id
        ]);

        $ticket->history()->create([
            'user_id' => Auth::id(),
            'action' => 'status_updated',
            'description' => "Status changed from {$oldStatus} to {$newStatus}"
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

        $ticket->update([
            'assigned_to' => $request->assigned_to
        ]);

        $ticket->history()->create([
            'user_id' => Auth::id(),
            'action' => 'assigned',
            'description' => "Ticket assigned to " . $ticket->assignedTo->name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket assigned successfully'
        ]);
    }
}
