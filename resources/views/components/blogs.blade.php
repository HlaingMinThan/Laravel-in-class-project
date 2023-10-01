@foreach ($blogs as $blog)
<h1><a href="/blogs/{{$blog->slug;}}">
        {{$blog->title}}
    </a></h1>
<p>
    {{$blog->intro}}
</p>
<p>Published At -
    {{$blog->created_at->format('d-m-y')}}
</p>
<p>Category -
    <a href="/categories/{{$blog->category->slug}}">{{$blog->category->name}}</a>
</p>
<p>Author -
    author name
</p>
@endforeach