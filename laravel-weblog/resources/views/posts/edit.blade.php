@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Editing post...</h1>
    <form class="post-form" action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        @include('partials.post-form-fields', ['post' => $post])

            <a class="button-like" id="cancel-button" href="{{ route('posts.show', $post) }}">Cancel</a>
        </div>
    </form>
@endsection