<x-app-layout>
    <div class="container">
        <h2>Ticket Details</h2>
        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $ticket->subject }}</h4>
                <p>{{ $ticket->description }}</p>
                <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
            </div>
        </div>

        <h4>Conversation</h4>
        @foreach ($comments as $comment)
            <div class="mb-2">
                <strong>{{ $comment->user->name }}:</strong> {{ $comment->message }}
                <div class="text-muted">{{ $comment->created_at->diffForHumans() }}</div>
            </div>
        @endforeach

        <form method="POST" action="{{ route('tickets.reply', $ticket->id) }}">
            @csrf
            <div class="mb-3">
                <textarea name="message" class="form-control" rows="3" placeholder="Write your reply here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Reply</button>
        </form>
    </div>
</x-app-layout>
