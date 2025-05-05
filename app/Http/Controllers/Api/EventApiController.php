<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventApiController extends Controller
{
    public function index()
    {
        $events = Event::select('id', 'title', 'description', 'location', 'start_time', 'end_time')->get();

        return response()->json([
            'status' => 'success',
            'data' => $events
        ]);
    }
}
