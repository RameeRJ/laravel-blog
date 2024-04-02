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
        <h1>Add Post</h1>
        <form action="{{ route('add_post') }}" method="post">
            @csrf
            <label for="title">Post Title:</label>
            <input type="text" id="title" name="title">

            <label for="post_text">Post Description:</label>
            <textarea id="post_text" name="post_text"></textarea>
            <button type="submit">Submit</button>
        </form>
@endsection