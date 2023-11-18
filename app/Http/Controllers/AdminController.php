<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            // 'blogs' => auth()->user()->blogs()->with('category')->latest()->paginate(3)
            'blogs' => Blog::with('category')->latest()->paginate(3)
        ]);
    }
}
