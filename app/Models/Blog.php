<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Blog extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        static::deleted(function ($item) {
            if (File::exists(public_path($item->photo))) {
                File::delete(public_path($item->photo));
            }
        });
    }

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
            //logical grouping
            $blogsQuery
                ->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('intro', 'LIKE', '%' . $search . '%');
                });
        }

        if ($category = $filters['category'] ?? null) {
            $blogsQuery->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        }

        if ($username = $filters['author'] ?? null) {
            $blogsQuery->whereHas('author', function ($query) use ($username) {
                $query->where('username', $username);
            });
        }

        if ($year = $filters['year'] ?? null) {
            $blogsQuery->whereYear('created_at', $year);
        }
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'blogs_users');
    }
}
