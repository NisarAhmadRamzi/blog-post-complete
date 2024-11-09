@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card">
            <div class="card-header">
                About Page
            </div>
            <div class="card-body">
                <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ $about->title }}" class="form-control" placeholder="enter your about title">
                    </div>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="sub_title">Sub_Title</label>
                        <input type="text" name="sub_title" value="{{ $about->sub_title }}" class="form-control" placeholder="enter your about sub_title">
                    </div>
                    @error('sub_title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    {{-- <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" class="form-control">
                        <!-- Display the current file name, if necessary -->
                        @if($about->file)
                            <p>Current file: {{ $about->file }}</p>
                        @endif
                    </div> --}}
                    <div class="form-group">
                        <label for="file">Upload New File</label>
                        <input type="file" name="file" class="form-control">
                        
                        <!-- Display the current file name or provide a download link -->
                        @if($about->file)
                            <p>Current file: <a href="{{ asset('uploads/' . $about->file) }}" target="_blank">{{ $about->file }}</a></p>
                        @endif
                        <!-- Hidden input to retain the old file name -->
                        <input type="hidden" name="old_file" value="{{ $about->file }}">
                        
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" cols="30" rows="10" class="form-control" placeholder="enter the about all description">{{ $about->description }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
