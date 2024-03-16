<!DOCTYPE html>
<html>

<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('ckfinder::setup')
    <style>
        textarea {
            min-height: 60px;
        }

        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
</head>

<body>

    @include('includes.navbar')
    <!-- <h2>Create a New Post</h2> -->
    <div class="container my-4">
        <form id="postForm" method="POST" action="{{ url('/post/submit') }}" enctype="multipart/form-data" class="mt-4" data-parsley-validate>
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" required data-parsley-trigger="keyup" data-parsley-errors-container="#titleError">
                <div id="titleError"></div>
            </div>
            <div class="form-group">
                <label for="excerpt">Excerpt:</label>
                <textarea id="excerpt" name="excerpt" class="form-control" required data-parsley-trigger="keyup" data-parsley-errors-container="#excerptError">{{ old('excerpt') }}</textarea>
                <div id="excerptError"></div>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <!-- Replace textarea with CKEditor instance -->
                <textarea id="content" name="content" class="form-control" required data-parsley-trigger="keyup" data-parsley-errors-container="#contentError"></textarea>
                <div id="contentError"></div>
            </div>
            <div class="form-group">
                <label for="image">Cover image (optional):</label>
                <input type="file" id="image" name="image" accept="image/*" class="form-control-file" data-parsley-trigger="change" data-parsley-errors-container="#imageError">
                <div id="imageError"></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    <script type="text/javascript" src="/topzone-codebase/public/js/ckfinder/ckfinder.js"></script>

    <script>
        $(document).ready(function() {
            $('#postForm').submit(function(event) {
                event.preventDefault();
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            showSuccessToast(response.message);
                            $('#postForm')[0].reset();
                        } else {
                            showErrorToast(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        showErrorToast("An error occurred while processing your request.");
                    }
                });
            });
        });
    </script>

    <script>
        CKFinder.config({
            connectorPath: '/topzone-codebase/ckfinder/connector',
            uploadMethod: 'POST',
        });

        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: '/topzone-codebase/ckfinder/upload'
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
        $(document).ready(function() {
            $('#postForm').parsley();
        });

        function showSuccessToast(message) {
            $.toast({
                text: message,
                position: 'top-right',
                icon: 'success',
                loader: false,
                loaderBg: '#fff',
                showHideTransition: 'slide',
                hideAfter: 2000
            });
            setTimeout(function() {
                                window.location.href = '/topzone-codebase/posts';
                            }, 2000);
        }

        function showErrorToast(message) {
            $.toast({
                text: message,
                position: 'top-right',
                icon: 'error',
                loader: false,
                loaderBg: '#fff',
                showHideTransition: 'slide',
                hideAfter: 3000
            });
        }

        function showWarningToast(message) {
            $.toast({
                text: message,
                position: 'top-right',
                icon: 'warning',
                loader: false,
                loaderBg: '#fff',
                showHideTransition: 'slide',
                hideAfter: 3000
            });
        }

        function showInfoToast(message) {
            $.toast({
                text: message,
                position: 'top-right',
                icon: 'info',
                loader: false,
                loaderBg: '#fff',
                showHideTransition: 'slide',
                hideAfter: 3000
            });
        }
    </script>

</body>

</html>