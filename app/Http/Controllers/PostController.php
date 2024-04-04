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
        
        $post=new Post;
        $post->title = $request->title;
        $post->post_text = $request->post_text;
        $post->save();
        return redirect()->route('home');

    }

    public function edit($id)
    {
        $data=Post::find($id);
        return  view('post.update',compact('data'));

    }

    public function update(Request $request,$id)
    {
        $post = post::find($id);
        $post->title = $request->title;
        $post->post_text = $request->post_text;
        $post->save();
        return  redirect()->route('home');

    }

    public function destroy($id)
    {
        $data=Post::find($id);
        $data->delete();
        return redirect()->back();
           
    }
}