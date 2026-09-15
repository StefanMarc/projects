@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Nieuw Item Aanmaken</h1>
    <form class="item-form" action="{{ route('items.store') }}" method="POST">
        @csrf
        <div class="field-group">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="field-group">
            <label for="description">Beschrijving:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="field-group">
            <label for="category">Categorie:</label>
            <select id="category" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Opslaan</button>
    </form>
@endsection