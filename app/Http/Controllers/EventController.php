<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $event = Event::create(
            [
                ...$request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'start_event' => 'required|date',
                    'end_event' => 'required|date|after:start_event'
                ]),
                'user_id' => 1
            ]

        );
        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->update([
            ...$request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'start_event' => 'sometimes|date',
                'end_event' => 'sometimes|date|after:start_event'
            ])
        ]);
        return $event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response(status: 204);
    }
}
