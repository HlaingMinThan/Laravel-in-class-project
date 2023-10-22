<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Blog $blog, CommentRequest $request)
    {
        $comment = $blog->comments()->create([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);
        $subscribers = $blog->subscribers->filter(fn ($user) => $user->id !== auth()->id());
        return back();
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', [
            'comment' => $comment
        ]);
    }

    public function update(Comment $comment, CommentRequest $request)
    {
        $comment->body = request('body');
        $comment->save();

        return redirect('/blogs/' . $comment->blog->slug);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect('/blogs/' . $comment->blog->slug);
    }
}
