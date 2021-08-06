<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\UserController;

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


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/post/create', [BlogPostController::class, 'create'])->middleware('auth');
Route::get('/post/create', [BlogPostController::class, 'showCreate'])->middleware('auth');

Route::get('/post/get/{id}', [BlogPostController::class, 'index']);
Route::post('/post/{id}/comment', [BlogPostController::class, 'addComment'])->middleware('auth');
Route::get('/post/{id}/edit', [BlogPostController::class, 'getEditPost'])->middleware('auth');
Route::post('/post/{id}/edit', [BlogPostController::class, 'saveEditPost'])->middleware('auth');
Route::get('/post/{id}/delete', [BlogPostController::class, 'deletePost'])->middleware('auth');

Route::post('/comment/{comment_id}/delete', [BlogPostController::class, 'deleteComment'])->middleware('auth');

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'auth']);

Route::get('/register', [UserController::class, 'showRegister']);
Route::post('/register', [UserController::class, 'registerUser']);

Route::post('/logout', [UserController::class, 'logout']);

// Route::get('/', function () {
//     return view('main');
// });

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });

// Route::get('/logout', function () {
//     return view('main');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
