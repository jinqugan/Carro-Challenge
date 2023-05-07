<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Tag\TagCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\ResourceTrait;

class PostResource extends JsonResource
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
            'posts' => [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'author_id' => $this->author_id,
                'created_at' => $this->created_at,
            ],
            'likes_count' => $this->likes->count(),
            'tags' => new TagCollection($this->postTags),
        ];
    }
}
