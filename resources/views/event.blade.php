@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ $event->title }}</h1>
        <p class="h5">{{ $event->text }}</p>
        <p class="h6">{{ $event->created_at }}</p>
    </div>

    <div class="container-fluid">
        <h1 class="text-black-50">Participants</h1>
        @foreach($userevents as $user)
            <a class="h5" href="{{ route('user.info', $user->user->id) }}">{{ $user->user->name }} {{ $user->user->surname }}</a> <br>
        @endforeach
    </div>

    <div class="container-fluid">
        @if($flag)
            <form method="POST" action="{{ route('event.reject') }}">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <button class="btn btn-primary">Reject to participate</button>
            </form>
        @else
            <form method="POST" action="{{ route('event.accept') }}">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <button class="btn btn-primary">Accept part</button>
            </form>
        @endif
    </div>
@endsection
