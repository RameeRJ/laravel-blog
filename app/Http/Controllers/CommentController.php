<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $post= Post::find($id);
        $user=Auth()->user();
        $userid=$user->id;
        $name =$user->name;

        $comment= new Comment;
        $comment->comment = $request->input('comment');
        $comment->user_id = $userid;
        $comment->post_id = $id;
        $comment->username = $name;
        $comment->save();
        return redirect()->back();
    }

    public function show($id)
    {
        $comments = Post::find($postId)->comments;
        return view('post.show',compact( 'comment' ));
    }
}
