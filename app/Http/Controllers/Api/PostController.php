<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function show(){
        $posts=Post::all();
        return response()->json([
            'code' => 1,
            'message' => 'Get post successful',
            'posts'=>$posts
        ],200);
    }
    public function store(PostRequest $request)
    {
        $user_id = Auth::user()->id;
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $user_id;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('dashboard/post/images'), $filename);
            $post->image = $filename;
        }
        $post->save();
    return response()->json([
        'code' => 1,
        'message' => 'Create post successful',
        'post'=>$post
    ], 201);

    }

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        $post->update($request->all());

        return response()->json([
            'code' => 1,
            'message' => 'Update post successful',
            'post'=>$post
        ]);
    }
    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete();
        return response()->json([
            'code' => 1,
            'message' => 'Delete post successful',
            'post'=>$post
        ]);
    }
}
