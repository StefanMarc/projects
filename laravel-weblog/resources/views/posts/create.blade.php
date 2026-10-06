@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Create a new post</h1>
    <form class="post-form" action="{{ route('posts.store') }}" method="POST">
        @csrf
        
        @include('partials.post-form-fields', ['post' => $post])

            <a class="button-like" id="cancel-button" href="{{ route('posts.index') }}">Cancel</a>
        </div>
    </form>
@endsection