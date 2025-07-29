<x-app-layout>
    <div class="container">
        <h2>Manage Ticket</h2>
        <form method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Internal Remarks</label>
                <textarea name="internal_remarks" class="form-control">{{ $ticket->internal_remarks }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update Ticket</button>
        </form>
    </div>
</x-app-layout>
