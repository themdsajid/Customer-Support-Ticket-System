<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Notifications\TicketUpdated;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {}

    public function edit(Ticket $ticket)
    {
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function show(Ticket $ticket)
    {
        auth()->user()->unreadNotifications
            ->where('data.ticket_id', $ticket->id)
            ->markAsRead();

        $comments = $ticket->comments()->latest()->get();

        return view('admin.tickets.show', compact('ticket', 'comments'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update([
            'status' => $request->status,
            'internal_remarks' => $request->internal_remarks,
        ]);

        $ticket->user->notify(new TicketUpdated($ticket));

        return redirect()->route('dashboard')->with('success', 'Ticket updated.');
    }
}
