<?php

use Illuminate\Support\Facades\Route;
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

Route::resource('/posts', PostController::class);

// Route::Post('/posts', [PostController::class, 'store']);
// Route::get('/posts', [PostController::class, 'index']);
// Route::get('/posts/{post}', [PostController::class, 'show']);
// Route::put('/posts/{post}', [PostController::class, 'update']);
// Route::delete('/posts/{post}', [PostController::class, 'destroy']);
