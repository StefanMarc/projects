@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Create a new post</h1>
    <form class="post-form" action="{{ 'route.store' }}" method="POST">
        <div class="field-group">
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div class="field-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" required placeholder="enter your text here:"></textarea>
        </div>

        <button type="submit">Opslaan</button>

    </form>
@endsection