<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function post_page()
    {
    return view('post.add');
    }
    

    public  function add_Post(Request $request)
    {
        $post=new Post;
        $post->title = $request->title;
        $post->post_text = $request->post_text;
        $post->save();
        return redirect()->back();

    }
}
