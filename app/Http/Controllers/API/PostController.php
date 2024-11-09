<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Resources\PostResource1;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Retrieves all posts and returns them as a collection of resources
    public function index()
    {
        // Fetch all posts from the 'posts' table
        $post = Post::all();

        // Return the posts as a collection of PostResource1
        return PostResource1::collection($post);
    }

    /**
     * Store a newly created resource in storage.
     * Handles the creation of a new post.
     */
    public function store(PostCreateRequest $request)
    {
        // Create a new post record using the validated data from the request
        $post = Post::create([
            'title' => $request->title,           // Store the post title
            'sub_title' => $request->sub_title,   // Store the post subtitle
            'file' => $request->file,             // Store the file associated with the post
            'description' => $request->description, // Store the description of the post
            'slug' => Str::slug($request->title), // Generate a URL-friendly slug from the title
            'profile_id' => '1',                  // Assign a static profile_id (could be dynamic)
        ]);

        // Return the newly created post as a resource
        return PostResource1::make($post);
    }

    /**
     * Display the specified resource.
     * Retrieves and shows a post by its ID.
     */
    public function show(string $id)
    {
        // Find a specific post by its ID or throw a 404 error if not found
        $post = Post::findOrFail($id);

        // Return the found post as a resource
        return PostResource1::make($post);
    }

    /**
     * Update the specified resource in storage.
     * Handles updating an existing post.
     */
    public function update(PostCreateRequest $request, string $id)
    {
        // Find the post by its ID or throw a 404 error if not found
        $post = Post::findOrFail($id);

        // Update the post with the new values provided in the request
        $post->update([
            'title' => $request->title,           // Update the title of the post
            'sub_title' => $request->sub_title,   // Update the subtitle of the post
            'file' => $request->file,             // Update the file associated with the post
            'description' => $request->description, // Update the description of the post
            'slug' => Str::slug($request->title), // Regenerate the slug based on the updated title
            'profile_id' => '1',                  // Update the profile_id (static in this case)
        ]);

        // Return the updated post as a resource
        return PostResource1::make($post);
    }

    /**
     * Remove the specified resource from storage.
     * Handles deleting a post by its ID.
     */
    public function destroy($id)
    {
        // Find the post by its ID
        $post = Post::find($id);

        // Delete the post from the database
        $post->delete();

        // Return a simple confirmation message
        return 'deleted!!';
    }
}
