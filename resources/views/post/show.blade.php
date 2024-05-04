@extends('layouts.app')
@section('content')
<div class="container">
        <h1> Post Details </h1>
    <h6>TITLE:{{$post->title}}</h6><br><br>
    <h6>DESCRIPTION:{{$post->post_text}}</h6><br><br>
    <h6>AUTHOR: {{$post->username}}</h6><br><br>
    @if($post->image)
    <img  src="{{ asset('/postimage/'.$post->image)}}" style="align-content: center"  width="50%" height="50%"/>
    @endif
    <br><br>
    <form action="{{route('comment.store',['id'=>$post->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text"  name="comment" style="width: 300px" placeholder="comment..">
        <input type="submit" value="post" name="submit" style="width: 60px">
        </form>
        @if(isset($comments))
        @foreach ($comments as $comment)
            <p class="list-group-item commrnt-item">{{$comment->comment}}</p>
            @endforeach
            @endif
    <center>
    <a class="btn" href="{{ route('home')}}"><i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;&nbsp;Back</a>
    </center>
</div>

@endsection
