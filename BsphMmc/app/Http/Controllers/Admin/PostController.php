<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LatestPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = LatestPost::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->latest()->paginate(10)->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'nullable|string',
            'type'           => 'required|in:news,announcement,event,document',
            'featured_image' => 'nullable|image|max:2048',
            'event_date'     => 'nullable|date|required_if:type,event',
            'author'         => 'nullable|string|max:100',
            'status'         => 'required|in:draft,published',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        LatestPost::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function edit(LatestPost $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, LatestPost $post)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'nullable|string',
            'type'           => 'required|in:news,announcement,event,document',
            'featured_image' => 'nullable|image|max:2048',
            'event_date'     => 'nullable|date|required_if:type,event',
            'author'         => 'nullable|string|max:100',
            'status'         => 'required|in:draft,published',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        if ($validated['title'] !== $post->title) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(LatestPost $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
