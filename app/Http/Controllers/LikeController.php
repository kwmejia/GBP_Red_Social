<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $req, Post $post)
    {
        $post->likes()->create([
            'user_id' => $req->user()->id
        ]);

        return back();
    }


    public function destroy(Request $req, Post $post)
    {
        $req->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
