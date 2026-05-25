<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->orderBy('sort_order')->paginate(12)->withQueryString();
        $categories = Gallery::select('category')->distinct()->whereNotNull('category')->pluck('category');

        return view('admin.gallery.index', compact('galleries', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'images'   => 'required|array',
            'images.*' => 'image|max:4096',
        ]);

        foreach ($request->file('images') as $file) {
            Gallery::create([
                'title'      => $request->title,
                'category'   => $request->category,
                'image'      => $file->store('gallery', 'public'),
                'sort_order' => Gallery::max('sort_order') + 1,
            ]);
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Images uploaded successfully.');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
        ]);

        $gallery->update($request->only('title', 'category'));

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item updated.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);

        foreach ($request->order as $index => $id) {
            Gallery::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
