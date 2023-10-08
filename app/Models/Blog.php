<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'slug', 'intro', 'body'];
    // protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($blogsQuery, $filters = [])
    {
        if ($search = $filters['search'] ?? null) {
            $blogsQuery
                ->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('intro', 'LIKE', '%' . $search . '%');
        }

        if ($category = $filters['category'] ?? null) {
            $blogsQuery->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        }
    }
}
