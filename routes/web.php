<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubscribeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthenticatedMiddleware;
use App\Mail\SubscriberMail;
use App\Models\Blog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('admin', [AdminController::class, 'index']);
    Route::get('/blogs/create', [BlogController::class, 'create']);
    Route::post('/blogs/store', [BlogController::class, 'store']);
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit']);
    Route::patch('/blogs/{blog}/update', [BlogController::class, 'update']);
    Route::delete('/blogs/{blog}/delete', [BlogController::class, 'destroy']);
});

Route::get('/', function () {
    return view('blogs.index', [
        'blogs' => Blog::filter(['search', 'category', 'username'])->latest()->paginate()
    ]);
})->middleware('auth');
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);
Route::post('/blogs/{blog:slug}/comments', [CommentController::class, 'store']);
Route::post('/blogs/{blog:slug}/handle-subscription', [SubscribeController::class, 'handleSubscription']);
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit']);
Route::patch('/comments/{comment}/update', [CommentController::class, 'update']);
Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
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
