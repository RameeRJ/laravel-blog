@extends('layouts.app')
@section('content')
<div class="post-container">
    <h3 >My Posts</h3>
    @foreach ($posts as $post)
    <div class="post">
            @if($post->image)    
            <img width="200" src="/postimage/{{$post->image}}">
            @endif
        <h4>{{ $post->title }}</h4>
        <p>{{ $post->post_text }}</p>
        <p style="text-align: right; " ><a class="edit-link"  href="{{route('edit',$post->id)}}"><i class="fa fa-pencil"></i></a>          <a class="trash-link" href="{{route('destroy',$post->id)}}"><i class="fa fa-trash"></i></a></p>      
        <p style="text-align: right; " >created at:{{ $post->created_at }}</p>
        <hr>
    </div>
    @endforeach

    <center>
        <a href="{{ route('posts')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add Post</a>
       </center>

@endsection