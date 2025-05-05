<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('event')->get();
        return view('favorites.index', compact('favorites'));
    }
    // Add event to favorites
    public function store(Request $request, Event $event)
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->event_id = $event->id;
        $favorite->save();

        return back()->with('success', 'Event added to favorites!');
    }

    // Remove event from favorites
    public function destroy(Event $event)
    {
        $favorite = Favorite::where('user_id', Auth::id())
                            ->where('event_id', $event->id)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Event removed from favorites!');
        }
    }
}
