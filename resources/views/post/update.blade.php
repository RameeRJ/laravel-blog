@extends('layouts.app')
@section('content')
<style>
    /* Internal Stylesheet for Add Post Form */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .category-inputs {
        display: flex;
        flex-wrap: wrap;
    }

    .category-input {
        flex: 1;
        margin-right: 10px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
    <h1>Update Post</h1>
    <form action="{{ route('update',$data->id) }}" method="post">
        @csrf
        <label for="title">Edit Post Title:</label>
        <input type="text" id="title" name="title" value="{{ $data->title }}">
        <label for="post_text">Edit Post Description:</label>
        <textarea id="post_text" name="post_text">{{$data->post_text}}</textarea>
        <button type="submit">Update post</button>
    </form>









@endsection