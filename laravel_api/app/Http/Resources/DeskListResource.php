<?php

namespace App\Http\Resources;

use App\Models\Card;
use Illuminate\Http\Resources\Json\JsonResource;

class DeskListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'lists' => CardResource::collection($this->lists)
        ];
    }
}
