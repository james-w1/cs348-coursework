<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [MainController::class, 'index'])->name('forum.index');

Route::get('/register', [RegisterController::class, 'create'])->name('register.create');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login.form');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/profile/{user}/settings', [ProfileController::class, 'edit'])->middleware('auth')
    ->name('profile.settings');

Route::post('/profile/{user}/delete', [ProfileController::class, 'destroy'])->middleware('auth')
    ->name('profile.delete');

Route::get('/sub-forum/{sub_forum}', [MainController::class, 'show'])->name('forum.show');

Route::post('/sub-forum/{sub_forum}', [MainController::class, 'store'])->name('forum.store');

Route::get('/sub-forum/{sub_forum}/create', [MainController::class, 'create'])->middleware('auth')
    ->name('post.create');

Route::get('/sub-forum/{sub_forum}/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::group(['middleware'=>'auth'], function () {
    Route::delete('/sub-forum/{sub_forum}/post/{post}/delete', [MainController::class, 'destroy'])->middleware('auth')
        ->name('post.delete');
    
    Route::get('/sub-forum/{sub_forum}/post/{post}/edit', [MainController::class, 'edit'])->middleware('auth')
        ->name('post.edit');
    
    Route::put('/sub-forum/{sub_forum}/post/{post}/edit', [MainController::class, 'update'])->middleware('auth')
        ->name('post.update');
});
