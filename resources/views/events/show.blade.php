@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{ $event->title }}</h3>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Start Time:</strong>
                                {{ $event->start_time->translatedFormat('d M Y H:i') }}
                            </div>
                            <div class="col-md-6">
                                <strong>End Time:</strong>
                                {{ $event->end_time->translatedFormat('d M Y H:i') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>Description:</strong>
                            <p class="mb-0">{{ $event->description }}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <strong>Location:</strong> {{ $event->location }}
                            </div>
                            <div class="col-md-6">
                                <strong>Category:</strong>
                                <span class="badge" style="background-color: {{ $event->category->color ?? '#6c757d' }}">
                                    {{ $event->category->name ?? 'No Category' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">
                            Back to List
                        </a>
                        <div class="btn-group">
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-primary">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection