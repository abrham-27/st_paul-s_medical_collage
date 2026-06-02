<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class PartnerController extends Controller
{
    public function index(Request $request): View
    {
        $query = Partner::query();

        if ($request->has('category') && $request->category !== '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('short_description', 'like', "%$search%");
            });
        }

        $partners = $query->orderBy('display_order')->paginate(15);
        $categories = PartnerCategory::orderBy('display_order')->get();

        return view('admin.partnerships.partners.index', compact('partners', 'categories'));
    }

    public function create(): View
    {
        $categories = PartnerCategory::orderBy('display_order')->get();
        return view('admin.partnerships.partners.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:partners',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'category_id' => 'nullable|exists:partner_categories,id',
            'website_url' => 'nullable|url',
            'partnership_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'collaboration_type' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:4096',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_image_url'] = $request->file('logo')->store('partnerships/logos', 'public');
        }
        unset($validated['logo']);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        Partner::create($validated);

        return redirect()->route('admin.partnerships.partners.index')
            ->with('success', 'Partner created successfully!');
    }

    public function edit(Partner $partner): View
    {
        $categories = PartnerCategory::orderBy('display_order')->get();
        return view('admin.partnerships.partners.edit', compact('partner', 'categories'));
    }

    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:partners,name,' . $partner->id,
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'category_id' => 'nullable|exists:partner_categories,id',
            'website_url' => 'nullable|url',
            'partnership_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'collaboration_type' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:4096',
            'display_order' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $oldPath = $partner->getRawOriginal('logo_image_url');
            if ($oldPath && !str_starts_with($oldPath, 'http')) {
                Storage::disk('public')->delete($oldPath);
            }
            $validated['logo_image_url'] = $request->file('logo')->store('partnerships/logos', 'public');
        }
        unset($validated['logo']);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        $partner->update($validated);

        return redirect()->route('admin.partnerships.partners.index')
            ->with('success', 'Partner updated successfully!');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->update(['is_active' => false]);

        return redirect()->route('admin.partnerships.partners.index')
            ->with('success', 'Partner deactivated successfully!');
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*' => 'required|integer|exists:partners,id',
        ]);

        foreach ($validated['items'] as $index => $id) {
            Partner::find($id)->update(['display_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
