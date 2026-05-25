<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcademicController extends Controller
{
    public function index(Request $request)
    {
        $query = Academic::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('department', 'like', '%' . $request->search . '%');
        }

        $academics = $query->latest()->paginate(10)->withQueryString();

        return view('admin.academics.index', compact('academics'));
    }

    public function create()
    {
        return view('admin.academics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'department'  => 'nullable|string|max:100',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('academics', 'public');
        }

        Academic::create($validated);

        return redirect()->route('admin.academics.index')
            ->with('success', 'Academic program created successfully.');
    }

    public function edit(Academic $academic)
    {
        return view('admin.academics.edit', compact('academic'));
    }

    public function update(Request $request, Academic $academic)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'department'  => 'nullable|string|max:100',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($academic->image) {
                Storage::disk('public')->delete($academic->image);
            }
            $validated['image'] = $request->file('image')->store('academics', 'public');
        }

        $academic->update($validated);

        return redirect()->route('admin.academics.index')
            ->with('success', 'Academic program updated successfully.');
    }

    public function destroy(Academic $academic)
    {
        if ($academic->image) {
            Storage::disk('public')->delete($academic->image);
        }
        $academic->delete();

        return redirect()->route('admin.academics.index')
            ->with('success', 'Academic program deleted successfully.');
    }
}
