<x-layout>
    <div class="container">
        <form
            action="/comments/{{$comment->id}}/update"
            method="POST"
        >
            @method('PATCH')
            @csrf
            <label for="">Comment here</label>
            <textarea
                name="body"
                class="form-control"
                id=""
                cols="30"
                rows="10"
            >{{$comment->body}}</textarea>
            @error('body')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <button
                type="submit"
                class="btn btn-primary my-3"
            >Update</button>
        </form>
    </div>
</x-layout>