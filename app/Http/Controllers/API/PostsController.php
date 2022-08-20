<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Events\PostCreated;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function getAllPosts()
    {
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'message'   => 'Found all posts',
            'data'      => Post::all(),
        ]);
    }

    public function create_post(Request $request)
    {
        $request->validate([
            'website_id'    => 'required|numeric',
            'user_id'       => 'required|numeric',
            'title'         => 'required',
            'description'   => 'required',
        ]);

        $fields         = $request->all();
        $fields['slug'] = Str::slug($fields['title']);

        $post = Post::create($fields);

        // Event dispatcher to send mail notification
        // PostCreated::dispatch($post, $post->active_website_subscribers);
        // $post->active_website_subscribers;

        return response()->json([
            'code'      => 201,
            'status'    => 'success',
            'message'   => 'Successfully created post',
            'data'      => $post,
        ]);
    }
}
