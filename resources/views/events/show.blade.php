@extends('layouts.app')
@section('title', $event->title)

@section('content')
    <h1>{{ $event->title }}</h1>
    <p><strong>Description:</strong> {{ $event->description }}</p>
    <p><strong>Location:</strong> {{ $event->location }}</p>
    <p><strong>Start:</strong> {{ $event->start_time }}</p>
    <p><strong>End:</strong> {{ $event->end_time }}</p>
    @if ($weather && isset($weather['main']))
        <div class="mt-4">
            <h4>Weather in {{ $event->location }}</h4>
            <p><strong>Temperature:</strong> {{ $weather['main']['temp'] }} °C</p>
            <p><strong>Condition:</strong> {{ $weather['weather'][0]['description'] }}</p>
            <p><strong>Humidity:</strong> {{ $weather['main']['humidity'] }}%</p>
        </div>
    @else
        <p>Weather data not available for this location.</p>
    @endif

    @auth
    <form method="POST" action="{{ route($event->isFavoritedBy(auth()->user()) ? 'favorites.destroy' : 'favorites.store', $event) }}" class="mb-3">
        @csrf
        @if ($event->isFavoritedBy(auth()->user()))
            @method('DELETE')
            <button type="submit" class="btn btn-outline-warning">★ Unfavorite</button>
        @else
            <button type="submit" class="btn btn-outline-secondary">☆ Add to Favorites</button>
        @endif
    </form>
    <form method="POST" action="{{ route('comments.store', $event) }}" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="comment" class="form-label">Leave a Comment:</label>
            <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
            @error('comment') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Post Comment</button>
    </form>
        
    @auth
        @if ($event->user_id === auth()->id())
            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Edit Event</a>
        @endif
    @endauth
        
    @endauth



    <h4>Comments ({{ $event->comments->count() }})</h4>
    @forelse ($event->comments as $comment)
        <div class="border rounded p-3 mb-2">
            <p class="mb-1">{{ $comment->comment }}</p>
            <small class="text-muted">By {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y H:i') }}</small>
        </div>


        @if (auth()->id() === $comment->user_id)
            <button class="btn btn-sm btn-outline-secondary mt-2" onclick="document.getElementById('edit-form-{{ $comment->id }}').classList.toggle('d-none')">Edit</button>

            
            <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger mt-2" onclick="return confirm('Delete this comment?')">Delete</button>
            </form>

        
            <form id="edit-form-{{ $comment->id }}" method="POST" action="{{ route('comments.update', $comment) }}" class="mt-2 d-none">
                @csrf
                @method('PUT')
                <textarea name="comment" class="form-control mb-2" rows="2" required>{{ $comment->comment }}</textarea>
                <button type="submit" class="btn btn-sm btn-primary">Update</button>
            </form>
        @endif

        
        @empty
            <p>No comments yet.</p>
    @endforelse
@endsection
