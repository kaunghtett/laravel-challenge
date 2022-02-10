<?php

namespace App\Services\Post;

use App\Models\Like as LikeModel;

class Like 
{
   
    public function setLike(int $post_id)
    {
        LikeModel::create([
            'post_id' => $post_id,
            'user_id' => auth()->id()
        ]);

        return true;
    }
    
    public function unLike($like)
    {
       $like->delete();
       
        return true;
    }
}