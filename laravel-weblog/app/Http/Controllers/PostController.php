<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\DeletePostRequest;
// for testing:
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'All Posts';

        $categories = Category::all();

        $selectedCategories = $request->query('categories', []);
        $premium = $request->query('premium');

        // dd($selectedCategories, $premium);

        $postsQuery = Post::with('categories')->orderBy('created_at', 'desc');
        $postsQuery = $this->filterByCategories($postsQuery, $selectedCategories);

        if ($premium) {
            $postsQuery->where('premium', '=', 1);
        }

        $posts = $postsQuery->get();

        return view('posts.index', compact('posts', 'categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['post' => new Post()], compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $post = new Post();
        
        $post->user_id = Auth::id();

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->premium = $request->boolean('premium');

        $post->image_path = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;
        
        $post->save();

        $post->categories()->attach($validated['categories'] ?? []);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        session()->put('url.intended', route('posts.show', $post));

        if ($post->premium && (!Auth::check() || !Auth::user()->premium)) {

            if (Auth::check()) {
                return redirect()
                ->route('premium', ['user' => Auth::id()])
                ->with('message', 'You need a premium account to view this post.');
            }


            return redirect()
                ->route('login')
                ->with('message', 'Please log in to access premium content.');
        }

        $comments = $post->comments()->with('user')->orderBy('created_at', 'desc')->get();

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post->fill([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'premium' => $request->boolean('premium'),
        ]);

        if ($request->hasFile('image')) {
            $post->image_path = $request->file('image')->store('images', 'public');
        }
        
        $post->save();

        $post->categories()->sync($request->input('categories', []));

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id) = w/o route model binding
    public function destroy(DeletePostRequest $request, Post $post)

    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    // Working method to show the posts of the logged-in user
    public function myPosts(Request $request)
    {
        $title = 'My Posts';

        $categories = Category::all();

        $user = $request->user();

        $postsQuery = $user->posts()->with('categories')->orderBy('created_at', 'desc');

        $selectedCategories = $request->query('categories', []);

        $postsQuery = $this->filterByCategories($postsQuery, $selectedCategories);

        $posts = $postsQuery->get();

        return view('posts.index', compact('posts', 'categories', 'title'));
    }

    private function filterByCategories($postsQuery, array $selectedCategories)
    {
        if (!empty($selectedCategories)) {
            $postsQuery->whereHas('categories', function ($query) use ($selectedCategories) {
                $query->whereIn('category_id', $selectedCategories);
            }, '>=', count($selectedCategories));
        }

        return $postsQuery;
    }

    

}
