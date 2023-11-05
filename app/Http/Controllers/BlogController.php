<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Validation\Rule;

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

    public function create()
    {
        return view('admin.blogs.create', [
            'categories' => Category::all()
        ]);
    }

    public function store()
    {
        $cleanData = request()->validate([
            "title" => ['required', 'max:200'],
            "photo" => ['required', 'image'],
            "slug" => ['required', 'max:100'],
            "intro" => ['required'],
            "reading_time" => ['required'],
            "body" => ['required'],
            "category_id" => ['required', Rule::exists('categories', 'id')],
        ]);
        $cleanData['user_id'] = auth()->id();
        $cleanData['photo'] = '/storage/' . request('photo')->store('/blogs');
        Blog::create($cleanData);
        return redirect('/admin');
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

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back();
    }
}
