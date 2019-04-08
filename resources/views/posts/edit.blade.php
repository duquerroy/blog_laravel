@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           <form action="{{ url('posts/'.$post->id) }}"  method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Verifiez les informations
                </div>
            @endif
            <div class="form-group">
                <label for="tatitlesk" class="col-sm-3 control-label">Titre</label>
                <div class="col-sm-6">
                <input type="text" name="title" id="title" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" value="{{ $post->title }}">
                    @if($errors->has('title'))
                      <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('content') ? ':invalid' : '' }}">
                <label for="content" class="col-sm-3 control-label">Texte</label>
                <div class="col-sm-6">
                    <textarea type="text" name="content" id="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ $post->content }}</textarea>
                    @if($errors->has('content'))
                      <span class="invalid-feedback">{{ $errors->first('content') }}</span>
                  @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                <div class="col-sm-6">
                    <label class="custom-file-label offset-md-1 col-sm-6" for="image">Image</label>
                    <input type="file" id="image" name="image" class="{{ $errors->has('image') ? ' is-invalid ' : '' }} custom-file-input">
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>
            </div>
            @if ($post->name)
                <div class="col-sm-6">
                    <img width=200 src="/storage/thumbs/{{ $post->name }}" alt="">
                </div>
            @endif
            
            
            <div class="form-group">
                <label for="categories" class="col-sm-3 control-label">Catégories</label>
                <div class="col-sm-6">
                    <select class="form-control" name="categories[]" id="categories" multiple=true>
                        @foreach($categories as $id => $name)
                            <option 
                                value="{{ $id }}" 
                                @if(in_array($id, $post->categories->pluck('id')->toArray()))
                                    selected
                                @endif
                            >
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        Validez
                    </button>
                </div>
            </div>

          </form>
        </div>
    </div>
</div>
@endsection

