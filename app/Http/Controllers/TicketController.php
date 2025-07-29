<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\TicketCreated;
use App\Notifications\TicketReplied;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index() {}

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'priority' => $request->priority,
        ]);

        // Notify all admins
        User::where('role', 'admin')->get()->each(function ($admin) use ($ticket) {
            $admin->notify(new TicketCreated($ticket));
        });

        return redirect()->route('dashboard')->with('success', 'Ticket submitted successfully.');
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id != Auth::id()) {
            abort(403);
        }

        // ✅ Mark related unread notifications as read
        auth()->user()->unreadNotifications
            ->where('data.ticket_id', $ticket->id)
            ->markAsRead();

        $comments = $ticket->comments()->latest()->get();
        return view('tickets.show', compact('ticket', 'comments'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate(['message' => 'required']);

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Notify all admins
        User::where('role', 'admin')->get()->each(function ($admin) use ($ticket) {
            $admin->notify(new TicketReplied($ticket));
        });


        return back()->with('success', 'Reply sent.');
    }
}
