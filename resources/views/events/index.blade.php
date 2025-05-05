@extends('layouts.app')
@section('title', 'All Events')

@section('content')
<h1>All Events</h1>

@forelse($events as $event)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">{{ $event->title }}
                @auth
                    <form method="POST" action="{{ route($event->isFavoritedBy(auth()->user()) ? 'favorites.destroy' : 'favorites.store', $event) }}">
                        @csrf
                        @if($event->isFavoritedBy(auth()->user()))
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0" title="Unfavorite">
                                ⭐
                            </button>
                        @else
                            <button type="submit" class="btn btn-link p-0" title="Favorite">
                                ☆
                            </button>
                        @endif
                    </form>
                @endauth
            </h5>
            <p class="card-text">{{ $event->description }}</p>

            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Event</a>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Time:</strong> {{ $event->start_time }} - {{ $event->end_time }}</p>
        </div>
    </div>
@empty
    <p>No events found. <a href="{{ route('events.create') }}">Create one now</a>.</p>
@endforelse
@endsection
