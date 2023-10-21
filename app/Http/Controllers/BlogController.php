<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{

    public function index()
    {

        return view('blogs.index', [
            'blogs' => Blog::with(['category', 'author']) //eager loading
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
            'randomBlogs' => cache()->remember('blogs.' . $blog->slug, now()->addSeconds(10), function () use ($blog) {
                return Blog::inRandomOrder()->whereHas('category', function ($query) use ($blog) {
                    $query->where('slug', $blog->category->slug);
                })->take(3)->get();
            })
        ]);
    }
}
