<?php

namespace App\Http\Controllers;

use App\Models\{
    RoleResponsibilityContent,
    RoleResponsibilityCategory,
    RoleResponsibilityProcess,
    RoleResponsibilityPolicy,
    RoleResponsibilityFaq,
    RoleResponsibilityStatistic,
    RoleResponsibilityContact
};
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ResearchRolesResponsibilityApiController extends Controller
{
    /**
     * Get hero section content
     */
    public function getHero(): JsonResponse
    {
        $hero = RoleResponsibilityContent::byType('hero')->active()->first();
        
        return response()->json([
            'success' => true,
            'data' => $hero ?? [
                'title' => 'Roles & Responsibilities',
                'subtitle' => 'Ensuring Ethical Excellence in Research',
                'content' => null,
                'image' => null,
                'cta_button_text' => null,
                'cta_button_link' => null,
            ]
        ]);
    }

    /**
     * Get overview content
     */
    public function getOverview(): JsonResponse
    {
        $overview = RoleResponsibilityContent::byType('overview')->active()->first();
        
        return response()->json([
            'success' => true,
            'data' => $overview ?? [
                'title' => 'Overview',
                'content' => null,
            ]
        ]);
    }

    /**
     * Get all responsibility categories
     */
    public function getCategories(): JsonResponse
    {
        $categories = RoleResponsibilityCategory::active()->get();
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Get workflow/process steps
     */
    public function getProcess(): JsonResponse
    {
        $processes = RoleResponsibilityProcess::active()->get();
        
        return response()->json([
            'success' => true,
            'data' => $processes
        ]);
    }

    /**
     * Get all policies/documents
     */
    public function getPolicies(): JsonResponse
    {
        $policies = RoleResponsibilityPolicy::active()->get();
        
        return response()->json([
            'success' => true,
            'data' => $policies->map(function ($policy) {
                return [
                    'id' => $policy->id,
                    'title' => $policy->title,
                    'description' => $policy->description,
                    'file_path' => $policy->file_path,
                    'file_url' => $policy->file_url,
                    'file_type' => $policy->file_type,
                    'category' => $policy->category,
                    'created_at' => $policy->created_at,
                ];
            })
        ]);
    }

    /**
     * Get FAQs
     */
    public function getFaqs(): JsonResponse
    {
        $faqs = RoleResponsibilityFaq::active()->get();
        
        return response()->json([
            'success' => true,
            'data' => $faqs
        ]);
    }

    /**
     * Get statistics/highlights
     */
    public function getStatistics(): JsonResponse
    {
        $stats = RoleResponsibilityStatistic::active()->get();
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Get contact information
     */
    public function getContact(): JsonResponse
    {
        $contact = RoleResponsibilityContact::active()->first();
        
        return response()->json([
            'success' => true,
            'data' => $contact ?? [
                'office_name' => 'Institutional Review Board',
                'office_location' => null,
                'email' => null,
                'phone' => null,
                'office_hours' => null,
                'website' => null,
                'additional_info' => null,
            ]
        ]);
    }

    /**
     * Get all data combined (for full page load)
     */
    public function getAll(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'hero' => RoleResponsibilityContent::byType('hero')->active()->first(),
                'overview' => RoleResponsibilityContent::byType('overview')->active()->first(),
                'categories' => RoleResponsibilityCategory::active()->get(),
                'processes' => RoleResponsibilityProcess::active()->get(),
                'policies' => RoleResponsibilityPolicy::active()->get(),
                'faqs' => RoleResponsibilityFaq::active()->get(),
                'statistics' => RoleResponsibilityStatistic::active()->get(),
                'contact' => RoleResponsibilityContact::active()->first(),
            ]
        ]);
    }
}
