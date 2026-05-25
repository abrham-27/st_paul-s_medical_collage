<?php

namespace App\Http\Controllers;

use App\Models\AcademicStaff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcademicStaffApiController extends Controller
{
    public function bySchool(Request $request, string $school): JsonResponse
    {
        $allowed = ['medicine', 'nursing', 'public_health'];
        if (!in_array($school, $allowed)) {
            return response()->json(['success' => false, 'message' => 'Invalid school type'], 400);
        }

        $staffsQuery = AcademicStaff::bySchool($school)
            ->active()
            ->ordered();

        if ($department = trim($request->query('department', ''))) {
            $normalized = strtolower($department);
            $staffsQuery->whereRaw('LOWER(department) LIKE ?', ["%{$normalized}%"]);
        }

        $staffs = $staffsQuery
            ->get()
            ->map(fn($s) => $this->transform($s));

        return response()->json(['success' => true, 'data' => $staffs]);
    }

    public function show(string $school, string $slug): JsonResponse
    {
        $staff = AcademicStaff::where('school_type', $school)
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        return response()->json(['success' => true, 'data' => $this->transform($staff)]);
    }

    private function transform(AcademicStaff $s): array
    {
        return [
            'id'            => $s->id,
            'school_type'   => $s->school_type,
            'full_name'     => $s->full_name,
            'slug'          => $s->slug,
            'position'      => $s->position,
            'department'    => $s->department,
            'profile_image' => $s->profile_image
                ? ($s->profile_image && !str_starts_with($s->profile_image, 'http')
                    ? asset('storage/' . $s->profile_image)
                    : $s->profile_image)
                : null,
            'biography'     => $s->biography,
            'Qualification' => $s->Qualification,
            'email'         => $s->email,
            'phone'         => $s->phone,
        ];
    }
}
