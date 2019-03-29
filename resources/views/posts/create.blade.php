@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           <form action="{{ url("posts") }}"  method="POST" class="form-horizontal">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Verifiez les informations
                </div>
            @endif
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Titre</label>
                <div class="col-sm-6">
                    <input type="text" name="title" id="task-name" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}">
                    @if($errors->has('title'))
                      <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('content') ? ':invalid' : '' }}">
                <label for="task" class="col-sm-3 control-label">Texte</label>
                <div class="col-sm-6">
                <textarea type="text" name="content" id="task-name" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') }}</textarea>
                    @if($errors->has('content'))
                      <span class="invalid-feedback">{{ $errors->first('content') }}</span>
                  @endif
                </div>
            </div>

            <div class="form-group">
                <label for="categories" class="col-sm-3 control-label">Catégories</label>
                <div class="col-sm-6">
                    <select class="form-control" name="categories[]" id="categories" multiple=true>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}">
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

