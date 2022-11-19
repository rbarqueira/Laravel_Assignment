<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAPIController;
use App\Http\Controllers\BookAPIController;

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
Route::group(['middleware' => ['api']], function ($router) {
    // your routes here



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// All Books
Route::get('/', [BookAPIController::class, 'index']);

// Show Create Form
//Route::get('/books/create', [BookController::class, 'create'])->middleware('auth');

// Store Book Data
Route::post('/books', [BookAPIController::class, 'store'])->middleware('auth:sanctum');

// Show Edit Form
//Route::get('/books/{book}/edit', [BookController::class, 'edit'])->middleware('auth');

// Update Book
Route::put('/books/{book}', [BookAPIController::class, 'update'])->middleware('auth:sanctum');

// Delete Book
Route::delete('/books/{book}', [BookAPIController::class, 'destroy'])->middleware('auth:sanctum');

// Manage Books
Route::get('/books/manage', [BookAPIController::class, 'manage'])->middleware('auth:sanctum');

// Single Book
Route::get('/books/{book}', [BookAPIController::class, 'show']);

// Show Register/Create Form
//Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserAPIController::class, 'store']);

// Log User Out
Route::post('/logout', [UserAPIController::class, 'logout'])->middleware('auth:sanctum');

// Show Login Form
//Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserAPIController::class, 'authenticate']);

});

