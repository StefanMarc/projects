@auth
    @if (Auth::id() === $post->user_id)
        <div class="actions">
            <form action="{{ route('posts.destroy', $post) }}" method="POST"
            onsubmit="return confirm('Are you sure? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button class="delete-button">Delete</button>
            </form>
            <form action="{{ route('posts.edit', $post) }}" method="GET">
                @csrf
                <button class="edit-button">Edit</button>
            </form>
        </div>
    @endif
@endauth