<!-- resources/views/posts/index.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }
        .table p {
            margin: 0;
        }
    </style>
</head>

<body>
    @include('includes.navbar')
    <div class="container table-responsive my-4">
        <table id="posts-table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#posts-table').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('posts.getPostData') }}",
                    "type": "GET"
                },
                "columns": [{
                        "data": "title",
                        "name": "title",
                        "orderable": true,
                        "searchable": true,
                        "render": function(data, type, row) {
                            return '<strong>' + data + '</strong>';
                        }
                    },
                    {
                        "data": "excerpt",
                        "name": "excerpt",
                        "orderable": true,
                        "searchable": true,
                        "render": function(data, type, row) {
                            return '<p style="word-wrap: break-word;">' + data + '</p>';
                        }
                    },
                    {
                        "data": null,
                        "orderable": false,
                        "searchable": false,
                        "render": function(data, type, row) {
                            var editUrl = '/topzone-codebase/posts/' + row.id + '/edit';
                            var deleteUrl = '/topzone-codebase/posts/' + row.id;
                            var viewUrl = '/topzone-codebase/posts/' + row.id; // Thay đổi đường dẫn view tương ứng

                            var csrfToken = '{{ csrf_token() }}';

                            var editForm = '<form method="GET" action="' + editUrl + '" class="d-inline">';
                            editForm += '<input type="hidden" name="_token" value="' + csrfToken + '">';
                            editForm += '<button type="submit" class="btn btn-sm btn-primary mr-1">Edit</button>';
                            editForm += '</form>';

                            var deleteForm = '<form method="POST" action="' + deleteUrl + '" class="d-inline">';
                            deleteForm += '<input type="hidden" name="_token" value="' + csrfToken + '">';
                            deleteForm += '<input type="hidden" name="_method" value="DELETE">';
                            deleteForm += '<button type="submit" class="btn btn-sm btn-danger mr-1 delete-post">Delete</button>';
                            deleteForm += '</form>';

                            var viewLink = '<a href="' + viewUrl + '" class="btn btn-sm btn-info">View</a>';

                            return '<div class="btn-group">' + editForm + deleteForm + viewLink + '</div>';
                        }
                    }
                ],
                "responsive": true,
            });

            // Gán sự kiện click cho nút xoá chỉ một lần
            $('#posts-table').on('click', '.delete-post', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(result) {
                        // Hiển thị thông báo khi xoá thành công
                        $.toast({
                            heading: 'Success',
                            text: 'Bài viết đã được xoá',
                            icon: 'success',
                            position: 'top-right'
                        });

                        // Xóa hàng khỏi bảng
                        var row = form.closest('tr');
                        $('#posts-table').DataTable().row(row).remove().draw();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 404) {
                            console.error('Bài viết không tồn tại hoặc đã bị xoá trước đó.');
                        } else {
                            console.error('Lỗi không xác định: ' + error);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>