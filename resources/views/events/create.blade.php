@extends('layouts.app')
@section('title', 'Create Event')

@section('content')
<h1>Create a New Event</h1>
<form method="POST" action="{{ route('events.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" value="{{ old('title') }}" class="form-control" required>
        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Start Time</label>
        <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
        @error('start_time') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">End Time</label>
        <input type="datetime-local" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
        @error('end_time') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Location</label>
        <input name="location" class="form-control" value="{{ old('location') }}" required>
        @error('location') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-success" type="submit">Create Event</button>
</form>
@endsection
