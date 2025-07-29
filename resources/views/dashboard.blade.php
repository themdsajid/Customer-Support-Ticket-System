<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (Auth::check())
        @if (Auth::user()->role === 'admin')
            @include('admin.notification')
            <div class="container mt-3">
                <h2>All Tickets</h2>

                {{-- Filter Form --}}
                <form method="GET" class="mb-4 row g-3">
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">-- Filter by Status --</option>
                            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In
                                Progress</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="user_id" class="form-control">
                            <option value="">-- Filter by User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="priority" class="form-control">
                            <option value="">-- Priority --</option>
                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium
                            </option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="from" class="form-control" value="{{ request('from') }}"
                            placeholder="From">
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="to" class="form-control" value="{{ request('to') }}"
                            placeholder="To">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>

                {{-- Ticket List --}}
                @foreach ($tickets as $ticket)
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5>
                                {{ $ticket->subject }} - <span
                                    class="badge bg-info">{{ ucfirst($ticket->status) }}</span>
                                - {{ ucfirst($ticket->priority) }}
                            </h5>
                            <p>User: {{ $ticket->user->name }} | Created: {{ $ticket->created_at->format('d M Y') }}
                            </p>
                            <a href="{{ route('admin.tickets.show', $ticket->id) }}"
                                class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('admin.tickets.edit', $ticket->id) }}"
                                class="btn btn-sm btn-primary">Manage</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(Auth::user()->role === 'user')
            @include('notification')
            <div class="container mt-3">
                <h2 class="fw-bold" style="font-size: 28px;">Your Tickets</h2>
                <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Create Ticket</a>
                @foreach ($tickets as $ticket)
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5>{{ $ticket->subject }} - <span
                                    class="badge bg-info">{{ ucfirst($ticket->status) }}</span></h5>
                            <p>{{ $ticket->description }}</p>
                            <a href="{{ route('tickets.show', $ticket->id) }}"
                                class="btn btn-sm btn-outline-primary">View</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

</x-app-layout>
