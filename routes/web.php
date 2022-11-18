<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

// All Books
Route::get('/', [BookController::class, 'index']);

// Show Create Form
Route::get('/books/create', [BookController::class, 'create'])->middleware('auth');

// Store Book Data
Route::post('/books', [BookController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->middleware('auth');

// Update Book
Route::put('/books/{book}', [BookController::class, 'update'])->middleware('auth');

// Delete Book
Route::delete('/books/{book}', [BookController::class, 'destroy'])->middleware('auth');

// Manage Books
Route::get('/books/manage', [BookController::class, 'manage'])->middleware('auth');

// Single Book
Route::get('/books/{book}', [BookController::class, 'show']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);