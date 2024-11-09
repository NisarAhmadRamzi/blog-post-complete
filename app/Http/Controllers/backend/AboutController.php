<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    public function index(){
        return view('backend.about.index')->with('about',About::first());
    }

    public function store(Request $request){
        $fields = $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'file' => 'nullable|file', // Optionally, add 'file' rule to ensure it's a valid file
            'description' => 'required'
        ]);
     // Handle file upload if it exists
    $file = $request->file('file');
    $path = $file ? $file->store('uploads', 'public') : null; 
    if ($path) {
        $fields['file'] = $path;}
    
    About::where('id','1')->update($fields);

    Session::flash('success','About database updated successfully!!');
    return redirect()->route('about.index');
   
    }
}
