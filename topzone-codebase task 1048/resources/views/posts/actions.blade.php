<!-- resources/views/posts/actions.blade.php -->

<a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-sm btn-info">View</a>
<form method="POST" action="{{ route('posts.edit', ['post' => $post->id]) }}" class="d-inline">
    @csrf
    @method('GET')
    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
</form>
<form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
</form>
