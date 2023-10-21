<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Middleware\AuthenticatedMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index'])->middleware('auth');
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'loginStore']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerStore']);
Route::post('/logout', [AuthController::class, 'logout']);

// list -> index       /products (GET)
// single -> show       /products/{product} (GET)
// create form design -> create         /products/create (GET)
// create form store -> store           /products/store (POST)
// edit form design -> edit             /products/{product}/edit (GET)
// edit form design update -> update    /products/{product}/update (PATCH)
// delete a data -> destroy             /products/{product}/destroy (delete)



//   /customers -> index
//   /customers/{customer} -> show (GET)
//   /customers/create -> create (GET)
//   /customers/store -> store (POST)
//   /customers/{customer}/edit (GET)
//   /customers/{customer}/update (PATCH)
//   /customers/{customer}/destroy (delete)
