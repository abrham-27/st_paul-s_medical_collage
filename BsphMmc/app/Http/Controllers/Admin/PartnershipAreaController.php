<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipArea;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class PartnershipAreaController extends Controller
{
    public function index(): View
    {
        $areas = PartnershipArea::orderBy('display_order')->paginate(15);
        return view('admin.partnerships.areas.index', compact('areas'));
    }

    public function create(): View
    {
        return view('admin.partnerships.areas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:partnership_areas',
            'description' => 'nullable|string',
            'icon_class' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        PartnershipArea::create($validated);

        return redirect()->route('admin.partnerships.areas.index')
            ->with('success', 'Partnership area created successfully!');
    }

    public function edit(PartnershipArea $area): View
    {
        return view('admin.partnerships.areas.create', compact('area'));
    }

    public function update(Request $request, PartnershipArea $area): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:partnership_areas,title,' . $area->id,
            'description' => 'nullable|string',
            'icon_class' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $area->update($validated);

        return redirect()->route('admin.partnerships.areas.index')
            ->with('success', 'Partnership area updated successfully!');
    }

    public function destroy(PartnershipArea $area): RedirectResponse
    {
        $area->delete();
        return redirect()->route('admin.partnerships.areas.index')
            ->with('success', 'Partnership area deleted successfully!');
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*' => 'required|integer|exists:partnership_areas,id',
        ]);

        foreach ($validated['items'] as $index => $id) {
            PartnershipArea::find($id)->update(['display_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
