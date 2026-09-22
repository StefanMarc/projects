@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Posts</h1>
    @foreach ($posts as $post)
        <!-- !!! ADD ACTION posts.show !!! -->
        <a class="post-link">
            <article>
                <h2>{{ $post->title }}</h2>
                <time datetime="{{ $post->created_at->toISOString() }}">
                    {{ $post->created_at->format('d-m-Y H:i') }}
                </time>
            </article>
            <div class="actions">
                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="delete-button">Delete</button>
                </form>
                <form action="{{ route('posts.edit', $post) }}" method="POST">
                    <button class="edit-button">Edit</button>
                </form>
            </div>
        </a>

    @endforeach
@endsection