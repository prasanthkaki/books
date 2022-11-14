<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\author\AuthorController;
use App\Http\Controllers\books\BooksController;
use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware([auth::class])->group(function(){
    Route::post('author-books',[AuthorController::class,'author']);
});

// Route::post('author-books',[AuthorController::class,'author']);
Route::get('books',[BooksController::class,'books']);