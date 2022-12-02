<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;

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

Route::get('/sub-forum/{sub_forum}', [MainController::class, 'show'])->name('forum.show');

Route::post('/sub-forum/{sub_forum}', [MainController::class, 'store'])->name('forum.store');

Route::get('/sub-forum/{sub_forum}/create', [MainController::class, 'create'])->name('post.create');

Route::get('/sub-forum/{sub_forum}/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::post('/sub-forum/{sub_forum}/post/{post}', [PostController::class, 'store'])->name('post.reply');
