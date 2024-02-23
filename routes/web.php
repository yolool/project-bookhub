<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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

// Route::get('/home', [BookController::class, 'index']);
// Route::get('/download/{filename}', [BookController::class, 'download'])->where('filename','.*');

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/book', [App\Http\Controllers\WelcomeController::class, 'showDetails']);
Route::get('/download/{filename}', [App\Http\Controllers\WelcomeController::class, 'download']);
Route::get('/preview/{filename}', [App\Http\Controllers\WelcomeController::class, 'preview']);
Route::get('/donate', [App\Http\Controllers\WelcomeController::class, 'showDonate']);

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes related to admin category changes
Route::get('/cat', [App\Http\Controllers\CategoryController::class, 'index']);
Route::post('/cat-add', [App\Http\Controllers\CategoryController::class, 'catAdd']);
Route::post('/cat-update', [App\Http\Controllers\CategoryController::class, 'catUpdate']);
Route::post('/cat-delete', [App\Http\Controllers\CategoryController::class, 'catDelete']);

// Routes related to book changes
Route::get('/book-view', [App\Http\Controllers\BookController::class, 'bookView']);
Route::post('/book-add', [App\Http\Controllers\BookController::class, 'bookAdd']);
Route::post('/book-update', [App\Http\Controllers\BookController::class, 'bookUpdate']);
Route::post('/book-delete', [App\Http\Controllers\BookController::class, 'bookDelete']);