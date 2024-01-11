<?php

namespace App\Http\Controllers;


use App\Http\Resources\EventResource;
use App\Http\Traits\CanLoadRelations;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use CanLoadRelations;
    protected array $relations = ['user', 'attendees', 'attendees.user'];
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }

    public function index()
    {
        $query = $this->loadRelation(Event::query());
        return EventResource::collection($query->latest()->paginate());

    }


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
                'user_id' => $request->user()->id
            ]

        );
        return new EventResource($this->loadRelation($event));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // $event->load('user', 'attendees');
        return new EventResource($this->loadRelation($event));
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
        return new EventResource($this->loadRelation($event));
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
