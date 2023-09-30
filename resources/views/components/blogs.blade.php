@foreach ($blogs as $blog)
<h1><a href="/blogs/{{$blog->slug;}}">
        {{$blog->title}}
        @if ($blog->title === "third blog")
        <span>special blog</span>
        @endif
    </a></h1>
<p>
    {{$blog->intro}}
</p>
<p>Published At -
    {{$blog->created_at->format('d-m-y')}}
</p>
@endforeach