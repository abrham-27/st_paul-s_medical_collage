<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchProjectV2;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResearchProjectsV2Controller extends Controller
{
    /**
     * Research Projects overview page
     */
    public function index()
    {
        $irb = ResearchProjectV2::getOrCreateByType('irb');
        $idream = ResearchProjectV2::getOrCreateByType('idream');
        $hdss = ResearchProjectV2::getOrCreateByType('hdss');
        
        return view('admin.research.projects-v2.index', compact('irb', 'idream', 'hdss'));
    }

    /**
     * Show specific project management page
     */
    public function show($type)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $project->loadCompleteData();
        
        return view('admin.research.projects-v2.show', compact('project', 'type'));
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
            'cta_buttons' => 'nullable|array',
            'contact_email' => 'nullable|email|max:100',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string|max:500',
            'office_hours' => 'nullable|string|max:500',
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        
        $data = $request->only([
            'title', 'subtitle', 'overview', 'cta_buttons',
            'contact_email', 'contact_phone', 'contact_address', 'office_hours'
        ]);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('research-projects-v2', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.research.projects-v2.show', $type)
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
            'features' => 'nullable|array',
            'order_index' => 'nullable|integer|min:0'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        
        $data = $request->all();
        if (isset($data['features']) && is_array($data['features'])) {
            $data['features'] = array_filter($data['features']);
        }

        $project->functions()->create($data);

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Function added successfully!');
    }

    /**
     * Update function
     */
    public function updateFunction(Request $request, $type, $functionId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'features' => 'nullable|array',
            'order_index' => 'nullable|integer|min:0'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        $function = $project->functions()->findOrFail($functionId);
        
        $data = $request->all();
        if (isset($data['features']) && is_array($data['features'])) {
            $data['features'] = array_filter($data['features']);
        }

        $function->update($data);

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Function updated successfully!');
    }

    /**
     * Delete function
     */
    public function deleteFunction($type, $functionId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $function = $project->functions()->findOrFail($functionId);
        $function->delete();

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Function deleted successfully!');
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
            'requirements' => 'nullable|array'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        
        $data = $request->all();
        if (isset($data['requirements']) && is_array($data['requirements'])) {
            $data['requirements'] = array_filter($data['requirements']);
        }

        $project->workflows()->create($data);

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Workflow step added successfully!');
    }

    /**
     * Update workflow step
     */
    public function updateWorkflow(Request $request, $type, $workflowId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'step_number' => 'required|integer|min:1',
            'icon' => 'nullable|string|max:50',
            'estimated_time' => 'nullable|string|max:100',
            'requirements' => 'nullable|array'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        $workflow = $project->workflows()->findOrFail($workflowId);
        
        $data = $request->all();
        if (isset($data['requirements']) && is_array($data['requirements'])) {
            $data['requirements'] = array_filter($data['requirements']);
        }

        $workflow->update($data);

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Workflow step updated successfully!');
    }

    /**
     * Delete workflow step
     */
    public function deleteWorkflow($type, $workflowId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $workflow = $project->workflows()->findOrFail($workflowId);
        $workflow->delete();

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Workflow step deleted successfully!');
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

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Resource added successfully!');
    }

    /**
     * Update resource
     */
    public function updateResource(Request $request, $type, $resourceId)
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
        $resource = $project->resources()->findOrFail($resourceId);
        
        $data = $request->only(['title', 'description', 'external_url', 'icon', 'order_index']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_path'] = $file->store('research-resources-v2', 'public');
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $this->formatFileSize($file->getSize());
        }

        $resource->update($data);

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Resource updated successfully!');
    }

    /**
     * Delete resource
     */
    public function deleteResource($type, $resourceId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $resource = $project->resources()->findOrFail($resourceId);
        $resource->delete();

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Resource deleted successfully!');
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

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Statistic added successfully!');
    }

    /**
     * Update statistic
     */
    public function updateStatistic(Request $request, $type, $statisticId)
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
        $statistic = $project->statistics()->findOrFail($statisticId);
        $statistic->update($request->all());

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Statistic updated successfully!');
    }

    /**
     * Delete statistic
     */
    public function deleteStatistic($type, $statisticId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $statistic = $project->statistics()->findOrFail($statisticId);
        $statistic->delete();

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Statistic deleted successfully!');
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

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Team member added successfully!');
    }

    /**
     * Update team member
     */
    public function updateTeamMember(Request $request, $type, $memberId)
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
        $teamMember = $project->teamMembers()->findOrFail($memberId);
        
        $data = $request->only(['name', 'role', 'bio', 'email', 'phone', 'order_index']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('research-team-v2', 'public');
        }

        $teamMember->update($data);

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Team member updated successfully!');
    }

    /**
     * Delete team member
     */
    public function deleteTeamMember($type, $memberId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $teamMember = $project->teamMembers()->findOrFail($memberId);
        $teamMember->delete();

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'Team member deleted successfully!');
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

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'FAQ added successfully!');
    }

    /**
     * Update FAQ
     */
    public function updateFaq(Request $request, $type, $faqId)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'order_index' => 'nullable|integer|min:0'
        ]);

        $project = ResearchProjectV2::getOrCreateByType($type);
        $faq = $project->faqs()->findOrFail($faqId);
        $faq->update($request->all());

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'FAQ updated successfully!');
    }

    /**
     * Delete FAQ
     */
    public function deleteFaq($type, $faqId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $faq = $project->faqs()->findOrFail($faqId);
        $faq->delete();

        return redirect()->route('admin.research.projects-v2.show', $type)
            ->with('success', 'FAQ deleted successfully!');
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