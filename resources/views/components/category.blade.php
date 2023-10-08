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
        <li class="dropdown-item"><a
                href="/?category={{$category->slug}}{{request('author') ? '&author='.request('author') : ''}}{{request('search') ? '&search='.request('search') : ''}}"
            >{{$category->name}}</a></li>
        @endforeach
    </ul>

</div>