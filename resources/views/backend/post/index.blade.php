@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card">
            <div class="card-header">
                posts
                <a href="{{ route('post.create') }}" class="btn btn-success float-right">Add Post</a>
                <br><br>
                <a href="{{ route('post.trash') }}" class="btn btn-success float-right">Trash</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>SubTitle</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $index=>$post)
                            <tr>
                                <td>{{ ($posts->currentPage()*10)-10 + $index +1 }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->sub_title }}</td>
                                <td>{{ $post->profile->user->name }}</td>
                                <td>
                                    <a href="{{ route('post.edit', ['post' => $post->id]) }}"><i class="fa fa-edit"></i></a>

                                    <form id="delete-form-{{ $post->id }}" action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    
                                    <button type="button" class="btn btn-link btn-sm p-0" style="border:none;" onclick="confirmDelete({{ $post->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <tfoot>
                    {{ $posts->links() }}
                </tfoot>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
<script>
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form with the given post ID
                document.getElementById('delete-form-' + postId).submit();
            }
        })
    }
    </script>
    
@endsection
