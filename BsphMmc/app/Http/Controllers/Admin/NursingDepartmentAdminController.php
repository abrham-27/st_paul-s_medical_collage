<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NursingDepartment;
use App\Models\NursingDepartmentLanding;
use Illuminate\Http\Request;

class NursingDepartmentAdminController extends Controller
{
    public function index()
    {
        $departments = NursingDepartment::orderBy('display_order')->orderBy('title')->get();

        return view('admin.nursing.departments.index', compact('departments'));
    }

    public function landing()
    {
        $landing = NursingDepartmentLanding::getSettings();

        return view('admin.nursing.departments.landing', compact('landing'));
    }

    public function updateLanding(Request $request)
    {
        $validated = $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'excellence_json' => 'nullable|string',
            'stats_json' => 'nullable|string',
            'programs_json' => 'nullable|string',
        ]);

        $landing = NursingDepartmentLanding::getSettings();

        $excellence = $this->decodeJsonField($validated['excellence_json'] ?? null, $landing->excellence ?? []);
        $stats = $this->decodeJsonField($validated['stats_json'] ?? null, $landing->stats ?? []);
        $programs = $this->decodeJsonField($validated['programs_json'] ?? null, $landing->programs ?? []);

        $landing->update([
            'hero_title' => $validated['hero_title'] ?? $landing->hero_title,
            'hero_subtitle' => $validated['hero_subtitle'] ?? $landing->hero_subtitle,
            'excellence' => $excellence,
            'stats' => $stats,
            'programs' => $programs,
        ]);

        return back()->with('success', 'Departments landing page updated successfully.');
    }

    public function edit(NursingDepartment $department)
    {
        return view('admin.nursing.departments.edit', compact('department'));
    }

    public function update(Request $request, NursingDepartment $department)
    {
        $validated = $request->validate([
            'icon' => 'nullable|string|max:10',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features_text' => 'nullable|string',
            'detail_json' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $features = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $validated['features_text'] ?? ''))));

        $detail = $this->decodeJsonField($validated['detail_json'] ?? null, $department->detail ?? []);

        $department->update([
            'icon' => $validated['icon'] ?? $department->icon,
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'features' => $features,
            'detail' => $detail,
            'display_order' => $validated['display_order'] ?? 0,
            'status' => $request->has('status'),
        ]);

        return redirect()
            ->route('admin.nursing.departments.index')
            ->with('success', 'Department updated successfully.');
    }

    private function decodeJsonField(?string $json, array $fallback): array
    {
        if (!$json) {
            return $fallback;
        }

        $decoded = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            return $fallback;
        }

        return $decoded;
    }
}
