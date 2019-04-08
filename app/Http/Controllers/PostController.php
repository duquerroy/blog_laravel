<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;


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

    public function update(Post $post, Request $request)
    {
        $this->validator(request()->all())->validate();
        
        $path = basename ($request->image->store('images', 'public'));

        // Save thumb
        $image = InterventionImage::make($request->image)->widen(500)->encode();
        Storage::put('public/thumbs/' . $path, $image);

        
        $post['name'] = $path;
        $post['content'] = $request->content;
        $post['title'] = $request->title;
        $post->update(request()->all());
        // $post = Post::update($post);
        $post->categories()->sync(request()->get('categories'));
        return redirect('/posts');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'bail|required',
            'image' => 'required|image|max:20000',
            'content' => 'bail|required'
        ]);
    }

    public function store(Request $request)
    {
        $this->validator(request()->all())->validate();

        $path = basename ($request->image->store('images', 'public'));

        // Save thumb
        $image = InterventionImage::make($request->image)->widen(500)->encode();
        Storage::put('public/thumbs/' . $path, $image);

        
        $post['name'] = $path;
        $post['content'] = $request->content;
        $post['title'] = $request->title;
        $post = Post::create($post);
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
