<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // To get only the posts of the current logged user
        // $posts = Post::where('user_id', Auth::user()->id)->paginate(10);
        $posts = Post::paginate(10);
        return view ('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', ['post'=> null, 'categories' => $categories, 'tags' => $tags, 'tagsPost' => [] ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all()['tags']);
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

        //store del file img
        $image_path = Storage::put('uploads', $data['image']);
        //nei Fillable abbiamo 'image_url' da dover assegnare
        $data['image_url'] = $image_path;

        // dd($data);

        $post = new Post();
        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        if(array_key_exists('tags',$data)) $post->tags()->attach($data['tags']);
        
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
        //Si utilizza $path e la condizione, per settare il percorso che l'img dovrà avere
        $path = "";
        if(str_starts_with($post->image_url, 'uploads/'))
        {
            $path = asset('storage/') . "/";
        }

        return view('admin.posts.show', compact('post','path'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $tagsPost = $post->tags->pluck('id')->toArray();
        // dd($tagsPost);
        return view('admin.posts.edit', compact('post','categories','tags','tagsPost'));
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
            'title' => 'required|string|max:255',
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
        $post->update($data);
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        if(array_key_exists('tags',$data)) $post->tags()->sync($data['tags']);

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
