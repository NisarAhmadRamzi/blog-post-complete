@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card">
            <div class="card-header">
                Create Rule
            </div>
            <div class="card-body">
                <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Role</label>
                        <input type="text" name="name" class="form-control" placeholder="enter your Role Name">
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror


                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
