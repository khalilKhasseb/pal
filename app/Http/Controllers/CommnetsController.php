<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
class CommnetsController extends Controller
{
    //

    public function store(Post $post,Request $request) {

         $comment = Comment::create($request->only([
            'name',
            'comment',
            'website',
            'email'
         ]));

        $post->comments()->save($comment);

        return response()->json([
          'comment' => $post->comments()->find($comment->id),
        //   'post_comment' =>
          'message' => 'comment added',
        ]);
    }
}
