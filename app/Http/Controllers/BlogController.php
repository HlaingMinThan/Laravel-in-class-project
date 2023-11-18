<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFormRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
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

    public function store(BlogFormRequest $request)
    {
        $cleanData = $request->validated();
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

    public function edit(Blog $blog)
    {
        return view('blogs.edit', [
            'blog' => $blog,
            'categories' => Category::all()
        ]);
    }

    public function update(Blog $blog, BlogFormRequest $request)
    {
        $cleanData = $request->validated();
        $blog->title = $cleanData['title'];
        $blog->body = $cleanData['body'];
        $blog->slug = $cleanData['slug'];
        $blog->reading_time = $cleanData['reading_time'];
        $blog->intro = $cleanData['intro'];
        $blog->category_id = $cleanData['category_id'];

        if ($file = request('photo')) {
            if ($path = public_path($blog->photo)) {
                File::delete($path);
            }
            $blog->photo =  '/storage/' . $file->store('/blogs');
        }
        $blog->update();

        return redirect('/admin');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back();
    }
}
