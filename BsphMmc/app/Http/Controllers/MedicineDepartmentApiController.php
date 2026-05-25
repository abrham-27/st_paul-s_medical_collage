<?php

namespace App\Http\Controllers;

use App\Models\AcademicUnit;
use App\Models\MedicineDepartment;
use App\Models\MedicineSubDepartment;
use Illuminate\Http\JsonResponse;

class MedicineDepartmentApiController extends Controller
{
    public function index()
    {
        $departments = MedicineDepartment::where('status',1)
            ->orderBy('display_order')
            ->get();

        return response()->json($departments);
    }

    public function show($slug)
    {
        $department = MedicineDepartment::where('slug', $slug)
            ->where('status', 1)
            ->with(['subDepartments' => function ($query) {
                $query->where('status', 1)->orderBy('display_order');
            }])
            ->firstOrFail();

        return response()->json($department);
    }

    public function showSubDepartment(int $id): JsonResponse
    {
        $subDepartment = MedicineSubDepartment::where('id', $id)
            ->where('status', true)
            ->firstOrFail();

        $subDepartment->setRelation(
            'academicUnits',
            $this->academicUnitsQuery($id)->get()
        );

        return response()->json($subDepartment);
    }

    public function academicUnitsForSubDepartment(int $id): JsonResponse
    {
        MedicineSubDepartment::where('id', $id)->where('status', true)->firstOrFail();

        return response()->json($this->academicUnitsQuery($id)->get());
    }

    private function academicUnitsQuery(int $subDepartmentId)
    {
        return AcademicUnit::where('sub_department_id', $subDepartmentId)
            ->where('status', true)
            ->orderBy('display_order');
    }

    public function showSubDepartmentBySlug(string $slug): JsonResponse
    {
        $subDepartment = MedicineSubDepartment::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $subDepartment->setRelation(
            'academicUnits',
            $this->academicUnitsQuery($subDepartment->id)->get()
        );

        return response()->json($subDepartment);
    }
}