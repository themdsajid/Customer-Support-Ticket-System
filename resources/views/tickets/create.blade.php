<x-app-layout>
    <div class="container">
        <h2>Create Ticket</h2>
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf
            <div class="mb-3">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label>Priority</label>
                <select name="priority" class="form-control">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Submit Ticket</button>
        </form>
    </div>
</x-app-layout>
