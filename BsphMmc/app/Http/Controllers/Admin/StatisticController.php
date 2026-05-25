<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::latest()->paginate(10);
        return view('admin.statistics.index', compact('statistics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'value'       => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        Statistic::create($request->only('title', 'value', 'description'));

        return redirect()->route('admin.statistics.index')
            ->with('success', 'Statistic created successfully.');
    }

    public function update(Request $request, Statistic $statistic)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'value'       => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $statistic->update($request->only('title', 'value', 'description'));

        return redirect()->route('admin.statistics.index')
            ->with('success', 'Statistic updated successfully.');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        return redirect()->route('admin.statistics.index')
            ->with('success', 'Statistic deleted successfully.');
    }
}
