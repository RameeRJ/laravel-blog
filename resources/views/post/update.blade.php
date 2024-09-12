@extends('layouts.app')
@section('content')
    <div  class="form-container">
    <h1>Update Post</h1>
    <form action="{{ route('update',$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Edit Post Title:</label>
        <input type="text" id="title" name="title" value="{{ $post->title }}">   
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="post_text">Edit Post Description:</label>
        <textarea id="post_text" name="post_text">{{$post->post_text}}</textarea>
        @error('post_text')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label> Upload a new image: </label> <br>
        <input  type="file" name="image"></br>
        <input type="submit" value="update" name="submit"  style="width: 100px; " >
    </form>
    </div>








@endsection