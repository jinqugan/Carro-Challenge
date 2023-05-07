<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $perPage = config('constant.pagination');
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->perPage = config('constant.pagination');
    }

    protected $fillable = [
        'title',
        'description',
        'author_id',
    ];

    public function postTags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function likes()
    {
        return $this->hasMany(Like::class)->where('likes', 1);
    }
}
