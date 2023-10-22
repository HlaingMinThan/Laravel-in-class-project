<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{

    public function handleSubscription(Blog $blog)
    {
        $user = User::find(auth()->id());
        if ($user->isSubscribed($blog)) {
            $user->subscribedBlogs()->detach($blog->id);
        } else {
            $user->subscribedBlogs()->attach($blog->id);
        }

        return back();
    }
}
