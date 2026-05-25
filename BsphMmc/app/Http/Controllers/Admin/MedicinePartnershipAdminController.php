<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicinePartnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicinePartnershipAdminController extends Controller
{
    public function index()
    {
        $partnerships = MedicinePartnership::orderBy('display_order')->orderBy('title')->get();

        return view('admin.medicine.partnerships.index', compact('partnerships'));
    }

    public function create()
    {
        return view('admin.medicine.partnerships.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = MedicinePartnership::generateUniqueSlug($validated['title']);
        $validated['status'] = $request->has('status');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('medicine-partnerships', 'public');
        }

        MedicinePartnership::create($validated);

        return redirect()
            ->route('admin.medicine.partnership')
            ->with('success', 'Partnership created successfully.');
    }

    public function edit(MedicinePartnership $partnership)
    {
        return view('admin.medicine.partnerships.edit', compact('partnership'));
    }

    public function update(Request $request, MedicinePartnership $partnership)
    {
        $validated = $this->validated($request);
        $validated['slug'] = MedicinePartnership::generateUniqueSlug(
            $validated['title'],
            $partnership->id
        );
        $validated['status'] = $request->has('status');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            if ($partnership->featured_image) {
                Storage::disk('public')->delete($partnership->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('medicine-partnerships', 'public');
        }

        $partnership->update($validated);

        return redirect()
            ->route('admin.medicine.partnership')
            ->with('success', 'Partnership updated successfully.');
    }

    public function destroy(MedicinePartnership $partnership)
    {
        if ($partnership->featured_image) {
            Storage::disk('public')->delete($partnership->featured_image);
        }

        $partnership->delete();

        return redirect()
            ->route('admin.medicine.partnership')
            ->with('success', 'Partnership deleted successfully.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'area' => 'required|in:local,international',
            'featured_image' => 'nullable|image|max:3072',
            'display_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);
    }
}
