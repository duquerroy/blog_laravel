<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index','show']]);
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
        return view('posts.create');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $post->update(request()->all());
        
        return redirect('/posts');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'bail|required',
            'content' => 'bail|required'
        ]);
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $post = $request->all();
        Post::create($post);
 
        return redirect('/posts');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        // $post = Post::destroy($id);
        return redirect('/posts');
    }
}
