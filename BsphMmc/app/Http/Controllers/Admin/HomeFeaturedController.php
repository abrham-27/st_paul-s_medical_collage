<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeFeatured;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeFeaturedController extends Controller
{
    public function index()
    {
        $slides = HomeFeatured::ordered()->get();
        return view('admin.home-content.featured.index', compact('slides'));
    }

    public function create()
    {
        $maxOrder = HomeFeatured::max('display_order') ?? 0;
        return view('admin.home-content.featured.create', ['nextOrder' => $maxOrder + 1]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'display_order' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('home/featured', 'public');
            $validated['image'] = $path;
        }

        HomeFeatured::create($validated);

        return redirect()->route('admin.home-content.featured.index')
                        ->with('success', 'Featured slide created successfully.');
    }

    public function edit(HomeFeatured $featured)
    {
        return view('admin.home-content.featured.edit', compact('featured'));
    }

    public function update(Request $request, HomeFeatured $featured)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'display_order' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($featured->image && Storage::disk('public')->exists($featured->image)) {
                Storage::disk('public')->delete($featured->image);
            }

            $path = $request->file('image')->store('home/featured', 'public');
            $validated['image'] = $path;
        }

        $featured->update($validated);

        return redirect()->route('admin.home-content.featured.index')
                        ->with('success', 'Featured slide updated successfully.');
    }

    public function destroy(HomeFeatured $featured)
    {
        // Delete image if exists
        if ($featured->image && Storage::disk('public')->exists($featured->image)) {
            Storage::disk('public')->delete($featured->image);
        }

        $featured->delete();

        return redirect()->route('admin.home-content.featured.index')
                        ->with('success', 'Featured slide deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $items = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:home_featured_sections,id',
            'items.*.order' => 'required|integer',
        ]);

        foreach ($items['items'] as $item) {
            HomeFeatured::find($item['id'])->update(['display_order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
