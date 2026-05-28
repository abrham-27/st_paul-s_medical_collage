<?php

namespace App\Http\Controllers;

use App\Models\ResearchProjectV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResearchProjectsV2Controller extends Controller
{
    /**
     * Get project by type
     */
    public function getProject($type)
    {
        $project = ResearchProjectV2::getByType($type);
        
        if ($project) {
            $project->loadCompleteData();
        }
        
        return response()->json([
            'success' => true,
            'data' => $project
        ]);
    }

    /**
     * Get all projects
     */
    public function getAllProjects()
    {
        $irb = ResearchProjectV2::getByType('irb');
        $idream = ResearchProjectV2::getByType('idream');
        $hdss = ResearchProjectV2::getByType('hdss');
        
        if ($irb) $irb->loadCompleteData();
        if ($idream) $idream->loadCompleteData();
        if ($hdss) $hdss->loadCompleteData();
        
        return response()->json([
            'success' => true,
            'data' => [
                'irb' => $irb,
                'idream' => $idream,
                'hdss' => $hdss
            ]
        ]);
    }

    /**
     * Update project basic info
     */
    public function updateProject(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'subtitle' => 'sometimes|string|max:500',
            'overview' => 'sometimes|string',
            'hero_image' => 'sometimes|string|max:500',
            'cta_buttons' => 'sometimes|array',
            'contact_email' => 'sometimes|email|max:100',
            'contact_phone' => 'sometimes|string|max:50',
            'contact_address' => 'sometimes|string|max:500',
            'office_hours' => 'sometimes|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $project->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $project->loadCompleteData()
        ]);
    }

    /**
     * Add function
     */
    public function addFunction(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'features' => 'nullable|array',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $function = $project->functions()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $function
        ]);
    }

    /**
     * Update function
     */
    public function updateFunction(Request $request, $type, $functionId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'icon' => 'nullable|string|max:50',
            'features' => 'nullable|array',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $function = $project->functions()->findOrFail($functionId);
        $function->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $function
        ]);
    }

    /**
     * Delete function
     */
    public function deleteFunction($type, $functionId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $function = $project->functions()->findOrFail($functionId);
        $function->delete();

        return response()->json([
            'success' => true,
            'message' => 'Function deleted successfully'
        ]);
    }

    /**
     * Add workflow step
     */
    public function addWorkflow(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'step_number' => 'required|integer|min:1',
            'icon' => 'nullable|string|max:50',
            'estimated_time' => 'nullable|string|max:100',
            'requirements' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $workflow = $project->workflows()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $workflow
        ]);
    }

    /**
     * Update workflow step
     */
    public function updateWorkflow(Request $request, $type, $workflowId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'step_number' => 'sometimes|integer|min:1',
            'icon' => 'nullable|string|max:50',
            'estimated_time' => 'nullable|string|max:100',
            'requirements' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $workflow = $project->workflows()->findOrFail($workflowId);
        $workflow->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $workflow
        ]);
    }

    /**
     * Delete workflow step
     */
    public function deleteWorkflow($type, $workflowId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $workflow = $project->workflows()->findOrFail($workflowId);
        $workflow->delete();

        return response()->json([
            'success' => true,
            'message' => 'Workflow step deleted successfully'
        ]);
    }

    /**
     * Add resource
     */
    public function addResource(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|string|max:500',
            'file_type' => 'nullable|string|max:50',
            'file_size' => 'nullable|string|max:50',
            'external_url' => 'nullable|url|max:500',
            'icon' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $resource = $project->resources()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $resource
        ]);
    }

    /**
     * Update resource
     */
    public function updateResource(Request $request, $type, $resourceId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|string|max:500',
            'file_type' => 'nullable|string|max:50',
            'file_size' => 'nullable|string|max:50',
            'external_url' => 'nullable|url|max:500',
            'icon' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $resource = $project->resources()->findOrFail($resourceId);
        $resource->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $resource
        ]);
    }

    /**
     * Delete resource
     */
    public function deleteResource($type, $resourceId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $resource = $project->resources()->findOrFail($resourceId);
        $resource->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully'
        ]);
    }

    /**
     * Add statistic
     */
    public function addStatistic(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:100',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $statistic = $project->statistics()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $statistic
        ]);
    }

    /**
     * Update statistic
     */
    public function updateStatistic(Request $request, $type, $statisticId)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'sometimes|string|max:255',
            'value' => 'sometimes|string|max:100',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $statistic = $project->statistics()->findOrFail($statisticId);
        $statistic->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $statistic
        ]);
    }

    /**
     * Delete statistic
     */
    public function deleteStatistic($type, $statisticId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $statistic = $project->statistics()->findOrFail($statisticId);
        $statistic->delete();

        return response()->json([
            'success' => true,
            'message' => 'Statistic deleted successfully'
        ]);
    }

    /**
     * Add team member
     */
    public function addTeamMember(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $teamMember = $project->teamMembers()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $teamMember
        ]);
    }

    /**
     * Update team member
     */
    public function updateTeamMember(Request $request, $type, $memberId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'role' => 'sometimes|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:50',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $teamMember = $project->teamMembers()->findOrFail($memberId);
        $teamMember->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $teamMember
        ]);
    }

    /**
     * Delete team member
     */
    public function deleteTeamMember($type, $memberId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $teamMember = $project->teamMembers()->findOrFail($memberId);
        $teamMember->delete();

        return response()->json([
            'success' => true,
            'message' => 'Team member deleted successfully'
        ]);
    }

    /**
     * Add FAQ
     */
    public function addFaq(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $faq = $project->faqs()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $faq
        ]);
    }

    /**
     * Update FAQ
     */
    public function updateFaq(Request $request, $type, $faqId)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'sometimes|string|max:500',
            'answer' => 'sometimes|string',
            'order_index' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $project = ResearchProjectV2::getOrCreateByType($type);
        $faq = $project->faqs()->findOrFail($faqId);
        $faq->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $faq
        ]);
    }

    /**
     * Delete FAQ
     */
    public function deleteFaq($type, $faqId)
    {
        $project = ResearchProjectV2::getOrCreateByType($type);
        $faq = $project->faqs()->findOrFail($faqId);
        $faq->delete();

        return response()->json([
            'success' => true,
            'message' => 'FAQ deleted successfully'
        ]);
    }
}