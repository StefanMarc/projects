@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Item Bewerken</h1>
    <form class="item-form" action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="field-group">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" value="{{ $item->name }}" required>
        </div>

        <div class="field-group">
            <label for="description">Beschrijving:</label>
            <textarea id="description" name="description"><?php echo e($item->description); ?></textarea>
        </div>

        <div class="field-group">
            <label for="category">Categorie:</label>
            <select id="category" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Bijwerken</button>
    </form>
@endsection