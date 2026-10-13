
<div class="posts-filter">
    <fieldset>
        <legend>Filter by Category</legend>
        <form method="GET" action="{{ url()->current() }}">
            @foreach ($categories as $category)
                <div class="checkbox-group">
                    <input
                        type="checkbox"
                        name="categories[]"
                        id="category-{{ $category->id }}"
                        value="{{ $category->id }}"
                        {{ in_array($category->id, request()->input('categories', [])) ? 'checked' : '' }}
                    >
                    <label for="category-{{ $category->id }}">{{ $category->name }}</label>
                </div>
            @endforeach
            <button type="submit">Filter</button>
        </form>
    </fieldset>
</div>