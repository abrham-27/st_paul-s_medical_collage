<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipStatistic;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class PartnershipStatisticController extends Controller
{
    public function index(): View
    {
        $statistics = PartnershipStatistic::orderBy('display_order')->paginate(15);
        return view('admin.partnerships.statistics.index', compact('statistics'));
    }

    public function create(): View
    {
        return view('admin.partnerships.statistics.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        PartnershipStatistic::create($validated);

        return redirect()->route('admin.partnerships.statistics.index')
            ->with('success', 'Statistic created successfully!');
    }

    public function edit(PartnershipStatistic $statistic): View
    {
        return view('admin.partnerships.statistics.create', compact('statistic'));
    }

    public function update(Request $request, PartnershipStatistic $statistic): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:50',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $statistic->update($validated);

        return redirect()->route('admin.partnerships.statistics.index')
            ->with('success', 'Statistic updated successfully!');
    }

    public function destroy(PartnershipStatistic $statistic): RedirectResponse
    {
        $statistic->delete();
        return redirect()->route('admin.partnerships.statistics.index')
            ->with('success', 'Statistic deleted successfully!');
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*' => 'required|integer|exists:partnership_statistics,id',
        ]);

        foreach ($validated['items'] as $index => $id) {
            PartnershipStatistic::find($id)->update(['display_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
