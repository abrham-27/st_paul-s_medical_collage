<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchProjectV2;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResearchProjectsController extends Controller
{
    /**
     * Research Projects overview page
     */
    public function index()
    {
        $irb = ResearchProjectV2::getOrCreateByType('irb');
        $idream = ResearchProjectV2::getOrCreateByType('idream');
        $hdss = ResearchProjectV2::getOrCreateByType('hdss');
        
        return view('admin.research.projects.index', compact('irb', 'idream', 'hdss'));
    }

    /**
     * Show specific project management page
     */
    public function show($type)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $project->loadCompleteData();
        
        return view('admin.research.projects.show', compact('project', 'type'));
    }

    /**
     * Update project basic info
     */
    public function updateBasicInfo(Request $request, $type)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'overview' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact_email' => 'nullable|email|max:100',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:500',
            'office_hours' => 'nullable|string|max:500',
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        
        $data = $request->only([
            'title', 'subtitle', 'overview',
            'contact_email', 'contact_phone', 'contact_address', 'office_hours'
        ]);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('research-projects-v2', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.research.projects.show', $type)
            ->with('success', 'Project information updated successfully!');
    }

    /**
     * Add function
     */
    public function addFunction(Request $request, $type)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'features_text' => 'nullable|string',
            'order_index' => 'nullable|integer|min:0'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        
        $data = $request->only(['title', 'description', 'icon', 'order_index']);
        
        // Handle features
        if ($request->features_text) {
            $features = array_filter(array_map('trim', explode("\n", $request->features_text)));
            $data['features'] = $features;
        }

        $project->functions()->create($data);

        return redirect()->route('admin.research.projects.show', $type)
            ->with('success', 'Function added successfully!');
    }

    /**
     * Add workflow step
     */
    public function addWorkflow(Request $request, $type)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'step_number' => 'required|integer|min:1',
            'icon' => 'nullable|string|max:50',
            'estimated_time' => 'nullable|string|max:100',
            'requirements_text' => 'nullable|string'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        
        $data = $request->only(['title', 'description', 'step_number', 'icon', 'estimated_time']);
        
        // Handle requirements
        if ($request->requirements_text) {
            $requirements = array_filter(array_map('trim', explode("\n", $request->requirements_text)));
            $data['requirements'] = $requirements;
        }

        $project->workflows()->create($data);

        return redirect()->route('admin.research.projects.show', $type)
            ->with('success', 'Workflow step added successfully!');
    }

    /**
     * Add resource
     */
    public function addResource(Request $request, $type)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'external_url' => 'nullable|url|max:500',
            'icon' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer|min:0'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        
        $data = $request->only(['title', 'description', 'external_url', 'icon', 'order_index']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_path'] = $file->store('research-resources-v2', 'public');
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $this->formatFileSize($file->getSize());
        }

        $project->resources()->create($data);

        return redirect()->route('admin.research.projects.show', $type)
            ->with('success', 'Resource added successfully!');
    }

    /**
     * Add statistic
     */
    public function addStatistic(Request $request, $type)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:100',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer|min:0'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        $project->statistics()->create($request->all());

        return redirect()->route('admin.research.projects.show', $type)
            ->with('success', 'Statistic added successfully!');
    }

    /**
     * Add team member
     */
    public function addTeamMember(Request $request, $type)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer|min:0'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        
        $data = $request->only(['name', 'role', 'bio', 'email', 'phone', 'order_index']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('research-team-v2', 'public');
        }

        $project->teamMembers()->create($data);

        return redirect()->route('admin.research.projects.show', $type)
            ->with('success', 'Team member added successfully!');
    }

    /**
     * Add FAQ
     */
    public function addFaq(Request $request, $type)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'order_index' => 'nullable|integer|min:0'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        $project->faqs()->create($request->all());

        return redirect()->route('admin.research.projects.show', $type)
            ->with('success', 'FAQ added successfully!');
    }

    /**
     * Format file size
     */
    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
