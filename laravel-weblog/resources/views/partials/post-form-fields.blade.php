<div class="field-group">
    <label for="title">Title</label>
    <input
        type="text"
        name="title"
        id="title"
        value="{{ old('title', $post->title) }}"
        required
    >
</div>

<div class="field-group">
    <label for="content">Content</label>
    <textarea
        name="content"
        id="content"
        required
        placeholder="Enter your text here:"
    >{{ old('content', $post->content) }}</textarea>
</div>

<!-- <div class="field-group">
    <label for="categories">Categories</label>
    <select name="categories[]" id="categories" multiple size="5" selected>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $post->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div> -->

<fieldset>
    <legend>Categories</legend>
    @foreach ($categories as $category)
        <div class="checkbox-group">
            <input
                type="checkbox"
                name="categories[]"
                id="category-{{ $category->id }}"
                value="{{ $category->id }}"
                {{ in_array($category->id, old('categories', $post->categories->pluck('id')->toArray())) ? 'checked' : '' }}
            >
            <label for="category-{{ $category->id }}">{{ $category->name }}</label>
        </div>
    @endforeach
</fieldset>

<div class="actions">
    <button type="submit">Save</button>