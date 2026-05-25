<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MissionVision;
use App\Models\CoreValue;
use Illuminate\Http\Request;

class MissionVisionController extends Controller
{
    public function index()
    {
        $mission = MissionVision::mission();
        $vision  = MissionVision::vision();
        $values  = CoreValue::ordered()->get();

        return view('admin.mission-vision.index', compact('mission', 'vision', 'values'));
    }

    public function updateMission(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        MissionVision::mission()->update($request->only('title', 'description'));

        return redirect()->route('admin.mission-vision.index')
            ->with('success', 'Mission updated successfully.');
    }

    public function updateVision(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        MissionVision::vision()->update($request->only('title', 'description'));

        return redirect()->route('admin.mission-vision.index')
            ->with('success', 'Vision updated successfully.');
    }

    public function storeValue(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:10',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        CoreValue::create([
            'title'       => $request->title,
            'description' => $request->description,
            'icon'        => $request->icon,
            'sort_order'  => $request->sort_order ?? CoreValue::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.mission-vision.index')
            ->with('success', 'Value added successfully.');
    }

    public function updateValue(Request $request, CoreValue $value)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:10',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $value->update($request->only('title', 'description', 'icon', 'sort_order'));

        return redirect()->route('admin.mission-vision.index')
            ->with('success', 'Value updated successfully.');
    }

    public function destroyValue(CoreValue $value)
    {
        $value->delete();

        return redirect()->route('admin.mission-vision.index')
            ->with('success', 'Value deleted successfully.');
    }
}
