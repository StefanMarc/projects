@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <section class="image-wrapper">
        @if ($post->image_path)
            <img src="{{ Storage::url($post->image_path) }}" alt="Post image">
        @endif
    </section>

    <section class="post-detail-wrapper">
        <article class="post-detail {{ $post->premium ? 'post-detail-premium' : '' }}">
            <div class="post-detail-header">
                <h2>{{ $post->title }}</h2>
                <time datetime="{{ $post->created_at->toISOString() }}">
                    {{ $post->created_at->format('d-m-Y H:i') }}
                </time>
                @if ($post->categories)
                    <div class="post-categories">
                        @foreach ($post->categories as $category)
                            <span>{{ $category->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="post-detail-content">
                <p>{{ $post->content }}</p>
            </div>
            @include('partials.auth-actions')
        </article>
    </section>
    
    <section class="create-comment">
        @if (!auth()->check())
            <p class="login-prompt">Please <a href="{{ route('login') }}">log in</a> to write a comment.</p>
        @endif

        @auth
            <h2>Write a comment</h2>
            <form class="post-form" action="{{ route('comment.store', $post) }}" method="POST">
                @csrf
                <div class="field-group">
                    <label for="comment">Your comment:</label>
                    <textarea name="comment" id="comment" required placeholder="enter your text here"></textarea>
                </div>
                <button type="submit">Opslaan</button>
            </form>
        @endauth
    </section>
    

    <section class="comments-wrapper">
        <h2>Comments</h2>
        <div class="comments">
            @foreach($comments as $comment)
                <article class="comment">
                    <p>{{ $comment->comment }}</p>
                    <div class="comment-meta">
                        <span class="comment-author">{{ $comment->user->name }}</span>
                        <time datetime="{{ $comment->created_at->toISOString() }}">
                            {{ $comment->created_at->format('d-m-Y H:i') }}
                        </time>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection