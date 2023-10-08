<?php

use App\Http\Controllers\BlogController;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index']);

Route::get('/blogs/{blog:slug}', function (Blog $blog) {
    return view('blogs.show', [
        'blog' => $blog,
        'randomBlogs' => Blog::inRandomOrder()->take(3)->get()
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('blogs.index', [
        'blogs' => $category->blogs->load('category'),
        'categories' => Category::all()
    ]);
});

Route::get('/users/{user:username}', function (User $user) {
    return view('blogs.index', [
        'blogs' => $user->blogs,
        'categories' => Category::all()
    ]);
});
