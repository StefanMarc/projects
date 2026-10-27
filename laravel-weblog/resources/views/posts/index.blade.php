@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>{{ $title }}</h1>
    <div class="layout">

        @include('partials.sidebar')

        <div class="posts-container">
            @foreach ($posts as $post)
                <article class="post-card {{ $post->premium ? 'post-card-premium' : '' }}">
                    <a class="post-link" href="{{ route('posts.show', $post) }}">
                        <div class="post-summary">
                            <div class="post-heading">
                                <h2>{{ $post->title }}</h2>
                                @if ($post->categories)
                                    <div class="post-categories post-categories-index">
                                        @foreach ($post->categories as $category)
                                            <span>{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <time datetime="{{ $post->created_at->toISOString() }}">
                                {{ $post->created_at->format('d-m-Y H:i') }}
                            </time>
                        </div>
                    </a>
                    @include('partials.auth-actions')
                </article>
            @endforeach
        </div>
    </div>
@endsection