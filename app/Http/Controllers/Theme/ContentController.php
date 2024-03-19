<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class ContentController extends Controller
{

    public function like_post(Post $post, Request $request)
    {

          // check for ip

          if ($post->checkIfHasLikeForThisIp($request->getClientIp())) {

            $this->dislike_post($post, $request);

            return response()->json(['message' => 'Post ' . $post->id . " Has a dislike", 'likes' => $post->likes]);
        }
        // check if post has likes

        if (!$post->has_likes()) {
            // create a like instance and store it

            $post->likes()->create([
                'ip' => $request->getClientIp()
            ]);
        }



        $post->increment('likes');

        $post->update();

        return response()->json(['message' => 'Post ' . $post->id . " Has a like", 'likes' => $post->likes]);
    }


    public function dislike_post(Post $post, Request $request)
    {

        // get like for a given ip for this post

        $like  = $post->get_like_ip($request->getClientIp());


        $like->delete();

        if ($post->likes !== 0) {
            $post->decrement('likes');
            $post->update();
        }



        return response()->json([
            'message' => 'Dislike',
            'likes' => $post->likes
        ]);
    }


    public function test()
    {
        dd(Like::check_like_for_address('ssddsd'));
    }
}
