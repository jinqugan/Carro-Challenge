<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\PaginateResource;
use App\Traits\CollectionTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    use CollectionTrait;
    private $pagination;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // if ($this->collection->isEmpty()) {
        //     return null;
        // }

        return [
            'data' => $this->collection,
            'pagination' => new PaginateResource($this),
        ];
    }
}
