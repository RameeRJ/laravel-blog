<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row">
        @if(@session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
            @endif
            @if(@session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
                @endif
        </div>
    </div>
<div class="form-container">
    <h1>Login</h1>
    <form action="{{route('postLogin')}}" method="post">
        @csrf
        <input type="email" name="email" placeholder="Email Adress" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" value="Login">
        <div>
        Don't have account? <a href="{{route('register')}}">Sign Up Now</a>
        </div>
    </form>
</body>
</html>

