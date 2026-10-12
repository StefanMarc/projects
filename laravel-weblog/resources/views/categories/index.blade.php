@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Categories</h1>
        <form class="category-form" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="field-group">
                <label for="category-name">Category Name:</label>
                <input type="text" id="category-name" name="name" required>
            </div>
            <button class="add-category-button">Add Category</button>
        </form>
    @foreach ($categories as $category)
        <article class="category-card">
                <div class="category-summary">
                    <div class="category-heading">
                        <h2>{{ $category->name }}</h2>
                    </div>
                </div>
                <div class="category-actions">
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="delete-button">Delete</button>
                    </form>
                </div>
        </article>
    @endforeach

@endsection