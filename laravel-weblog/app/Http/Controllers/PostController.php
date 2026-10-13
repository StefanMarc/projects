<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

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

        $postsQuery = Post::with('categories')->orderBy('created_at', 'desc');
        $postsQuery = $this->filterByCategories($postsQuery, $selectedCategories);

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
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->save();
        $post->categories()->attach($request->input('categories', []));

        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // first method, works
        // $comments = DB::table('comments')
        // ->where('post_id', '=', $post->id)
        // ->get();

        // second method, also works
        $comments = $post->comments()->orderBy('created_at', 'desc')->get();

        // dd($comments);

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
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        $post->categories()->sync($request->input('categories', []));
        // dd($request->all());
        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id) = w/o route model binding
    public function destroy(Post $post)

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
