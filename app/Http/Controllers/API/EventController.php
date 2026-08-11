<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Event\GetRequest;
use App\Models\Event;
use App\Services\EventServices;

class EventController extends Controller
{
    protected EventServices $eventService;

    public function __construct(EventServices $eventService)
    {
        $this->eventService = $eventService;
    }

    public function getEventData(GetRequest $request)
    {
        $events = Event::query()
            ->where('type', $request->event_type)
            ->where('model_type', $request->model_type)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Events fetched successfully',
            'data' => $events,
        ]);
    }
}
