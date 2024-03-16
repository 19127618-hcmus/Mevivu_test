@if ($posts->count() > 0)
    <h2>Search results for "{{ $query }}"</h2>
    <ul>
        @foreach ($posts as $post)
            <li>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->excerpt }}</p>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">View</a>
            </li>
        @endforeach
    </ul>
@else
    <p>No results found for "{{ $query }}".</p>
@endif
