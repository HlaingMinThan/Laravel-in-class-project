<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Blog
{

    public function __construct(public $title, public $slug, public $intro, public $body, public $created_at)
    {
    }

    public static function all()
    {
        $blogs = collect(File::files(resource_path('/blogs')))->map(function ($file) {
            $yamlObj = YamlFrontMatter::parse(file_get_contents($file->getPathname()));
            return new Blog($yamlObj->title, $yamlObj->slug, $yamlObj->intro, $yamlObj->body(), $yamlObj->created_at);
        });
        return $blogs->sortByDesc('created_at');
    }

    public static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
    }


    public static function findOrFail($slug)
    {
        return static::find($slug) ?? abort(404);
    }
}
