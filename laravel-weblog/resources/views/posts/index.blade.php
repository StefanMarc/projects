@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Posts</h1>

    @foreach ($posts as $post)
        <article class="post-card">
            <a class="post-link" href="{{ route('posts.show', $post) }}">
                <div class="post-summary">
                    <h2>{{ $post->title }}</h2>
                    <time datetime="{{ $post->created_at->toISOString() }}">
                        {{ $post->created_at->format('d-m-Y H:i') }}
                    </time>
                </div>
            </a>

            @auth
                @if (Auth::id() === $post->user_id)
                    <div class="actions">
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete-button">Delete</button>
                        </form>
                        <form action="" method="GET">
                            @csrf
                            <button class="edit-button">Edit</button>
                        </form>
                    </div>
                @endif
            @endauth
        </article>
    @endforeach
@endsection