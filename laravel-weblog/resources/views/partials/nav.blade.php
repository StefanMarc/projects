<nav>
    <ul>
       <li><a href="{{ route('posts.index') }}">Home</a></li>
       <li><a href="{{ route('posts.create') }}">Write a new post</a></li>
       <li><a href="{{ route('my.posts') }}">My Posts</a></li>
    </ul>
    <ul>
        @auth
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @else
            <li>
                <form action="{{ route('login') }}" method="GET">
                    <button type="submit">Login</button>
                </form>
            </li>
        @endauth
    </ul>
</nav>