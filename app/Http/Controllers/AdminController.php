<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'blogs' => Blog::with('category')->latest()->paginate(3)
        ]);
    }
}
