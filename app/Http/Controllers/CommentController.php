<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Blog $blog)
    {
        request()->validate([
            'body' => ['required', 'max:400']
        ]);
        // Comment::create([
        //     'body' => request('body'),
        //     'user_id' => auth()->id(),
        //     'blog_id' => $blog->id
        // ]);
        $blog->comments()->create([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);
        return back();
    }
}