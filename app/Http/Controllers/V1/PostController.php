<?php

namespace App\Http\Controllers\V1;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Http\Requests\Post\ReactionRequest;
use App\Http\Resources\Post\ReactionResource;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function list(Request $request)
    {
        return (new PostCollection(Post::paginate($request['limit'])));
    }

    public function toggleReaction(ReactionRequest $request)
    {
        $likes = Like::updateOrCreate([
            'post_id' => $request['post_id'],
            'user_id' => auth()->id(),
        ], [
            'likes' => $request['like'],
        ]);

        return (new ReactionResource($likes));
    }
}
