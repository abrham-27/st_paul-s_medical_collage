<?php

namespace App\Http\Controllers;

use App\Models\MedicineDepartment;
use App\Models\NursingDepartment;
use Illuminate\Http\JsonResponse;

class DepartmentsApiController extends Controller
{
    public function index(string $school): JsonResponse
    {
        if (! in_array($school, ['medicine', 'nursing', 'public_health'], true)) {
            return response()->json(['success' => false, 'message' => 'Invalid school type'], 400);
        }

        if ($school === 'medicine') {
            $departments = MedicineDepartment::where('status', 1)
                ->orderBy('display_order')
                ->get()
                ->map(fn ($department) => [
                    'value' => $department->name,
                    'label' => $department->name,
                ])
                ->values();
        } elseif ($school === 'nursing') {
            $departments = NursingDepartment::where('status', 1)
                ->orderBy('display_order')
                ->get()
                ->map(fn ($department) => [
                    'value' => $department->title,
                    'label' => $department->title,
                ])
                ->values();
        } else {
            $departments = collect([
                ['value' => 'Epidemiology and Biostatistics', 'label' => 'Epidemiology and Biostatistics'],
                ['value' => 'Health Policy and Management', 'label' => 'Health Policy and Management'],
                ['value' => 'Environmental and Occupational Health', 'label' => 'Environmental and Occupational Health'],
                ['value' => 'Nutrition and Population Health', 'label' => 'Nutrition and Population Health'],
            ]);
        }

        return response()->json(['success' => true, 'data' => $departments]);
    }
}
