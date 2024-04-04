<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show()
    {
    return view('post.add');
    }
    

    public  function create(Request $request)
    {

        $request->validate([
            'title'=>'required|max:10|unique:posts',
            'post_text'=>['required'],
        ]);
        $messages = [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 10 characters.',
            'title.unique' => 'The title has already been taken.',
            'text.required' => 'The description field is required.',
        ];
        
        $post=new Post;
        $post->title = $request->title;
        $post->post_text = $request->post_text;
        $post->save();
        return redirect()->route('home')->with('message',"Your post was created successfully!");

    }

    public function edit($id)
    {
        $data=Post::find($id);
        return  view('post.update',compact('data'));

    }

    public function update(Request $request,$id)
    {
        
        $request->validate([
            'title'=>'required|max:10|unique:posts',
            'post_text'=>'required',
        ]);
        $messages = [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least 10 characters.',
            'title.unique' => 'The title has already been taken.',
            'text.required' => 'The description field is required.',
        ];
        
        $post = post::find($id);
        $post->title = $request->title;
        $post->post_text = $request->post_text;
        $post->save();
        return redirect()->route('home')->with('message',"Your post was update successfully!");

    }

    public function destroy($id)
    {
        $data=Post::find($id);
        $data->delete();
        return redirect()->back()->with('message',"Your post was delete successfully!");
           
    }
}