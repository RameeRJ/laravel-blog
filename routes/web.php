<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])
->name('home');
Route::view('/about','about')->name('about');
Route::view('/contact','contact')->name('contact');

Route::get('/post_page',[PostController::class,'post_page'])->name('post_page');
Route::post('/add_post',[PostController::class,'add_post'])->name('add_post');
