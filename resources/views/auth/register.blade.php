<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title>signup</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
</head>
<body>
    @if(@session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
        @endif
<div class="form-container">
<div class="box form-box">
    <h1>Sign Up</h1>
    <form action="{{route('postRegister')}}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Username" required>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror<br><br>
        <input type="email" name="email" placeholder="Email Address" required>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror<br><br>
        <input type="password" name="password" placeholder="Password" required>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror<br><br>
        <input type="submit" value="Sign Up">
        <div>
            Already have an account? <a href="{{route('login')}}">Log In Now</a>
            </div>
    </form>
</body>
</html>
