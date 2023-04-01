<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => new CategoryResource($this->category),
            'type' => new TypeResource($this->type),
        ];
    }
}
