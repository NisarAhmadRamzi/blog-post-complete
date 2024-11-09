@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card">
            <div class="card-header">
                roles
                <a href="{{ route('role.create') }}" class="btn btn-success float-right">Add role</a>
                <br><br>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $index=>$role)
                            <tr>
                                <td>{{ ($roles->currentPage()*10)-10 + $index +1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('role.edit', ['role' => $role->id]) }}"><i class="fa fa-edit"></i></a>

                                    <form id="delete-form-{{ $role->id }}" action="{{ route('role.destroy', ['role' => $role->id]) }}" method="role" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    
                                    <button type="button" class="btn btn-link btn-sm p-0" style="border:none;" onclick="confirmDelete({{ $role->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <a href="{{ route('role.show', ['role' => $role->id]) }}"><i class="fa fa-lock"></i></a>
                                    


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <tfoot>
                    {{ $roles->links() }}
                </tfoot>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
<script>
    function confirmDelete(roleId) {
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
                // Submit the form with the given role ID
                document.getElementById('delete-form-' + roleId).submit();
            }
        })
    }
    </script>
    
@endsection
