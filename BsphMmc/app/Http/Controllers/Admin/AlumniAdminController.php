<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AlumniAdminController extends Controller
{
    /**
     * Display a listing of all alumni.
     */
    public function index(Request $request): View
    {
        $query = Alumni::query();

        // Optional filtering by search term in admin panel
        if ($request->filled('search')) {
            $search = '%' . $request->input('search') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('email', 'like', $search)
                  ->orWhere('specialty', 'like', $search)
                  ->orWhere('workplace', 'like', $search);
            });
        }

        $alumni = $query->orderBy('is_active', 'asc') // Pending first
                        ->orderBy('graduation_year', 'desc')
                        ->paginate(15);

        return view('admin.alumni.index', compact('alumni'));
    }

    /**
     * Show the form for creating a new alumnus.
     */
    public function create(): View
    {
        $alumni = null;
        return view('admin.alumni.create', compact('alumni'));
    }

    /**
     * Store a newly created alumnus in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:2000|max:' . (date('Y') + 5),
            'degree' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'current_position' => 'nullable|string|max:255',
            'workplace' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'linkedin' => 'nullable|string|url|max:255',
            'twitter' => 'nullable|string|url|max:255',
            'research_gate' => 'nullable|string|url|max:255',
            'publications' => 'nullable|integer|min:0',
            'achievements_raw' => 'nullable|string',
            'awards_raw' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Parse textareas to JSON arrays
        $validated['achievements'] = $this->parseLinesToArray($request->input('achievements_raw'));
        $validated['awards'] = $this->parseLinesToArray($request->input('awards_raw'));
        unset($validated['achievements_raw'], $validated['awards_raw']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('alumni', 'public');
        } else {
            $validated['image'] = 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face';
        }

        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['publications'] = $validated['publications'] ?? 0;

        Alumni::create($validated);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumnus profile created successfully!');
    }

    /**
     * Show the form for editing the specified alumnus.
     */
    public function edit(Alumni $alumni): View
    {
        // Convert array to new-line separated string for editing in textarea
        $achievements_raw = is_array($alumni->achievements) ? implode("\n", $alumni->achievements) : '';
        $awards_raw = is_array($alumni->awards) ? implode("\n", $alumni->awards) : '';

        return view('admin.alumni.create', compact('alumni', 'achievements_raw', 'awards_raw'));
    }

    /**
     * Update the specified alumnus in storage.
     */
    public function update(Request $request, Alumni $alumni): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:2000|max:' . (date('Y') + 5),
            'degree' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'current_position' => 'nullable|string|max:255',
            'workplace' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'linkedin' => 'nullable|string|url|max:255',
            'twitter' => 'nullable|string|url|max:255',
            'research_gate' => 'nullable|string|url|max:255',
            'publications' => 'nullable|integer|min:0',
            'achievements_raw' => 'nullable|string',
            'awards_raw' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Parse textareas to JSON arrays
        $validated['achievements'] = $this->parseLinesToArray($request->input('achievements_raw'));
        $validated['awards'] = $this->parseLinesToArray($request->input('awards_raw'));
        unset($validated['achievements_raw'], $validated['awards_raw']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $oldPath = $alumni->getRawOriginal('image');
            if ($oldPath && !str_starts_with($oldPath, 'http')) {
                Storage::disk('public')->delete($oldPath);
            }
            $validated['image'] = $request->file('image')->store('alumni', 'public');
        }
        
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_active'] = $request->boolean('is_active', false);
        $validated['publications'] = $validated['publications'] ?? 0;

        $alumni->update($validated);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumnus profile updated successfully!');
    }

    /**
     * Remove the specified alumnus from storage.
     */
    public function destroy(Alumni $alumni): RedirectResponse
    {
        $path = $alumni->getRawOriginal('image');
        if ($path && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
        $alumni->delete();

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumnus profile deleted successfully!');
    }

    /**
     * Quick toggle is_active status (e.g. approve registration).
     */
    public function toggleStatus(Alumni $alumni): RedirectResponse
    {
        $alumni->is_active = !$alumni->is_active;
        $alumni->save();

        $statusMessage = $alumni->is_active ? 'profile activated/approved successfully!' : 'profile deactivated successfully!';
        return redirect()->back()->with('success', 'Alumnus ' . $statusMessage);
    }

    /**
     * Helper to split line-breaks in textareas to arrays.
     */
    private function parseLinesToArray(?string $text): array
    {
        if (!$text) {
            return [];
        }
        return array_values(array_filter(array_map('trim', explode("\n", $text))));
    }
}
