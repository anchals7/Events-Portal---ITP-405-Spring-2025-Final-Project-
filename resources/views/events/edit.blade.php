@extends('layouts.app')
@section('title', 'Edit Event')

@section('content')
<h1>Edit Event</h1>
<form method="POST" action="{{ route('events.update', $event) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" value="{{ old('title', $event->title) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Location</label>
        <input name="location" value="{{ old('location', $event->location) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Start Time</label>
        <input type="datetime-local" name="start_time" value="{{ old('start_time', \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i')) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">End Time</label>
        <input type="datetime-local" name="end_time" value="{{ old('end_time', \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i')) }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Event</button>
</form>
@endsection
