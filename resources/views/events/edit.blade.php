@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Event: {{ $event->title }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('events.update', $event) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $event->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    rows="3">{{ old('description', $event->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                                        value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="end_time" class="form-label">End Time</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                        value="{{ old('end_time', $event->end_time->format('Y-m-d\TH:i')) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    value="{{ old('location', $event->location) }}">
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection