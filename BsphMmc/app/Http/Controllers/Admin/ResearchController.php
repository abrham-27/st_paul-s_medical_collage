<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{ResearchPage, ResearchGoal};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResearchController extends Controller
{
    // Research Overview CMS
    public function overview()
    {
        $background = ResearchPage::where('page_type', 'background')->first();
        $mission = ResearchPage::where('page_type', 'mission')->first();
        $vision = ResearchPage::where('page_type', 'vision')->first();
        $goals = ResearchGoal::active()->ordered()->get();
        
        return view('admin.research.overview', compact('background', 'mission', 'vision', 'goals'));
    }

    // Background Management
    public function background()
    {
        $background = ResearchPage::where('page_type', 'background')->first();
        if (!$background) {
            $background = new ResearchPage([
                'page_type' => 'background',
                'title' => '',
                'content' => '',
                'image' => null,
            ]);
        }
        return view('admin.research.background', compact('background'));
    }

    public function updateBackground(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'page_type' => 'background',
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'active',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('research-images', 'public');
        }

        ResearchPage::updateOrCreate(
            ['page_type' => 'background'],
            $data
        );

        return redirect()->route('admin.research.overview')
            ->with('success', 'Background updated successfully!');
    }

    // Mission Management
    public function mission()
    {
        $mission = ResearchPage::where('page_type', 'mission')->first();
        if (!$mission) {
            $mission = new ResearchPage([
                'page_type' => 'mission',
                'title' => '',
                'content' => '',
            ]);
        }
        return view('admin.research.mission', compact('mission'));
    }

    public function updateMission(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        ResearchPage::updateOrCreate(
            ['page_type' => 'mission'],
            [
                'title' => $request->title,
                'content' => $request->content,
                'status' => 'active',
            ]
        );

        return redirect()->route('admin.research.overview')
            ->with('success', 'Mission updated successfully!');
    }

    // Vision Management
    public function vision()
    {
        $vision = ResearchPage::where('page_type', 'vision')->first();
        if (!$vision) {
            $vision = new ResearchPage([
                'page_type' => 'vision',
                'title' => '',
                'content' => '',
            ]);
        }
        return view('admin.research.vision', compact('vision'));
    }

    public function updateVision(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        ResearchPage::updateOrCreate(
            ['page_type' => 'vision'],
            [
                'title' => $request->title,
                'content' => $request->content,
                'status' => 'active',
            ]
        );

        return redirect()->route('admin.research.overview')
            ->with('success', 'Vision updated successfully!');
    }

    // Goals Management
    public function goals()
    {
        $goals = ResearchGoal::active()->ordered()->get();
        return view('admin.research.goals', compact('goals'));
    }

    public function storeGoal(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'required|integer|min:1'
        ]);

        ResearchGoal::create([
            'title' => $request->title,
            'description' => $request->description,
            'display_order' => $request->display_order,
            'status' => 'active',
        ]);

        return redirect()->route('admin.research.goals')
            ->with('success', 'Goal added successfully!');
    }

    public function editGoal(ResearchGoal $goal)
    {
        return view('admin.research.edit-goal', compact('goal'));
    }

    public function updateGoal(Request $request, ResearchGoal $goal)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'required|integer|min:1'
        ]);

        $goal->update([
            'title' => $request->title,
            'description' => $request->description,
            'display_order' => $request->display_order,
        ]);

        return redirect()->route('admin.research.goals')
            ->with('success', 'Goal updated successfully!');
    }

    public function destroyGoal(ResearchGoal $goal)
    {
        $goal->delete();
        return redirect()->route('admin.research.goals')
            ->with('success', 'Goal deleted successfully!');
    }
}
