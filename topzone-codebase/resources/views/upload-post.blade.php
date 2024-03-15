<!-- resources/views/upload-post.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Post</title>
</head>
<body>
    <h1>Upload Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('store.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="post_image">Choose Image:</label>
            <input type="file" name="post_image" id="post_image" accept="image/*">
        </div>
        <div>
            <label for="post_content">Post Content:</label>
            <textarea name="post_content" id="post_content" rows="4" cols="50" placeholder="Enter post content"></textarea>
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
</body>
</html>
