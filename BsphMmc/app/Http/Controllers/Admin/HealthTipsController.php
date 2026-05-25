<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthCategory;
use App\Models\HealthDisease;
use Illuminate\Http\Request;

class HealthTipsController extends Controller
{
    // ── Categories ────────────────────────────────────────────

    public function index()
    {
        $categories = HealthCategory::withCount('diseases')->ordered()->get();
        return view('admin.health-tips.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:10',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        HealthCategory::create([
            'name'        => $request->name,
            'description' => $request->description,
            'icon'        => $request->icon,
            'sort_order'  => $request->sort_order ?? HealthCategory::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.health-tips.index')
            ->with('success', 'Category created successfully.');
    }

    public function updateCategory(Request $request, HealthCategory $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:10',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $category->update($request->only('name', 'description', 'icon', 'sort_order'));

        return redirect()->route('admin.health-tips.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(HealthCategory $category)
    {
        $category->delete(); // cascades to diseases
        return redirect()->route('admin.health-tips.index')
            ->with('success', 'Category deleted.');
    }

    // ── Diseases ──────────────────────────────────────────────

    public function diseases(HealthCategory $category)
    {
        $diseases = $category->diseases()->get();
        return view('admin.health-tips.diseases', compact('category', 'diseases'));
    }

    public function storeDisease(Request $request, HealthCategory $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'symptoms'    => 'nullable|string',
            'prevention'  => 'nullable|string',
            'advice'      => 'nullable|string',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        HealthDisease::create([
            'health_category_id' => $category->id,
            'name'               => $request->name,
            'description'        => $request->description,
            'symptoms'           => $this->parseLines($request->symptoms),
            'prevention'         => $this->parseLines($request->prevention),
            'advice'             => $this->parseLines($request->advice),
            'sort_order'         => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.health-tips.diseases', $category)
            ->with('success', 'Disease added successfully.');
    }

    public function updateDisease(Request $request, HealthCategory $category, HealthDisease $disease)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'symptoms'    => 'nullable|string',
            'prevention'  => 'nullable|string',
            'advice'      => 'nullable|string',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $disease->update([
            'name'        => $request->name,
            'description' => $request->description,
            'symptoms'    => $this->parseLines($request->symptoms),
            'prevention'  => $this->parseLines($request->prevention),
            'advice'      => $this->parseLines($request->advice),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.health-tips.diseases', $category)
            ->with('success', 'Disease updated successfully.');
    }

    public function destroyDisease(HealthCategory $category, HealthDisease $disease)
    {
        $disease->delete();
        return redirect()->route('admin.health-tips.diseases', $category)
            ->with('success', 'Disease deleted.');
    }

    /** Convert textarea lines to array, filtering blanks */
    private function parseLines(?string $text): array
    {
        if (!$text) return [];
        return array_values(array_filter(
            array_map('trim', explode("\n", $text))
        ));
    }
}
