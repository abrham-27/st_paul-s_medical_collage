<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicStaff;
use App\Models\AcademicPage;
use App\Models\MedicinePartnership;

class AcademicsSchoolController extends Controller
{
    private const SCHOOLS = [
        'medicine'     => 'School of Medicine',
        'nursing'      => 'School of Nursing',
        'public_health' => 'School of Public Health',
    ];

    public function show(string $school)
    {
        if (!array_key_exists($school, self::SCHOOLS)) {
            abort(404);
        }

        $schoolName  = self::SCHOOLS[$school];
        $staffCount  = AcademicStaff::bySchool($school)->count();
        $activeStaff = AcademicStaff::bySchool($school)->active()->count();
        $overviewPage    = AcademicPage::where('school_type', $school)->where('page_type', 'overview')->first();
        $partnershipPage = AcademicPage::where('school_type', $school)->where('page_type', 'partnership')->first();
        $partnershipsCount = $school === 'medicine'
            ? MedicinePartnership::count()
            : null;

        return view('admin.academics.school', compact(
            'school', 'schoolName', 'staffCount', 'activeStaff',
            'overviewPage', 'partnershipPage', 'partnershipsCount'
        ));
    }
}
