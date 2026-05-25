<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcademicProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = AcademicProject::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->orderBy('display_order')->paginate(15)->withQueryString();

        return view('admin.academic-projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.academic-projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'slug'           => 'nullable|string|max:255|unique:academic_projects,slug',
            'description'    => 'nullable|string',
            'featured_image' => 'nullable|image|max:3072',
            'display_order'  => 'nullable|integer|min:0',
            'status'         => 'required|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? AcademicProject::generateSlug($validated['title']);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('academic-projects', 'public');
        }

        AcademicProject::create($validated);

        return redirect()->route('admin.academic-projects.index')
            ->with('success', 'Academic project created successfully.');
    }

    public function edit(AcademicProject $academicProject)
    {
        return view('admin.academic-projects.edit', compact('academicProject'));
    }

    public function update(Request $request, AcademicProject $academicProject)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'slug'           => 'nullable|string|max:255|unique:academic_projects,slug,' . $academicProject->id,
            'description'    => 'nullable|string',
            'featured_image' => 'nullable|image|max:3072',
            'display_order'  => 'nullable|integer|min:0',
            'status'         => 'required|boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($academicProject->featured_image) {
                Storage::disk('public')->delete($academicProject->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('academic-projects', 'public');
        }

        $academicProject->update($validated);

        return redirect()->route('admin.academic-projects.index')
            ->with('success', 'Academic project updated successfully.');
    }

    public function destroy(AcademicProject $academicProject)
    {
        if ($academicProject->featured_image) {
            Storage::disk('public')->delete($academicProject->featured_image);
        }
        $academicProject->delete();

        return redirect()->route('admin.academic-projects.index')
            ->with('success', 'Academic project deleted successfully.');
    }
}
