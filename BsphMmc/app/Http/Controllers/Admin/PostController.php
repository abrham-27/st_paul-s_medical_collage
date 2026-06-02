<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LatestPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private const DOCUMENT_MAX_KB = 204800; // 200 MB

    private const DOCUMENT_MIMES = 'pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar,csv,7z';

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
        $validated = $this->validatePost($request);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        $this->handleDocumentUpload($request, $validated);
        unset($validated['document_file']);

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
        $validated = $this->validatePost($request, $post);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts', 'public');
        }

        $this->handleDocumentUpload($request, $validated, $post);
        unset($validated['document_file']);

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
        if ($post->file_path) {
            Storage::disk('public')->delete($post->file_path);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    private function validatePost(Request $request, ?LatestPost $post = null): array
    {
        $isDocument = $request->input('type') === 'document';
        $hasExistingFile = $post && $post->file_path;

        $documentRules = ['nullable', 'file', 'max:' . self::DOCUMENT_MAX_KB, 'mimes:' . self::DOCUMENT_MIMES];

        if ($isDocument && ! $hasExistingFile) {
            array_unshift($documentRules, 'required');
        }

        return $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'nullable|string',
            'type'           => 'required|in:news,announcement,event,document',
            'featured_image' => 'nullable|image|max:2048',
            'document_file'  => $documentRules,
            'event_date'     => 'nullable|date|required_if:type,event',
            'author'         => 'nullable|string|max:100',
            'status'         => 'required|in:draft,published',
        ]);
    }

    private function handleDocumentUpload(Request $request, array &$validated, ?LatestPost $post = null): void
    {
        if ($request->hasFile('document_file')) {
            if ($post?->file_path) {
                Storage::disk('public')->delete($post->file_path);
            }
            $validated['file_path'] = $request->file('document_file')
                ->store('posts/documents', 'public');
            return;
        }

        if (($validated['type'] ?? null) !== 'document' && $post?->file_path) {
            Storage::disk('public')->delete($post->file_path);
            $validated['file_path'] = null;
        }
    }
}
