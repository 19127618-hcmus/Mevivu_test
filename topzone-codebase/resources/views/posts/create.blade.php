<!DOCTYPE html>
<html>

<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        textarea {
            min-height: 200px;
        }
    </style>
</head>

<body>
    @include('includes.navbar')
    <h2>Create a New Post</h2>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container mt-4">
        <form id="postForm" method="POST" action="{{ url('/post/submit') }}" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" class="form-control">{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" class="form-control-file">
            </div>
            <!-- New fields -->

            <div class="form-group">
                <label for="excerpt">Excerpt:</label>
                <textarea id="excerpt" name="excerpt" class="form-control">{{ old('excerpt') }}</textarea>
            </div>
            <!-- End of new fields -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // JavaScript code to handle form submission
        document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Collect form data
            var formData = new FormData(this);

            // Send form data to server using AJAX
            fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // You can handle response data here
                    // Show success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        // Clear form after successful submission
                        document.getElementById('postForm').reset();
                    });
                })
                .catch(error => {
                    console.error('There was an error!', error);
                    // Optionally, display an error message to the user
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'There was an error while submitting the form. Please try again later.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
        });
    </script>


</body>

</html>