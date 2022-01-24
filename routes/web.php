<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/show/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-post');

Route::middleware('auth')->group(function(){
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    Route::get('admin/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('create');

    Route::get('/admin/post/view', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');

    Route::post('/admin/post/', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');

    Route::get('/admin/post/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');

    Route::patch('/admin/post/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');

    Route::delete('/admin/posts/{id}/delete', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');

    Route::get('admin/user/{id}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('admin.users.show');

    Route::put('/admin/user/{id}/profile/update', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');


    Route::delete('user/{id}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
});

Route::middleware(['role:admin', 'auth'])->group(function (){
    Route::get('users/profile', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
});

Route::middleware(['can:view, user', 'auth'])->group(function (){

    Route::put('/admin/user/{id}/profile/update', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
});
