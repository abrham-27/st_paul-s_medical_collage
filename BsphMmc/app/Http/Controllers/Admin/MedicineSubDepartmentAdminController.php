<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineDepartment;
use App\Models\MedicineSubDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicineSubDepartmentAdminController extends Controller
{
    public function index()
    {
        $subDepartments = MedicineSubDepartment::with('department')->orderBy('display_order')->get();
        $departments = MedicineDepartment::where('status', true)->orderBy('display_order')->get();
        return view('admin.medicine.sub-departments.index', compact('subDepartments', 'departments'));
    }

    public function create()
    {
        $departments = MedicineDepartment::where('status', true)->orderBy('display_order')->get();
        return view('admin.medicine.sub-departments.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:medicine_departments,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:medicine_sub_departments,slug',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:3072',
            'image' => 'nullable|image|max:5120',
            'display_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('medicine-sub-departments', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('medicine-sub-departments/images', 'public');
        }

        $validated['status'] = $request->has('status');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        MedicineSubDepartment::create($validated);

        return redirect()->route('admin.medicine.sub-departments.index')->with('success', 'Sub-department created successfully.');
    }

    public function edit(MedicineSubDepartment $subDepartment)
    {
        $departments = MedicineDepartment::where('status', true)->orderBy('display_order')->get();
        return view('admin.medicine.sub-departments.edit', compact('subDepartment', 'departments'));
    }

    public function update(Request $request, MedicineSubDepartment $subDepartment)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:medicine_departments,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:medicine_sub_departments,slug,' . $subDepartment->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:3072',
            'image' => 'nullable|image|max:5120',
            'display_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($subDepartment->icon) {
                Storage::disk('public')->delete($subDepartment->icon);
            }
            $validated['icon'] = $request->file('icon')->store('medicine-sub-departments', 'public');
        }

        if ($request->hasFile('image')) {
            if ($subDepartment->image) {
                Storage::disk('public')->delete($subDepartment->image);
            }
            $validated['image'] = $request->file('image')->store('medicine-sub-departments/images', 'public');
        }

        $validated['status'] = $request->has('status');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $subDepartment->update($validated);

        return redirect()->route('admin.medicine.sub-departments.index')->with('success', 'Sub-department updated successfully.');
    }

    public function destroy(MedicineSubDepartment $subDepartment)
    {
        if ($subDepartment->icon) {
            Storage::disk('public')->delete($subDepartment->icon);
        }
        if ($subDepartment->image) {
            Storage::disk('public')->delete($subDepartment->image);
        }
        $subDepartment->delete();

        return redirect()->route('admin.medicine.sub-departments.index')->with('success', 'Sub-department deleted successfully.');
    }
}
