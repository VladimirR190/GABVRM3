@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Календарь событий</h3>
                        <div class="btn-group">
                            <a href="{{ route('events.create') }}" class="btn btn-success">Добавить событие</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: @json($events),
                    eventContent: function (info) {
                        return {
                            html: `
                            <div class="fc-event-main-frame">
                                <div class="fc-event-title-container">
                                    <div class="fc-event-title">${info.event.title}</div>
                                    ${info.event.extendedProps.description ?
                                    `<div class="text-muted small">${info.event.extendedProps.description}</div>` : ''}
                                </div>
                            </div>
                        `
                        };
                    },
                    locale: 'ru',
                    firstDay: 1,
                    editable: true,
                    eventResizableFromStart: true,
                    selectable: true,
                    navLinks: true
                });

                calendar.render();
            });
        </script>
    @endpush
@endsection