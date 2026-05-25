<?php

namespace App\Http\Controllers;
use App\Models\{ResearchPage, ResearchGoal};
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    // Frontend Overview page
    public function overview()
    {
        $background = ResearchPage::where('page_type', 'background')->active()->first();
        $mission = ResearchPage::where('page_type', 'mission')->active()->first();
        $vision = ResearchPage::where('page_type', 'vision')->active()->first();
        $goals = ResearchGoal::active()->ordered()->get();
        
        return view('research.overview', compact('background', 'mission', 'vision', 'goals'));
    }

    // API endpoint for frontend data
    public function background()
    {
        $background = ResearchPage::where('page_type', 'background')->active()->first();
        return response()->json([
            'success' => true,
            'data' => $background
        ]);
    }

    public function mission()
    {
        $mission = ResearchPage::where('page_type', 'mission')->active()->first();
        return response()->json([
            'success' => true,
            'data' => $mission
        ]);
    }

    public function vision()
    {
        $vision = ResearchPage::where('page_type', 'vision')->active()->first();
        return response()->json([
            'success' => true,
            'data' => $vision
        ]);
    }

    public function goals()
    {
        $goals = ResearchGoal::active()->ordered()->get();
        return response()->json([
            'success' => true,
            'data' => $goals
        ]);
    }
}
