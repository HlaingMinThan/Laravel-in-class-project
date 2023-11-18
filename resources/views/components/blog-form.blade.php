@props(['categories','type','blog' => null])
<h1>Blog {{$type === 'create' ? "create" : "update"}}</h1>
<form
    action="{{$type==='create' ? '/blogs/store' : '/blogs/'.$blog->id.'/update'}}"
    method="POST"
    enctype="multipart/form-data"
>
    @if ($type==="update")
    @method('patch')
    @endif

    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input
            value="{{old('title',$blog?->title)}}"
            name="title"
            type="text"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter Title"
        >
        <x-error name="title" />
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Photo</label>
        <input
            name="photo"
            type="file"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter Title"
        >
        @if ($type==="update")
        <img
            class="my-3"
            width="200"
            height="200"
            src="{{$blog?->photo}}"
            alt=""
        >
        @endif
        <x-error name="photo" />
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Slug</label>
        <input
            value="{{old('slug',$blog?->slug)}}"
            name="slug"
            type="text"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter Slug"
        >
        <x-error name="slug" />
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Intro</label>
        <input
            value="{{old('intro',$blog?->intro)}}"
            name="intro"
            type="text"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter Intro"
        >
        <x-error name="intro" />
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Reading Time</label>
        <input
            value="{{old('reading_time',$blog?->reading_time)}}"
            name="reading_time"
            type="number"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter Reading Time"
        >
        <x-error name="reading_time" />
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Body</label>
        <textarea
            name="body"
            id="mytextarea"
            cols="30"
            rows="10"
        >{{old('body',$blog?->body)}}</textarea>
        <x-error name="body" />
    </div>
    <div class="form-group my-3">
        <select
            name="category_id"
            id=""
            class="form-control"
        >
            @foreach ($categories as $category)
            <option {{$category->id == old('category_id',$blog?->category->id) ? 'selected' : '' }}
                value="{{$category->id}}"
                >{{$category->name}}</option>
            @endforeach
        </select>
        <x-error name="category_id" />
    </div>
    <button
        type="submit"
        class="btn btn-primary"
    >Submit</button>
</form>