<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view ('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', ['post'=> null, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:posts|max:255',
            // 'author' => 'required|string|max:50',
            'content' => 'required|string|min:10',
            'category_id' => 'nullable',
        ],
        [
            'required' => 'You have to fill correctly :attribute',
            'title.required' => 'The post need a Title',
            // 'author.max' => 'Too many digits for the author field',
            'content.min' => 'You have to insert more words in the post',
        ]);
        $data = $request->all();
        $data['post_date'] = Carbon::now();
        $data['user_id'] = Auth::user()->id;

        $post = new Post();
        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->save();
        // dd($post);
        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        
        $categories = Category::all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|unique:posts|max:255',
            // 'author' => 'required|string|max:50',
            'content' => 'required|string|min:10',
            'category_id' => 'nullable',
        ],
        [
            'required' => 'You have to fill correctly :attribute',
            'title.required' => 'The post need a Title',
            // 'author.max' => 'Too many digits for the author field',
            'content.min' => 'You have to insert more words in the post',
        ]);

        $post->update($request->all());
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        return redirect()->route('admin.posts.show', ['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // $post->delete();

        return redirect()->route('admin.posts.index')->with('info', $post->title);
    }
}
