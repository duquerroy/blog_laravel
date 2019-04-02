@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($posts as $post)
                <div id="post-{{ $post->id }}">
                    <h2>
                        <a href="{{ url("/posts/{$post->id}") }}">{{ $post->title }}</a>
                    </h2>
                    <p>{{ $post->content }}</p>
                    @foreach ($post->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach

                @include('inc.delete-button')
                @include('inc.edit-button')
                </div>
            @endforeach
            <div class="mt-3">
                {{ $posts->links() }}
            </div>

        </div>
    </div>
</div>
@endsection

