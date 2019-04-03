<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index','show']]);
        $this->middleware('ajax')->only('destroy');
        $this->middleware('admin')->only(['create', 'update', 'edit', 'store']);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(4);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('posts.create', compact('categories'));
    }

    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id');
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Post $post)
    {
        $post->update(request()->all());
        $post->categories()->sync(request()->get('categories'));
        return redirect('/posts');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'bail|required',
            'content' => 'bail|required'
        ]);
    }

    public function store()
    {
        $this->validator(request()->all())->validate();

        $post = Post::create(request()->all());
        $post->categories()->sync(request()->get('categories'));
 
        return redirect('/posts');
    }

    public function destroy(Post $post)
    {
        if ($post->delete()){
            return response()->json([
                'id' => $post->id
            ], 200);
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
    }
}
