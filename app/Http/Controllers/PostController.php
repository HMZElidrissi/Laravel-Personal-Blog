<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category');

        $postsQuery = Post::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%')
                ->orWhere('body', 'like', '%' . $query . '%');
        });

        // Apply category filtering if a category is selected
        if ($categoryId) {
            $postsQuery->where('category_id', $categoryId);
        }

        $posts = $postsQuery->latest('created_at')->paginate(10);
        $categories = Category::all();

        return view('home', compact('posts', 'query', 'categories', 'categoryId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|unique:posts,slug',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'nullable|string',
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Get the path to store the uploaded thumbnail (if provided)
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Post::create([
            'user_id' => $userId,
            'category_id' => $request->input('category_id'),
            'slug' => $request->input('slug'),
            'title' => $request->input('title'),
            'thumbnail' => $thumbnailPath,
            'excerpt' => $request->input('excerpt'),
            'body' => $request->input('body'),
        ]);

        return redirect()->route('posts.manage')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized access');
        }
        $categories = Category::all();
        return view('posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized access');
        }

        // Validate the request data here
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|unique:posts,slug,' . $post->id, // Add the post ID to ignore uniqueness for this post
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'nullable|string',
        ]);

        // Update the post fields
        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'category_id' => $request->input('category_id'),
            'slug' => $request->input('slug'),
            'excerpt' => $request->input('excerpt'),
        ]);

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail (if exists)
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }

            // Save the new thumbnail
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $post->update(['thumbnail' => $thumbnailPath]);
        }

        return redirect()->route('posts.manage')->with('success', 'Post updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized access');
        }

        // Delete the associated thumbnail file (if it exists)
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        // Delete the post
        $post->delete();

        return redirect()->route('posts.manage')->with('success', 'Post deleted successfully!');
    }

    public function manage()
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized access');
        }
        $posts = Post::all();
        return view('posts.manage-posts', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category');

        $postsQuery = Post::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%')
                ->orWhere('body', 'like', '%' . $query . '%');
        });

        // Apply category filtering if a category is selected
        if ($categoryId) {
            $postsQuery->whereHas('category', function ($queryBuilder) use ($categoryId) {
                $queryBuilder->where('id', $categoryId);
            });
        }

        $posts = $postsQuery->latest('created_at')->get();
        $categories = Category::all();

        return view('home', compact('posts', 'query', 'categories', 'categoryId'));
    }
}
