<?php

namespace App\Http\Resources\Tag;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\ResourceTrait;

class TagResource extends JsonResource
{
    use ResourceTrait;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (empty($this->resource)) {
            return null;
        }

        return [
            'id' => $this->id,
            'name' => $this->value,
            'created_at' => $this->created_at,
        ];
    }
}
