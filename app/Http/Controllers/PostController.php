<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(3);

        return view('posts.index')->with('posts', $posts);
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'short_content' => 'required',
            'content' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('photo')) {
            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name);

        }


        $post = Post::create([
            'title' => $request->get('title'),
            'short_content' => $request->get('short_content'),
            'content' => $request->get('content'),
            'photo' => $path ?? null,

        ]);

        return redirect()->route('posts.index');
    }


    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5)
        ]);
    }


    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'short_content' => 'required',
            'content' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('photo')) {

            if(isset($post->photo)){
                Storage::delete($post->photo);
            }

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name);

        }

        $post->update([
            'title' => $request->get('title'),
            'short_content' => $request->get('short_content'),
            'content' => $request->get('content'),
            'photo' => $path ?? $post->photo,

        ]);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }


    public function destroy(Post $post)
    {
        if(isset($post->photo)){
            Storage::delete($post->photo);
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
