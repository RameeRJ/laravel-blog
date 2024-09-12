<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyPostController extends Controller
{
    public function index()
{
    
    if (Auth::check()) {
        
        $posts = Post::where('username', Auth::user()->name)->latest()->get();
        return view('mypost', compact('posts'));
    } else {
        return redirect()->route('login')->with('error', 'You need to log in to view your posts.');
    }
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

        $image=$request->image;
        if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $image->move('postimage',$imagename);
        $post->image=$imagename;
        }
        $post->save();
        return redirect()->route('home')->with('message',"Your post was update successfully!");

    }

    public function destroy($id)
    {
        $data=Post::find($id);
        $data->delete();
        return redirect()->back()->with('message',"Your post was delete successfully!");
           
    }

    public function show($id)
    {
        $post=Post::find($id);
        return  view('post.show', compact('post'));

    }
    
}