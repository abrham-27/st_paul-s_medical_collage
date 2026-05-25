<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineSubDepartment;
use App\Models\AcademicUnit;
use Illuminate\Http\Request;

class AcademicUnitAdminController extends Controller
{
    public function index()
    {
        $academicUnits = AcademicUnit::with('subDepartment.department')->orderBy('display_order')->get();
        $subDepartments = MedicineSubDepartment::where('status', true)->orderBy('display_order')->get();
        return view('admin.medicine.academic-units.index', compact('academicUnits', 'subDepartments'));
    }

    public function create()
    {
        $subDepartments = MedicineSubDepartment::where('status', true)->orderBy('display_order')->get();
        return view('admin.medicine.academic-units.create', compact('subDepartments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sub_department_id' => 'required|exists:medicine_sub_departments,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $validated['status'] = $request->has('status');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        AcademicUnit::create($validated);

        return redirect()->route('admin.medicine.academic-units.index')->with('success', 'Academic unit created successfully.');
    }

    public function edit(AcademicUnit $academicUnit)
    {
        $subDepartments = MedicineSubDepartment::where('status', true)->orderBy('display_order')->get();
        return view('admin.medicine.academic-units.edit', compact('academicUnit', 'subDepartments'));
    }

    public function update(Request $request, AcademicUnit $academicUnit)
    {
        $validated = $request->validate([
            'sub_department_id' => 'required|exists:medicine_sub_departments,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $validated['status'] = $request->has('status');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $academicUnit->update($validated);

        return redirect()->route('admin.medicine.academic-units.index')->with('success', 'Academic unit updated successfully.');
    }

    public function destroy(AcademicUnit $academicUnit)
    {
        $academicUnit->delete();

        return redirect()->route('admin.medicine.academic-units.index')->with('success', 'Academic unit deleted successfully.');
    }
}
