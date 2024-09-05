@extends('layouts.app')
@section('content')

<!-- Page header with logo and tagline-->
  <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">@lang('messages.greeting')</h1><h2 class="fw-bolder">{{auth()->user()->name}}</h2>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                @if(@session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message') }}
                </div>
                @endif
                @if(@session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success') }}
                </div>
                    @endif
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-lg-12">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="small text-muted">{{ $post->created_at }}</div>
                                    <div class="small text-muted">{{ $post->username }}</div>
                            
                                    @php
                                        $title = $post->title;
                                        $trimmedTitle = trim($title);
                                        $postText = $post->post_text;
                                        $length = strlen($postText);  // Get the length of the string
                                        $endsWith = str_ends_with($postText, 's');  // Check if it ends with 'yourSubstring'
                                        $position = strpos($postText, 'my');  // Get the position of 'yourSubstring'
                                        $trimmedText = Str::limit($postText, 60,'........'); // Limit the post text to 100 characters
                                    @endphp
                                    <h2 class="card-title h4">
                                        {{ $trimmedTitle }} <!-- Display the trimmed and limited title -->
                                    </h2>
                            
                                    <p class="card-text">
                                        <strong>Text:</strong> {{ $trimmedText }} <br>
                                        <strong>Length:</strong> {{ $length }} characters <br>
                                        <strong>Ends with 's':</strong> {{ $endsWith ? 'Yes' : 'No' }} <br>
                                        <strong>Position of 'my':</strong> {{ $position !== false ? $position : 'Not found' }} <br>
            
                                    </p>
                            
                                    <center>
                                        <a class="btn btn-show" href="{{ route('show', $post->id) }}"><i class="fa-solid fa-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;Show</a>
                                        <a class="btn btn-primary" href="{{ route('edit', $post->id) }}"><i class="fa-regular fa-pen-to-square"></i>&nbsp;&nbsp;&nbsp;&nbsp;Edit</a>
                                        <a class="btn btn-destroy" href="{{ route('destroy', $post->id) }}"><i class="fa-solid fa-xmark"></i>&nbsp;&nbsp;Delete</a>
                                    </center>
                                </div>
                            </div>
                            
                          @endforeach
               <br><br><br>
                </div>
            </div>
            <h1>session data</h1>
            <p>ID: {{session('user_id')}}</p>
            <p>name: {{session('user_name')}}</p>
        </div>
        @endsection
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const readMoreLinks = document.querySelectorAll('.read-more');
        
                readMoreLinks.forEach(link => {
                    link.addEventListener('click', function () {
                        const shortText = this.previousElementSibling.previousElementSibling;
                        const fullText = this.previousElementSibling;
        
                        if (fullText.style.display === "none") {
                            shortText.style.display = "none";
                            fullText.style.display = "inline";
                            this.textContent = " read less";
                        } else {
                            shortText.style.display = "inline";
                            fullText.style.display = "none";
                            this.textContent = "...read more";
                        }
                    });
                });
            });
        </script>
        
