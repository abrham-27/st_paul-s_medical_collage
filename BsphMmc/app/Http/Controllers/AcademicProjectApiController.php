<?php

namespace App\Http\Controllers;

use App\Models\AcademicProject;
use Illuminate\Http\JsonResponse;

class AcademicProjectApiController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = AcademicProject::where('status', true)
            ->orderBy('display_order')
            ->get();

        return response()->json(['success' => true, 'data' => $projects]);
    }

    public function show(string $slug): JsonResponse
    {
        $project = AcademicProject::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return response()->json(['success' => true, 'data' => $project]);
    }
}
