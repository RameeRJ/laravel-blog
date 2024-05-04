@extends('layouts.app')
@section('content')

<!-- Page header with logo and tagline-->
  <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1><h2 class="fw-bolder">{{auth()->user()->name}}</h2>
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
                                    <h2 class="card-title h4">{{ $post->title }}</h2>
                                    <p class="card-text">{{ $post->post_text }}</p>
                                    <center>
                                    <a class="btn btn-show" href="{{ route('show',$post->id)}}"><i class="fa-solid fa-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;Show</a>
                                    {{-- <a class="btn btn-primary" href="{{ route('edit',$post->id) }}"><i class="fa-regular fa-pen-to-square"></i>&nbsp;&nbsp;&nbsp;&nbsp;Edit</a>
                                    <a class="btn btn-destroy" href="{{ route('destroy',$post->id) }}"><i class="fa-solid fa-xmark"></i>&nbsp;&nbsp;Delete</a> --}}
                                    </center>
                                </div>
                            </div>
                          @endforeach
               <br><br><br>
                </div>
            </div>
        </div>
        @endsection

