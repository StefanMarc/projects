<nav>
    <div class="nav-container">
        <ul class="nav-links">
            <li><a href="{{ route('posts.index') }}">Home</a></li>
            <li><a href="{{ route('posts.create') }}">Write a new post</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li><a href="{{ route('my.posts') }}">My Posts</a></li>
        </ul>
        <div class="nav-auth">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <form action="{{ route('login') }}" method="GET">
                <button type="submit">Login</button>
            </form>
        @endauth
        </div>
    </div>
</nav>