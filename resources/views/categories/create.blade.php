@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Category</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <div class="input-group colorpicker">
                                    <input type="color" class="form-control form-control-color" id="color" name="color"
                                        value="#007bff" title="Choose color">
                                    <span class="input-group-text" id="colorPreview"></span>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Create Category</button>
                                <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .colorpicker {
                max-width: 200px;
            }

            .form-control-color {
                height: calc(1.5em + 1rem + 2px);
                padding: 0.5rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const colorInput = document.getElementById('color');
                const colorPreview = document.getElementById('colorPreview');

                colorInput.addEventListener('input', function () {
                    colorPreview.style.backgroundColor = this.value;
                });

                // Инициализация превью
                colorPreview.style.backgroundColor = colorInput.value;
            });
        </script>
    @endpush
@endsection