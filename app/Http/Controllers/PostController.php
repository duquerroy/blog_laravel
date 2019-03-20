<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Validator;

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
 
        return redirect('/');
    }

    public function delete($id)
    {
        $post = Post::destroy($id);
        return redirect('/');
    }
}
