@auth
<form action="{{ url('posts/'.$post->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-danger">
        Supprimer
    </button>
</form>
@endauth