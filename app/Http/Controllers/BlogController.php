<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{

    public function index()
    {
        return view('blogs.index', [
            'blogs' => Blog::with(['category', 'author'])
                ->filter(request(['search', 'category', 'author', 'year']))
                ->latest()
                ->paginate(6)
                ->withQueryString(),
        ]);
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', [
            'blog' => $blog,
            'randomBlogs' => Blog::inRandomOrder()->take(3)->get()
        ]);
    }
}
