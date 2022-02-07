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
    Route::patch('/admin/post/update/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::delete('/admin/posts/{id}/delete', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');


//    Route::get('/user/{id}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('admin.users.show');

    Route::put('/user/profile/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');

    Route::delete('user/{id}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
});

Route::middleware(['role:admin', 'auth'])->group(function (){
    Route::get('users/profile', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::put('users/attach/{user}', [App\Http\Controllers\UserController::class, 'attach'])->name('users.role.attach');
    Route::put('users/detach/{user}', [App\Http\Controllers\UserController::class, 'detach'])->name('users.role.detach');


    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles/store', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/update/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::put('/roles/permission/{role}', [App\Http\Controllers\RoleController::class, 'attachPermit'])->name('roles.permission.attach');
    Route::put('/roles/permission/detach/{role}', [App\Http\Controllers\RoleController::class, 'detachPermit'])->name('roles.permission.detach');
    Route::delete('/roles/{role}/delete', [App\Http\Controllers\RoleController::class, 'delete'])->name('roles.delete');


    Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::delete('/permissions/{permission}/delete', [App\Http\Controllers\PermissionController::class, 'delete'])->name('permissions.delete');
    Route::put('/permissions/update/{permission}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');

});

Route::middleware(['can:view,user'])->group(function (){
    Route::get('profile/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('admin.users.show');

});
