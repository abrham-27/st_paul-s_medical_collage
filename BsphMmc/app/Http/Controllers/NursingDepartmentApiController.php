<?php

namespace App\Http\Controllers;

use App\Models\NursingDepartment;
use App\Models\NursingDepartmentLanding;
use Illuminate\Http\JsonResponse;

class NursingDepartmentApiController extends Controller
{
    public function index(): JsonResponse
    {
        $landing = NursingDepartmentLanding::getSettings();
        $departments = NursingDepartment::where('status', true)
            ->orderBy('display_order')
            ->orderBy('title')
            ->get()
            ->map(fn ($dept) => $this->formatListItem($dept));

        return response()->json([
            'landing' => [
                'hero_title' => $landing->hero_title,
                'hero_subtitle' => $landing->hero_subtitle,
                'excellence' => $landing->excellence ?? [],
                'stats' => $landing->stats ?? [],
                'programs' => $landing->programs ?? [],
            ],
            'departments' => $departments,
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $department = NursingDepartment::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return response()->json($this->formatDetail($department));
    }

    private function formatListItem(NursingDepartment $department): array
    {
        return [
            'id' => $department->id,
            'slug' => $department->slug,
            'icon' => $department->icon,
            'title' => $department->title,
            'subtitle' => $department->subtitle,
            'description' => $department->description,
            'features' => $department->features ?? [],
        ];
    }

    private function formatDetail(NursingDepartment $department): array
    {
        $detail = $department->detail ?? [];

        return [
            'id' => $department->id,
            'slug' => $department->slug,
            'icon' => $department->icon,
            'title' => $department->title,
            'page_title' => $detail['page_title'] ?? $department->title,
            'subtitle' => $department->subtitle,
            'description' => $department->description,
            'features' => $department->features ?? [],
            'hero_tagline' => $detail['hero_tagline'] ?? $department->subtitle,
            'mission_text' => $detail['mission_text'] ?? null,
            'intro' => $detail['intro'] ?? null,
            'areas' => $detail['areas'] ?? [],
            'training' => $detail['training'] ?? [],
            'careers' => $detail['careers'] ?? [],
            'stats' => $detail['stats'] ?? [],
        ];
    }
}
