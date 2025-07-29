<!-- Notifications Dropdown -->
<li class="nav-item dropdown d-flex justify-content-center w-100 mt-3">
    <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" role="button"
        data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: 600; font-size: 16px;">
        <i class="bi bi-bell-fill fs-5 me-1 text-warning"></i>
        <span style="
    color: black;
">Notifications</span>
        <span class="badge bg-danger ms-2">
            {{ auth()->user()->unreadNotifications->count() }}
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow-lg p-2"
        style="min-width: 350px; max-height: 300px; overflow-y: auto; font-size: 14px;">
        @forelse(auth()->user()->unreadNotifications as $notification)
            <li class="mb-1">
                <a class="dropdown-item border-bottom text-dark"
                    href="{{ route('tickets.show', $notification->data['ticket_id']) }}">
                    <i class="bi bi-ticket-perforated-fill me-2 text-primary"></i>
                    <span class="text-dark">
                        {{ $notification->data['message'] ?? 'No message available' }}
                    </span>
                </a>
            </li>
        @empty
            <li><span class="dropdown-item text-muted">No new notifications</span></li>
        @endforelse
    </ul>
</li>
