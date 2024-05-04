<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function posts()
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
        
        $user=Auth()->user();
        $userid=$user->id;
        $name=$user->name;


        $post=new Post;
        $post->title = $request->title;
        $post->post_text = $request->post_text;
        $post->poststatus = 'active';
        $post->user_id = $userid;
        $post->username = $name;


        $image=$request->image;
        if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $image->move('postimage',$imagename);
        $post->image=$imagename;}
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
            'title'=>'required|max:10',
            'post_text'=>'required',
        ]);
        $messages = [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title must be at least 10 characters.',
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

    public function show($id)
    {
        $post=Post::find($id);
        return  view('post.show', compact('post'));

    }

}