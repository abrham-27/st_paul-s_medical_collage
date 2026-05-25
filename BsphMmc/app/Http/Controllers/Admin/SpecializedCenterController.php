<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecializedCenter;
use Illuminate\Http\Request;

class SpecializedCenterController extends Controller
{
    public function index()
    {
        $centers = SpecializedCenter::ordered()->get();
        return view('admin.specialized-centers.index', compact('centers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'details'     => 'nullable|string',
            'icon'        => 'nullable|string|max:10',
            'location'    => 'nullable|string|max:255',
            'hours'       => 'nullable|string|max:255',
            'contact'     => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        SpecializedCenter::create([
            'name'        => $request->name,
            'description' => $request->description,
            'details'     => $request->details,
            'icon'        => $request->icon,
            'location'    => $request->location,
            'hours'       => $request->hours,
            'contact'     => $request->contact,
            'sort_order'  => $request->sort_order ?? SpecializedCenter::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.specialized-centers.index')
            ->with('success', 'Center created successfully.');
    }

    public function update(Request $request, SpecializedCenter $specializedCenter)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'details'     => 'nullable|string',
            'icon'        => 'nullable|string|max:10',
            'location'    => 'nullable|string|max:255',
            'hours'       => 'nullable|string|max:255',
            'contact'     => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $specializedCenter->update($request->only(
            'name', 'description', 'details', 'icon',
            'location', 'hours', 'contact', 'sort_order'
        ));

        return redirect()->route('admin.specialized-centers.index')
            ->with('success', 'Center updated successfully.');
    }

    public function destroy(SpecializedCenter $specializedCenter)
    {
        $specializedCenter->delete();
        return redirect()->route('admin.specialized-centers.index')
            ->with('success', 'Center deleted.');
    }
}
