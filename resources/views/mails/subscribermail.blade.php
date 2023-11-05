<h1>Hello {{$subscriber->name}}</h1>
<p>comment - {{$comment->body}}</p>
<p>Your subscribed blogs have updates. check out <a
        target="_blank"
        href="{{asset('/blogs/'.$comment->blog->slug)}}"
    >here</a></p>