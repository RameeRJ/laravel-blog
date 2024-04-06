@extends('layouts.app')
@section('content')
    <div  class="form-container">
    <h1>Show Post</h1>
    <form action="#" method="post">
        @csrf
        <label for="title"> Post Title:</label>
        <input type="text" id="title" name="title" value="{{ $data->title }}">
        <label for="post_text">Post Description:</label>
        <textarea id="post_text" name="post_text">{{$data->post_text}}</textarea>r
        <button type="submit">Update post</button>
    </form>
    </div>
@endsection
