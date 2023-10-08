<div class="card d-flex p-3 my-3 shadow-sm">
    <div class="d-flex">
        <div>
            <img
                src="https://i.pravatar.cc/300"
                width="50"
                height="50"
                class="rounded-circle"
                alt=""
            >
        </div>
        <div class="ms-3">
            <div class="d-flex align-items-center">
                <h6>{{$comment->user->name}}</h6>
                @can('edit',$comment)
                <a
                    href="/comments/edit/{{$comment->id}}"
                    class="btn-link btn btn-warning"
                >edit</a>
                @endcan

                @can('delete',$comment)
                <form
                    action="/comments/delete/{{$comment->id}}"
                    method="POST"
                >
                    @method('delete')
                    @csrf
                    <button
                        type="submit"
                        class=" btn btn-danger"
                    >delete</button>
                </form>
                @endcan
            </div>
            <p class="text-secondary">{{$comment->created_at->diffForHumans()}}</p>
        </div>
    </div>
    <p class="mt-1">
        {{$comment->body}}
    </p>
</div>