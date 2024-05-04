<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\Post;


class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return view('index',[
            'posts' =>$posts]
        );

    }

    public function mypost()
    {

        return view('mypost');
    }
}
