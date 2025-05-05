@extends('layouts.app')
@section('title', 'My Favorites')

@section('content')
<h1>My Favorited Events</h1>

@if($favorites->isEmpty())
    <p>You haven't favorited any events yet.</p>
@else
    <ul class="list-group">
        @foreach($favorites as $favorite)
            <li class="list-group-item">
                <h5>{{ $favorite->event->title }}</h5>
                <p>{{ $favorite->event->description }}</p>
                <p><strong>Location:</strong> {{ $favorite->event->location }}</p>
                <p><strong>Start:</strong> {{ $favorite->event->start_time }}</p>
                <p><strong>End:</strong> {{ $favorite->event->end_time }}</p>
            </li>
        @endforeach
    </ul>
@endif
@endsection
