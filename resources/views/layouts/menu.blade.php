@foreach($events as $event)
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>{{ $event->title }}</p>
        </a>
    </li>
@endforeach


