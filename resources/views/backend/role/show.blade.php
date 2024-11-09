@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card">
            <div class="card-header">
                Assign Permission
            </div>
            <div class="card-body">
                <form action="{{ route('role.update',['role'=>$role_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @foreach ($permissions as $permission)
                        <label>
                            {{ $permission->name }}
                            <input type="checkbox" value="{{ $permission->id }}" name="permission[]" class="checkbox"
                                {{-- Check if the permission is already assigned --}}
                                @if(in_array($permission->id, $rolePermissions)) 
                                    checked 
                                @endif
                            ><br>
                        </label>
                        <br>
                    @endforeach
                    @error('permission')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <br><br>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
