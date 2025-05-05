<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:300',
            'description' => 'nullable|string',
            'location' => 'required|string|max:300',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);
    
        $event = new Event($validated);
        $event->user_id = Auth::id();
        $event->save();
    
        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
{
    $weather = null;
    $apiKey = env('OPENWEATHER_KEY'); // You can also use config('services.openweather.key') if you want

    if ($event->location) {
        $params = [
            'q' => $event->location,
            'appid' => $apiKey,
            'units' => 'metric',
        ];

        $url = 'https://api.openweathermap.org/data/2.5/weather?' . http_build_query($params);

        $response = Http::get($url);

        if ($response->successful()) {
            $weather = $response->json();
        }
    }

    return view('events.show', compact('event', 'weather'));
}


    public function edit(Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $event->update($validated);

        return redirect()->route('events.show', $event)->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}
