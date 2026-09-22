<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Route::post('/posts', function () {})->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/posts/{id}/edit', function () {})->name('posts.edit');

// Route::put('/posts/{id}', function () {})->name('posts.update');

// !!! CALL DELETE METHOD with route model binding !!!
Route::delete('/posts/{id}', function () {})->name('posts.destroy');

// We voegen ook een redirect toe aan de routes die de hoofdpagina doorverwijst naar de '/posts' route
// Route::redirect('/', '/posts');