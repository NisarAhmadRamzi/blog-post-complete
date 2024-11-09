<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.post.index')->with('posts',Post::orderBy('created_at','DESC')->where('lang',app()->getLocale())->paginate(10))
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.post.create')->with('topics',Topic::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $fields = $request->validated();
        $file = $request->file('file');
        $path = $file ? $file->store('uploads', 'public') : null; 
        $fields['file'] = $path;
        $fields['slug'] = Str::slug($fields['title']);
        $fields['profile_id'] = Auth::user()->profile->id;
        $fields['lang'] = app()->getLocale();
        $post = Post::create($fields);
        $post->topics()->attach($request->topic);
        foreach($request->image as $image){
            $post->images()->create(['image'=>$image]);
        }

        Session::flash('success','Created successfully!!!');

        // Redirect to a success page or return a response
        return redirect()->route('post.index')->with('success', 'Post created successfully!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('backend.post.edit')->with('post',$post)->with('topics',Topic::all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
{
    // Validate the request fields
    $fields = $request->validated();
    // Handle file upload if it exists
    $file = $request->file('file');
    $path = $file ? $file->store('uploads', 'public') : null;
    // Add the file path to the fields
    if ($path) {
        $fields['file'] = $path;}
    // Generate the slug from the title
    $fields['slug'] = Str::slug($fields['title']);
    // Update the post with the new data
    $post->update($fields);
    $post->topics()->sync($request->topic);
    // Flash success message
    session::flash('success', 'Post updated successfully!!!');
    // Redirect back to the post index
    return redirect()->route('post.index')->with('success', 'Post updated successfully!!!');
}

    





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    public function trash(){
        return view('backend.post.trash')->with('posts',Post::onlyTrashed()->paginate(10));
    }
    public function restore($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        return redirect()->route('post.index');
    }
    public function delete($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        return redirect()->route('post.index');
    }
}
