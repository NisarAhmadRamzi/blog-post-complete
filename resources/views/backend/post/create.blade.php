@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card">
            <div class="card-header">
                Create post
            </div>
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="enter your title">
                    </div>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="sub_title">Sub_Title</label>
                        <input type="text" name="sub_title" class="form-control" placeholder="enter your sub_title">
                    </div>
                    @error('sub_title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" class="form-control">
                        
                    </div>

                    <div class="form-group">
                        <label for="image1">Image 1</label>
                        <input type="file" name="image[]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image2">Image 2</label>
                        <input type="file" name="image[]" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" cols="30" rows="10" class="form-control" placeholder="enter the all description"></textarea>
                    </div>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="topic">Topics</label>
                        @foreach ($topics as $topic)
                        {{ $topic->title }}
                        <input type="checkbox" class="mr-2" value="{{ $topic->id }}" name="topic[]">
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
