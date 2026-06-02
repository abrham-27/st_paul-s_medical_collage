<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class SuccessStoryController extends Controller
{
    public function index(): View
    {
        $stories = SuccessStory::orderBy('display_order')->paginate(15);
        return view('admin.partnerships.stories.index', compact('stories'));
    }

    public function create(): View
    {
        return view('admin.partnerships.stories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:success_stories',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('partnerships/stories', 'public');
        }
        unset($validated['image']);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        SuccessStory::create($validated);

        return redirect()->route('admin.partnerships.success-stories.index')
            ->with('success', 'Success story created successfully!');
    }

    public function edit(SuccessStory $story): View
    {
        return view('admin.partnerships.stories.create', compact('story'));
    }

    public function update(Request $request, SuccessStory $story): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:success_stories,title,' . $story->id,
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $oldPath = $story->getRawOriginal('image_url');
            if ($oldPath && !str_starts_with($oldPath, 'http')) {
                Storage::disk('public')->delete($oldPath);
            }
            $validated['image_url'] = $request->file('image')->store('partnerships/stories', 'public');
        }
        unset($validated['image']);

        $validated['is_active'] = $request->boolean('is_active', true);

        $story->update($validated);

        return redirect()->route('admin.partnerships.success-stories.index')
            ->with('success', 'Success story updated successfully!');
    }

    public function destroy(SuccessStory $story): RedirectResponse
    {
        $path = $story->getRawOriginal('image_url');
        if ($path && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
        $story->delete();

        return redirect()->route('admin.partnerships.success-stories.index')
            ->with('success', 'Success story deleted successfully!');
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*' => 'required|integer|exists:success_stories,id',
        ]);

        foreach ($validated['items'] as $index => $id) {
            SuccessStory::find($id)->update(['display_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
