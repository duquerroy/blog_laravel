<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(4);
        return View('welcome', compact('posts'));
    }

    public function view($id)
    {
        $post = Post::find($id);
        return View('post', compact('post'));
    }

    public function create()
    {
        return View('add_post');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'bail|required',
            'content' => 'bail|required'
        ]);

        $post = $request->all();
        Post::create($post);
 
        return redirect('/');
    }

    public function delete($id)
    {
        $post = Post::destroy($id);
        return redirect('/');
    }
}
