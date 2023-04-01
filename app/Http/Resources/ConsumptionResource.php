<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsumptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'category_type' => new CategoryTypeResource($this->categoryType),
            'emission_type' => new EmissionTypeResource($this->emissionType),
            'place' => new PlaceResource($this->place),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'last_update' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
