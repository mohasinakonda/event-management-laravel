<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "start_event" => $this->start_event,
            "end_event" => $this->end_event,
            "user" => new UserResource($this->whenLoaded('user')),
            "attendees" => AttendeeResource::collection($this->whenLoaded('attendees'))
        ];
    }
}
