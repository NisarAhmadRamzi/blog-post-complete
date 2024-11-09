@extends('backend.layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card">
            <div class="card-header">
                Setting Page
            </div>
            <div class="card-body">
                <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="logo">Upload New Logo</label>
                        <input type="file" name="logo" class="form-control">
                        
                        <!-- Display the current file name or provide a download link -->
                        @if($setting->logo)
                            <p>Current file: <a href="{{ asset('uploads/' . $setting->logo) }}" target="_blank">{{ $setting->logo }}</a></p>
                        @endif
                        <!-- Hidden input to retain the old file name -->
                        <input type="hidden" name="old_file" value="{{ $setting->logo }}">
                    </div>
                    @error('logo')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                        
                   
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" value="{{ $setting->facebook }}" class="form-control" placeholder="enter your facebook">
                    </div>
                    @error('facebook')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" name="twitter" value="{{ $setting->twitter }}" class="form-control" placeholder="enter your twitter">
                    </div>
                    @error('twitter')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="{{ $setting->email }}" class="form-control" placeholder="enter your  email">
                    </div>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="{{ $setting->phone }}" class="form-control" placeholder="enter your phone">
                    </div>
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" value="{{ $setting->address }}" class="form-control" placeholder="enter your address">
                    </div>
                    @error('address')
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
                   

                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
