<x-app-layout>
    <div class="container">
        <h2>Ticket Details (Admin View)</h2>

        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $ticket->subject }}</h4>
                <p><strong>User:</strong> {{ $ticket->user->name }}</p>
                <p><strong>Description:</strong> {{ $ticket->description }}</p>
                <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
                <p><strong>Internal Remarks:</strong> {{ $ticket->internal_remarks ?? 'N/A' }}</p>
            </div>
        </div>

        <h4>Conversation</h4>
        @foreach ($comments as $comment)
            <div class="mb-2">
                <strong>{{ $comment->user->name }}:</strong> {{ $comment->message }}
                <div class="text-muted">{{ $comment->created_at->diffForHumans() }}</div>
            </div>
        @endforeach
    </div>
</x-app-layout>
