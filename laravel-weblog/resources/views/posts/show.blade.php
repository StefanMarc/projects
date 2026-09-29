@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <section class="post-detail-wrapper">
        <article class="post-detail">
            <h2>{{ $post->title }}</h2>
            <time datetime="{{ $post->created_at->toISOString() }}">
                {{ $post->created_at->format('d-m-Y H:i') }}
            </time>
            <p>{{ $post->content }}</p>
        </article>
    </section>

    <section class="create-comment">
        <h2>Write a comment</h2>
        <form class="post-form" action="{{ route('comment.store', $post) }}" method="POST">
            @csrf
            <div class="field-group">
                <label for="comment">Your comment:</label>
                <textarea name="comment" id="comment" required placeholder="enter your text here"></textarea>
            </div>
            <button type="submit">Opslaan</button>
        </form>
    </section>

    <section class="comments-wrapper">
        <h2>Comments</h2>
        <div class="comments">
            @foreach($comments as $comment)
                <article class="comment">
                    <p>{{ $comment->comment }}</p>
                    <div class="comment-meta">
                        <span class="comment-author">User name</span>
                        <time datetime="{{ $comment->created_at->toISOString() }}">
                            {{ $comment->created_at->format('d-m-Y H:i') }}
                        </time>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection