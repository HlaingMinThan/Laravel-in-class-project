<x-admin-layout>
    <h1>Blog create</h1>
    <form
        action="/blogs/store"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input
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
            <x-error name="photo" />
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input
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
                class="form-control"
                id=""
                cols="30"
                rows="10"
            ></textarea>
            <x-error name="body" />
        </div>
        <div class="form-group my-3">
            <select
                name="category_id"
                id=""
                class="form-control"
            >
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <x-error name="category_id" />
        </div>
        <button
            type="submit"
            class="btn btn-primary"
        >Submit</button>
    </form>
</x-admin-layout>