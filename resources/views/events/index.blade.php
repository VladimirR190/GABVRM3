@extends('layouts.app')

@section('title', 'My Events')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h2>My Events</h2>
            <div>
                <a href="{{ route('events.create') }}" class="btn btn-primary">Create Event</a>
                <a href="{{ route('calendar.view', 'month') }}" class="btn btn-success">Calendar View</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Start Time</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->start_time->translatedFormat('d M Y H:i') }}</td>
                                <td><span class="badge"
                                        style="background-color: {{ $event->category->color }}">{{ $event->category->name }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('events.destroy', $event) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection