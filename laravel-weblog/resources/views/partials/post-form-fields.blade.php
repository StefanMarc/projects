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

<fieldset>
    <legend for="image">Add an image</legend>
    <input
        type="file"
        name="image"
        id="image"
        accept="image/*"
    >
    <img id="image-preview" alt="No previous image"
        @if ($post->image_path)
            src="{{ Storage::url($post->image_path) }}"
        @endif
    >
</fieldset>

<fieldset>
    <legend for="premium">Premium</legend>
    <input type="checkbox" id="premium" name="premium" value="1" 
    @checked(old('premium', $post->premium))>
</fieldset>

<div class="actions">
    <button type="submit">Save</button>