<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    // Show add post form
    public function posts()
    {
        return view('post.add');
    }

    // Create a new post
    public function create(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|max:255|unique:posts',  // Adjust max length if needed
            'post_text' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        $user = Auth::user();
        $post = new Post;
        $post->title = $request->title;
        $post->post_text = $request->post_text;
        $post->poststatus = 'active';
        $post->user_id = $user->id;
        $post->username = $user->name;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('postimage'), $imagename);
            $post->image = $imagename;
        }

        $post->save();

        // Redirect with a success message
        return redirect()->route('home')->with('message', 'Your post was created successfully!');
    }

    // Show edit post form
    public function edit($id)
    {   
        $post = Post::findOrFail($id);

        // Authorization check: Only the post owner can edit the post
        if (Gate::denies('edit-post', $post)) {
            abort(403, 'Unauthorized access.');
        }

        return view('post.update', compact('post'));
    }

    // Update an existing post
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'post_text' => 'required|string',
        ]);

        $post = Post::findOrFail($id);

        // Authorization check: Only the post owner can update the post

        // Update the post
        $post->update([
            'title' => $request->input('title'),
            'post_text' => $request->input('post_text'),
        ]);

        // Redirect with a success message
        return redirect()->route('home')->with('message', 'Your post was updated successfully!');
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Authorization check: Only the post owner can delete the post
        if (Gate::denies('delete-post', $post)) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $post->delete();
        return redirect()->back()->with('message', 'Your post was deleted successfully!');
    }

    // Show a post
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));
    }
}
