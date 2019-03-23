@auth
<form action="{{ url('posts/'.$post->id.'/edit') }}" method="GET">

    <button type="submit" class="btn btn-info ml-1">
        Edit
    </button>
</form>
@endauth