@extends('layouts.app')
@section('content')
    <div  class="form-container">
        <h1>Add Post</h1>
        <form action="{{ route('create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title">Post Title:</label>
            <input type="text" id="title" name="title">

            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="post_text">Post Description:</label>
            <textarea id="post_text" name="post_text"></textarea>
            @error('post_text')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="image">Image:</label>
            <input type="file" name="image"><br><br>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection