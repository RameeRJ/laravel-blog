@extends('layouts.app')
@section('content')
    <div  class="form-container">
    <h1>Update Post</h1>
    <form action="{{ route('update',$data->id) }}" method="post">
        @csrf
        <label for="title">Edit Post Title:</label>
        <input type="text" id="title" name="title" value="{{ $data->title }}">   
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="post_text">Edit Post Description:</label>
        <textarea id="post_text" name="post_text">{{$data->post_text}}</textarea>
        @error('post_text')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit">Update post</button>
    </form>
    </div>









@endsection