<p style="color: #fff">All events</p>
@foreach($events as $event)
    <li class="nav-item">
        <a href="{{ route('event.show', $event->id) }}" class="nav-link {{ request()->is('event/'.$event->id) ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>{{ $event->title }}</p>
        </a>
    </li>
@endforeach
<p style="color: #fff">My Events</p>
@foreach($events_own as $event)
    <li class="nav-item">
        <a href="{{ route('event.show', $event->id) }}" class="nav-link {{ request()->is('event/'.$event->id) ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>{{ $event->title }}</p>
        </a>
    </li>
@endforeach


