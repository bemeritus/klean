<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::latest()->paginate(9);

        return view('posts.index')->with('posts', $posts);
    }


    public function create()
    {
        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }


    public function store(Request $request)
    {
//        dd($request);

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
            'user_id' => auth()->user()->id,
            'category_id' => $request->get('category_id'),
            'title' => $request->get('title'),
            'short_content' => $request->get('short_content'),
            'content' => $request->get('content'),
            'photo' => $path ?? null,

        ]);

        if(isset($request->tags)){
            foreach ($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }

        return redirect()->route('posts.index');

    }


    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5),
            'categories' => Category::all(),
            'tags' => Tag::all(),

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
