<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcademicStaffController extends Controller
{
    public function index(Request $request)
    {
        $query = AcademicStaff::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('position', 'like', '%' . $request->search . '%')
                  ->orWhere('department', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('school')) {
            $query->where('school_type', $request->school);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $staffs = $query->ordered()->paginate(15)->withQueryString();

        return view('admin.academic-staffs.index', compact('staffs'));
    }

    public function create()
    {
        return view('admin.academic-staffs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_type'   => 'required|in:medicine,nursing,public_health',
            'full_name'     => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'department'    => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:3072',
            'biography'     => 'nullable|string',
            'Qualification' => 'nullable|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'display_order' => 'nullable|integer|min:0',
            'status'        => 'required|in:active,inactive',
        ]);

        $validated['slug'] = AcademicStaff::generateSlug($validated['full_name']);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')
                ->store('staffs', 'public');
        }

        AcademicStaff::create($validated);

        return redirect()->route('admin.academic-staffs.index')
            ->with('success', 'Staff member created successfully.');
    }

    public function edit(AcademicStaff $academicStaff)
    {
        return view('admin.academic-staffs.edit', compact('academicStaff'));
    }

    public function update(Request $request, AcademicStaff $academicStaff)
    {
        $validated = $request->validate([
            'school_type'   => 'required|in:medicine,nursing,public_health',
            'full_name'     => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'department'    => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:3072',
            'biography'     => 'nullable|string',
            'Qualification' => 'nullable|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'display_order' => 'nullable|integer|min:0',
            'status'        => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($academicStaff->profile_image) {
                Storage::disk('public')->delete($academicStaff->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')
                ->store('staffs', 'public');
        }

        $academicStaff->update($validated);

        return redirect()->route('admin.academic-staffs.index')
            ->with('success', 'Staff member updated successfully.');
    }

    public function destroy(AcademicStaff $academicStaff)
    {
        if ($academicStaff->profile_image) {
            Storage::disk('public')->delete($academicStaff->profile_image);
        }
        $academicStaff->delete();

        return redirect()->route('admin.academic-staffs.index')
            ->with('success', 'Staff member deleted successfully.');
    }
}
