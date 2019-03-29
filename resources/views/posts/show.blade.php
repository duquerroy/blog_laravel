@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <h2>
              {{ $post->title }}
          </h2>
          <p>{{ $post->content }}</p>
          @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
          @endforeach
        </div>
    </div>
</div>
@endsection

