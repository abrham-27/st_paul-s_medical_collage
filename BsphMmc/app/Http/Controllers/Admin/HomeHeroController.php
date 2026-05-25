<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeHeroController extends Controller
{
    public function index()
    {
        $slides = HomeHero::ordered()->get();
        return view('admin.home-content.hero.index', compact('slides'));
    }

    public function create()
    {
        $maxOrder = HomeHero::max('display_order') ?? 0;
        return view('admin.home-content.hero.create', ['nextOrder' => $maxOrder + 1]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:20480',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'display_order' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('home/hero');

            if (! File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $validated['image'] = 'home/hero/' . $filename;
        }

        HomeHero::create($validated);

        return redirect()->route('admin.home-content.hero.index')
                        ->with('success', 'Hero slide created successfully.');
    }

    public function edit(HomeHero $hero)
    {
        return view('admin.home-content.hero.edit', compact('hero'));
    }

    public function update(Request $request, HomeHero $hero)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:20480',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'display_order' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($hero->image) {
                $existingPath = public_path($hero->image);
                if (File::exists($existingPath)) {
                    File::delete($existingPath);
                }
                if (Storage::disk('public')->exists($hero->image)) {
                    Storage::disk('public')->delete($hero->image);
                }
            }

            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('home/hero');

            if (! File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $validated['image'] = 'home/hero/' . $filename;
        }

        $hero->update($validated);

        return redirect()->route('admin.home-content.hero.index')
                        ->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(HomeHero $hero)
    {
        // Delete image if exists
        if ($hero->image) {
            $existingPath = public_path($hero->image);
            if (File::exists($existingPath)) {
                File::delete($existingPath);
            }
            if (Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }
        }

        $hero->delete();

        return redirect()->route('admin.home-content.hero.index')
                        ->with('success', 'Hero slide deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $items = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:home_hero_sections,id',
            'items.*.order' => 'required|integer',
        ]);

        foreach ($items['items'] as $item) {
            HomeHero::find($item['id'])->update(['display_order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
