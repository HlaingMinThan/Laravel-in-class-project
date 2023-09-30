<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'blogs' => Blog::all()
    ]);
});
Route::get('/blogs/{slug}', function ($slug) {
    return view('blog', [
        'blog' => Blog::find($slug)
    ]);
});
