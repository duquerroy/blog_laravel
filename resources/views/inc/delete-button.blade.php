@auth
<form action="{{ url('posts/'.$post->id) }}" method="POST" class="form-delete">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-danger float-left">
        Supprimer
    </button>
</form>
@endauth

