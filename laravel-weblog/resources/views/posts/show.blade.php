@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class="post-detail-wrapper">
        <article class="post-detail">
            <h2>{{ $post->title }}</h2>
            <time datetime="{{ $post->created_at->toISOString() }}">
                {{ $post->created_at->format('d-m-Y H:i') }}
            </time>
            <p>{{ $post->content }}</p>
        </article>
    </div>

    <div class="comments-wrapper">
        <h2>Comments</h2>
    </div>
@endsection