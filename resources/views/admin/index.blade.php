<x-admin-layout>
    <h3>blogs</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Blog title</th>
                <th scope="col">Blog category</th>
                <th scope="col">Blog published date</th>
                <th
                    scope="col"
                    colspan="2"
                >action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td>{{$blog->id}}</td>
                <td>{{$blog->title}}</td>
                <td>{{$blog->category->name}}</td>
                <td>{{$blog->created_at->format('D-M-Y')}}</td>
                <td><a
                        class="btn btn-link btn-warning"
                        href="/blogs/{{$blog->id}}/edit"
                    >Edit</a></td>
                <td>
                    <form
                        action="/blogs/{{$blog->id}}/delete"
                        method="POST"
                    >
                        @method('DELETE')
                        @csrf
                        <button
                            type="submit"
                            class="btn btn-danger"
                        >delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$blogs->links()}}
</x-admin-layout>