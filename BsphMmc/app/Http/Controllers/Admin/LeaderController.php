<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeaderController extends Controller
{
    public function index(Request $request)
    {
        $query = Leader::query();

        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('position', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $leaders = $query->ordered()->paginate(12)->withQueryString();

        return view('admin.leaders.index', compact('leaders'));
    }

    public function create()
    {
        return view('admin.leaders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'     => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'profile_image' => 'nullable|image|max:2048',
            'biography'     => 'nullable|string',
            'qualification' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer|min:0',
            'status'        => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')
                ->store('leaders', 'public');
        }

        $validated['display_order'] = $validated['display_order'] ?? 0;

        Leader::create($validated);

        return redirect()->route('admin.leaders.index')
            ->with('success', 'Leader created successfully.');
    }

    public function edit(Leader $leader)
    {
        return view('admin.leaders.edit', compact('leader'));
    }

    public function update(Request $request, Leader $leader)
    {
        $validated = $request->validate([
            'full_name'     => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'profile_image' => 'nullable|image|max:2048',
            'biography'     => 'nullable|string',
            'qualification' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer|min:0',
            'status'        => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($leader->profile_image) {
                Storage::disk('public')->delete($leader->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')
                ->store('leaders', 'public');
        }

        $leader->update($validated);

        return redirect()->route('admin.leaders.index')
            ->with('success', 'Leader updated successfully.');
    }

    public function destroy(Leader $leader)
    {
        if ($leader->profile_image) {
            Storage::disk('public')->delete($leader->profile_image);
        }
        $leader->delete();

        return redirect()->route('admin.leaders.index')
            ->with('success', 'Leader deleted successfully.');
    }
}
