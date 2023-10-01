<?php

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //solution query = Blog::with('category')->latest()->get()
    //first query = Blog::latest()->get()
    return view('home', [
        'blogs' => Blog::with('category')->latest()->get()
    ]);
});

Route::get('/blogs/{blog:slug}', function (Blog $blog) {
    return view('blog', [
        'blog' => $blog
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('home', [
        'blogs' => $category->blogs->load('category')
    ]);
});
