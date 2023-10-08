@props(['blogs','categories'])
<section
    class="container text-center"
    id="blogs"
>
    <h1 class="display-5 fw-bold mb-4">Blogs</h1>
    <div class="">
        <div class="dropdown">
            <button
                class="btn btn-outline-primary dropdown-toggle"
                type="button"
                id="dropdownMenuButton1"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Filter By Category
            </button>
            <ul
                class="dropdown-menu"
                aria-labelledby="dropdownMenuButton1"
            >
                @foreach ($categories as $category)
                <li class="dropdown-item"><a href="/categories/{{$category->slug}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </div>
        {{-- <select
            name=""
            id=""
            class="p-1 rounded-pill mx-3"
        >
            <option value="">Filter by Tag</option>
        </select> --}}
    </div>
    <form
        action="/"
        method="GET"
        class="my-3"
    >
        <div class="input-group mb-3">
            <input
                value="{{request('search')}}"
                name="search"
                type="text"
                autocomplete="false"
                class="form-control"
                placeholder="Search Blogs..."
            />
            <button
                class="input-group-text bg-primary text-light"
                id="basic-addon2"
                type="submit"
            >
                Search
            </button>
        </div>
    </form>
    <div class="row">
        @forelse ($blogs as $blog)
        <div class="col-md-4 mb-4">
            <x-blog-card :blog="$blog" />
        </div>
        @empty
        <p>no blogs found...</p>
        @endforelse
        {{$blogs->links()}}

    </div>
</section>