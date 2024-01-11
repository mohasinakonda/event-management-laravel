<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelations;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeesController extends Controller
{
    use CanLoadRelations;
    private array $relations = ['user'];

    public function index(Event $event)
    {

        $attendee = $this->loadRelation($event->attendees()->latest())->paginate();
        return AttendeeResource::collection($attendee);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Event $event)
    {
        $attendee = $event->attendees()->create([
            'user_id' => 1
        ]);
        return new AttendeeResource($this->loadRelation($attendee));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $event, Attendee $attendee)
    {
        return new AttendeeResource($this->loadRelation($attendee));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Attendee $attendee)
    {
        $attendee->delete();
        return response(status: 204);
    }
}
