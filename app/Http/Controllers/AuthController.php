<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use  App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return  view('auth.login');
    }

    public  function register()
    {
        return   view('auth.register');
    }
    
    public  function postLogin(Request $request)
    {
        $request->validate([ 
            'email'=>'required|email',  
            'password'=>'required' 
        ]);
        $credentials  = $request->only('email', 'password');
        
        if(Auth::attempt($credentials))
        {

            $user = Auth::user();
            $userName = $user->name;
            Log::info('logged in  user',[$userName]);

            
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
               
            ]);
            return redirect()->intended(route('home'))->with("success",'Signed in successfully');
        }
        return redirect(route('login'))->with('error','Invalid Email or Password!');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password']= $request->password;
        $user = User::create($data);

        if(!$user)
        {
            return back()->with("error","An error occurred");
        }
        return redirect(route('login'))->with("message",'Register successfully, please login to your account!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'))->with("message",'Log out successfully.');
    }
}    