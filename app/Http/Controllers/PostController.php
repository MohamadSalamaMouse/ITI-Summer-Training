<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::all();
        return view('post.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $user_id=Auth::user()->id;
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id=$user_id;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(public_path('dashboard/post/images'),$filename);
            $post->image = $filename;
        }
        $post->save();
        return redirect()->route('post.index')->with('msg_success','Create post successful');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $user=User::find($id);
       return view('post.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect()->route('post.index')->with('msg_success','Update Post Successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if($post->image){
            unlink(public_path('dashboard/post/images/'.$post->image));
        }
        $post->delete();
        return redirect()->route('post.index');
    }
}
