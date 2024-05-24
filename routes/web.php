<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Middleware\AuthMiddleware;

Route::get('/home',[HomeController::class,'index'])->middleware('auth')->name('home');
Route::view('/about','about')->name('about');
Route::view('/contact','contact')->name('contact');

Route::get('/posts',[PostController::class,'posts'])->name('posts');
Route::post('/create',[PostController::class,'create'])->name('create');
Route::get('/edit/{id}',[PostController::class,'edit'])->name('edit');
Route::post('/update/{id}',[PostController::class,'update'])->name('update');
Route::get('/destroy/{id}',[PostController::class,'destroy'])->name('destroy');
Route::get('/show/{id}',[PostController::class,'show'])->name('show');

Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('/',[AuthController::class,'postLogin'])->name('postLogin');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'postRegister'])->name('postRegister');
Route::get('/logout', [AuthController::class, 'logout'])->name("logout");