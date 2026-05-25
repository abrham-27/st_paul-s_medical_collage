<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineDepartment;
use App\Models\MedicineSubDepartment;
use App\Models\AcademicUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicineDepartmentAdminController extends Controller
{
    // Main Departments CRUD
    public function index()
    {
        $departments = MedicineDepartment::orderBy('display_order')->get();
        return view('admin.medicine.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.medicine.departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:medicine_departments,slug',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:3072',
            'image' => 'nullable|image|max:5120',
            'display_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('medicine-departments', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('medicine-departments/images', 'public');
        }

        $validated['status'] = $request->has('status');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        MedicineDepartment::create($validated);

        return redirect()->route('admin.medicine.departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(MedicineDepartment $department)
    {
        return view('admin.medicine.departments.edit', compact('department'));
    }

    public function update(Request $request, MedicineDepartment $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:medicine_departments,slug,' . $department->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:3072',
            'image' => 'nullable|image|max:5120',
            'display_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($department->icon) {
                Storage::disk('public')->delete($department->icon);
            }
            $validated['icon'] = $request->file('icon')->store('medicine-departments', 'public');
        }

        if ($request->hasFile('image')) {
            if ($department->image) {
                Storage::disk('public')->delete($department->image);
            }
            $validated['image'] = $request->file('image')->store('medicine-departments/images', 'public');
        }

        $validated['status'] = $request->has('status');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $department->update($validated);

        return redirect()->route('admin.medicine.departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(MedicineDepartment $department)
    {
        if ($department->icon) {
            Storage::disk('public')->delete($department->icon);
        }
        if ($department->image) {
            Storage::disk('public')->delete($department->image);
        }
        $department->delete();

        return redirect()->route('admin.medicine.departments.index')->with('success', 'Department deleted successfully.');
    }

}
