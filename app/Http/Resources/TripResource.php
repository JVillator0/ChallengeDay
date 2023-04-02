<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'deparment' => new DeparmentResource($this->deparment),
            'emission_type' => new EmissionTypeResource($this->emissionType),
            'trip_date' => $this->trip_date->format('Y-m-d'),
        ];
    }
}
