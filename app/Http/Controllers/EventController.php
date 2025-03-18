<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = auth()->user()->events()->with('category')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $categories = auth()->user()->categories;
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        auth()->user()->events()->create($request->all());
        return redirect()->route('events.index');
    }

    public function show(Event $event)
    {
        $this->authorize('view', $event);
        $event->load('category');
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        $categories = auth()->user()->categories;
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'nullable|string'
        ]);

        $event->update($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event updated successfully');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully');
    }

    public function calendar($view = 'month')
    {
        $events = auth()->user()->events()
            ->with('category')
            ->get()
            ->map(function ($event) {
                return [
                    'title' => $event->title,
                    'start' => $event->start_time,
                    'end' => $event->end_time,
                    'color' => $event->category->color,
                    'description' => $event->description,
                    'location' => $event->location
                ];
            });

        return view('calendar', [
            'view' => $view,
            'events' => $events
        ]);
    }
}
