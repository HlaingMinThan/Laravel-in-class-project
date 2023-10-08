<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{

    public function index()
    {
        $filters = request(['search', 'category']);
        return view('blogs.index', [
            'blogs' => Blog::with(['category', 'author'])
                ->filter($filters)
                ->latest()->paginate(6),
            'categories' => Category::all()
        ]);
    }
}
