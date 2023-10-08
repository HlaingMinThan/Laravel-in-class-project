<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index']);
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);

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