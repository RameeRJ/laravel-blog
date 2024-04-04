<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])
->name('home');
Route::view('/about','about')->name('about');
Route::view('/contact','contact')->name('contact');

Route::get('/post_page',[PostController::class,'show'])->name('show');
Route::post('/create',[PostController::class,'create'])->name('create');
Route::get('/edit/{id}',[PostController::class,'edit'])->name('edit');
Route::post('/update/{id}',[PostController::class,'update'])->name('update');
Route::get('/destroy/{id}',[PostController::class,'destroy'])->name('destroy');
