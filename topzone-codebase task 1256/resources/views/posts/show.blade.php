<!-- resources/views/posts/show.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>{{ $post->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .post-img {
            width: fit-content;
            max-height: 400px;
        }
    </style>
</head>

<body>
    @include('includes.navbar')
    <div class="container mt-4">
        <div class="row">
            @if ($post->image)
            <div class="col-12 text-center">
                <img src="{{ asset($post->image) }}" class="post-img" alt="image">
            </div>
            @endif
            <h2 class="col-12 py-2 mt-2">{{ $post->title }}</h2>
            <p class="col-12 py-2">{{ $post->content }}</p>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>