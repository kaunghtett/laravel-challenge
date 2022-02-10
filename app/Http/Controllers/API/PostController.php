<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\PostReactionRequest;
use App\Http\Resources\PostResource;
use App\Models\Like;
use App\Models\Post;
use App\Services\Post\Like as PostLike;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    protected $like;

    public function __construct(PostLike $like)
    {
        $like->like = $like;
    }

    public function list()
    {
       
        return PostResource::collection(Post::get());
   
    }
    
    public function toggleReaction(PostReactionRequest $request)
    {

        $post = Post::find($request->post_id);

        if(!$post) {
          return $this->respondNotFound("model not found");
        }

        if($post->user_id == auth()->id()) {
           return $this->respondInternalError("You cannot like your post");
        }
   
        $like = Like::where('post_id', $request->post_id)->where('user_id', auth()->id())->first();

        if($like && $like->post_id == $request->post_id && $request->like) {

          return $this->respondInternalError('You already like this post');

        }
        elseif($like && $like->post_id == $request->post_id && !$request->like) {
        
            (new PostLike())->unLike($like);
            return $this->respondMessage('You unlike this post successfully');
        }
        
            (new PostLike())->setLike($request->post_id);
            return $this->respondMessage("You Succesfully like the post");

    }
}
