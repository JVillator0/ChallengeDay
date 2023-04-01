<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'department' => new DeparmentResource($this->department),
            'emission_type' => new EmissionTypeResource($this->emissionType),
            'trip_date' => $this->trip_date,
        ];
    }
}
