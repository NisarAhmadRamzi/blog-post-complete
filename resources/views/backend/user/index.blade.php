@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card">
            <div class="card-header">
                Users
                <a href="{{ route('user.create') }}" class="btn btn-success float-right">Add User</a>
                <br><br>
                
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User_Role</th>
                            <th>Iamge</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index=>$user)
                            <tr>
                                <td>{{ $user->id}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role ? $user->role->name : 'No Role' }}</td>
                                <td><img src="{{ asset('uploads/' . $user->profile->profile) }}" width="35px" alt=""></td>
                                <td>
                                    <a href="#"><i class="fa fa-edit"></i></a>

                                    <form id="delete-form-{{ $user->id }}" action="#" method="post" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    
                                    <button type="button" class="btn btn-link btn-sm p-0" style="border:none;" onclick="confirmDelete({{ $user->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
<script>
    function confirmDelete(userId) {
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
                // Submit the form with the given user ID
                document.getElementById('delete-form-' + userId).submit();
            }
        })
    }
    </script>
    
@endsection
