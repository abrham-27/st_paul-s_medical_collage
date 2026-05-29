<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Str;

class ResearchRolesResponsibilityAdminController extends Controller
{
    // ──── Hero Section ────
    public function editHero()
    {
        $hero = RoleResponsibilityContent::byType('hero')->first() ?? new RoleResponsibilityContent([
            'section_type' => 'hero',
            'title' => '',
            'subtitle' => '',
            'content' => null,
            'image' => null,
            'cta_button_text' => null,
            'cta_button_link' => null,
            'status' => true,
        ]);
        return view('admin.research.roles-responsibility-hero', compact('hero'));
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'cta_button_text' => 'nullable|string|max:100',
            'cta_button_link' => 'nullable|string|max:500',
        ]);

        $data = [
            'section_type' => 'hero',
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'cta_button_text' => $request->cta_button_text,
            'cta_button_link' => $request->cta_button_link,
            'status' => $request->boolean('status', true),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('research/roles-responsibility', 'public');
        }

        RoleResponsibilityContent::updateOrCreate(['section_type' => 'hero'], $data);

        return redirect()->route('admin.research.roles-responsibility.index')
            ->with('success', 'Hero section updated successfully!');
    }

    // ──── Overview Section ────
    public function editOverview()
    {
        $overview = RoleResponsibilityContent::byType('overview')->first() ?? new RoleResponsibilityContent([
            'section_type' => 'overview',
            'title' => 'Overview',
            'content' => null,
            'status' => true,
        ]);
        return view('admin.research.roles-responsibility-overview', compact('overview'));
    }

    public function updateOverview(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        RoleResponsibilityContent::updateOrCreate(
            ['section_type' => 'overview'],
            [
                'title' => 'Overview',
                'content' => $request->content,
                'status' => true,
            ]
        );

        return redirect()->route('admin.research.roles-responsibility.index')
            ->with('success', 'Overview updated successfully!');
    }

    // ──── Categories Management ────
    public function indexCategories()
    {
        $categories = RoleResponsibilityCategory::ordered()->get();
        return view('admin.research.roles-responsibility-categories', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.research.roles-responsibility-category-form');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:500',
            'detailed_content' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'title' => $request->title,
            'summary' => $request->summary,
            'detailed_content' => $request->detailed_content,
            'icon' => $request->icon,
            'sort_order' => $request->sort_order ?? 0,
            'status' => true,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('research/roles-responsibility', 'public');
        }

        RoleResponsibilityCategory::create($data);

        return redirect()->route('admin.research.roles-responsibility.categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function editCategory(RoleResponsibilityCategory $category)
    {
        return view('admin.research.roles-responsibility-category-form', compact('category'));
    }

    public function updateCategory(Request $request, RoleResponsibilityCategory $category)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:500',
            'detailed_content' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'title' => $request->title,
            'summary' => $request->summary,
            'detailed_content' => $request->detailed_content,
            'icon' => $request->icon,
            'sort_order' => $request->sort_order ?? $category->sort_order,
            'status' => $request->boolean('status', true),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('research/roles-responsibility', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.research.roles-responsibility.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroyCategory(RoleResponsibilityCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.research.roles-responsibility.categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    // ──── Processes Management ────
    public function indexProcesses()
    {
        $processes = RoleResponsibilityProcess::ordered()->get();
        return view('admin.research.roles-responsibility.processes', compact('processes'));
    }

    public function createProcess()
    {
        return view('admin.research.roles-responsibility.process-form');
    }

    public function storeProcess(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'step_number' => 'required|integer|min:1',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        RoleResponsibilityProcess::create([
            'title' => $request->title,
            'description' => $request->description,
            'step_number' => $request->step_number,
            'icon' => $request->icon,
            'sort_order' => $request->sort_order ?? 0,
            'status' => true,
        ]);

        return redirect()->route('admin.research.roles-responsibility.processes.index')
            ->with('success', 'Process step created successfully!');
    }

    public function editProcess(RoleResponsibilityProcess $process)
    {
        return view('admin.research.roles-responsibility.process-form', compact('process'));
    }

    public function updateProcess(Request $request, RoleResponsibilityProcess $process)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'step_number' => 'required|integer|min:1',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $process->update([
            'title' => $request->title,
            'description' => $request->description,
            'step_number' => $request->step_number,
            'icon' => $request->icon,
            'sort_order' => $request->sort_order ?? $process->sort_order,
            'status' => $request->boolean('status', true),
        ]);

        return redirect()->route('admin.research.roles-responsibility.processes.index')
            ->with('success', 'Process step updated successfully!');
    }

    public function destroyProcess(RoleResponsibilityProcess $process)
    {
        $process->delete();
        return redirect()->route('admin.research.roles-responsibility.processes.index')
            ->with('success', 'Process step deleted successfully!');
    }

    // ──── Policies Management ────
    public function indexPolicies()
    {
        $policies = RoleResponsibilityPolicy::ordered()->get();
        return view('admin.research.roles-responsibility.policies', compact('policies'));
    }

    public function createPolicy()
    {
        return view('admin.research.roles-responsibility.policy-form');
    }

    public function storePolicy(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|max:10240', // 10MB
            'category' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('research/roles-responsibility/policies', 'public');
        
        RoleResponsibilityPolicy::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'category' => $request->category,
            'sort_order' => $request->sort_order ?? 0,
            'status' => true,
        ]);

        return redirect()->route('admin.research.roles-responsibility.policies.index')
            ->with('success', 'Policy/Document uploaded successfully!');
    }

    public function editPolicy(RoleResponsibilityPolicy $policy)
    {
        return view('admin.research.roles-responsibility.policy-form', compact('policy'));
    }

    public function updatePolicy(Request $request, RoleResponsibilityPolicy $policy)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
            'category' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'sort_order' => $request->sort_order ?? $policy->sort_order,
            'status' => $request->boolean('status', true),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_path'] = $file->store('research/roles-responsibility/policies', 'public');
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $file->getSize();
        }

        $policy->update($data);

        return redirect()->route('admin.research.roles-responsibility.policies.index')
            ->with('success', 'Policy/Document updated successfully!');
    }

    public function destroyPolicy(RoleResponsibilityPolicy $policy)
    {
        $policy->delete();
        return redirect()->route('admin.research.roles-responsibility.policies.index')
            ->with('success', 'Policy/Document deleted successfully!');
    }

    // ──── FAQs Management ────
    public function indexFaqs()
    {
        $faqs = RoleResponsibilityFaq::ordered()->get();
        return view('admin.research.roles-responsibility.faqs', compact('faqs'));
    }

    public function createFaq()
    {
        return view('admin.research.roles-responsibility.faq-form');
    }

    public function storeFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        RoleResponsibilityFaq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? 0,
            'status' => true,
        ]);

        return redirect()->route('admin.research.roles-responsibility.faqs.index')
            ->with('success', 'FAQ created successfully!');
    }

    public function editFaq(RoleResponsibilityFaq $faq)
    {
        return view('admin.research.roles-responsibility.faq-form', compact('faq'));
    }

    public function updateFaq(Request $request, RoleResponsibilityFaq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? $faq->sort_order,
            'status' => $request->boolean('status', true),
        ]);

        return redirect()->route('admin.research.roles-responsibility.faqs.index')
            ->with('success', 'FAQ updated successfully!');
    }

    public function destroyFaq(RoleResponsibilityFaq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.research.roles-responsibility.faqs.index')
            ->with('success', 'FAQ deleted successfully!');
    }

    // ──── Statistics Management ────
    public function indexStatistics()
    {
        $statistics = RoleResponsibilityStatistic::ordered()->get();
        return view('admin.research.roles-responsibility.statistics', compact('statistics'));
    }

    public function createStatistic()
    {
        return view('admin.research.roles-responsibility.statistic-form');
    }

    public function storeStatistic(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'value' => 'required|string|max:100',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        RoleResponsibilityStatistic::create([
            'label' => $request->label,
            'value' => $request->value,
            'icon' => $request->icon,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'status' => true,
        ]);

        return redirect()->route('admin.research.roles-responsibility.statistics.index')
            ->with('success', 'Statistic created successfully!');
    }

    public function editStatistic(RoleResponsibilityStatistic $statistic)
    {
        return view('admin.research.roles-responsibility.statistic-form', compact('statistic'));
    }

    public function updateStatistic(Request $request, RoleResponsibilityStatistic $statistic)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'value' => 'required|string|max:100',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $statistic->update([
            'label' => $request->label,
            'value' => $request->value,
            'icon' => $request->icon,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? $statistic->sort_order,
            'status' => $request->boolean('status', true),
        ]);

        return redirect()->route('admin.research.roles-responsibility.statistics.index')
            ->with('success', 'Statistic updated successfully!');
    }

    public function destroyStatistic(RoleResponsibilityStatistic $statistic)
    {
        $statistic->delete();
        return redirect()->route('admin.research.roles-responsibility.statistics.index')
            ->with('success', 'Statistic deleted successfully!');
    }

    // ──── Contact Management ────
    public function editContact()
    {
        $contact = RoleResponsibilityContact::first() ?? new RoleResponsibilityContact([
            'office_name' => 'Institutional Review Board',
            'office_location' => null,
            'email' => null,
            'phone' => null,
            'office_hours' => null,
            'website' => null,
            'additional_info' => null,
            'status' => true,
        ]);
        return view('admin.research.roles-responsibility.contact', compact('contact'));
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string|max:255',
            'office_location' => 'nullable|string|max:500',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'office_hours' => 'nullable|string',
            'website' => 'nullable|string|max:500',
            'additional_info' => 'nullable|string',
        ]);

        RoleResponsibilityContact::updateOrCreate(
            [],
            [
                'office_name' => $request->office_name,
                'office_location' => $request->office_location,
                'email' => $request->email,
                'phone' => $request->phone,
                'office_hours' => $request->office_hours,
                'website' => $request->website,
                'additional_info' => $request->additional_info,
                'status' => $request->boolean('status', true),
            ]
        );

        return redirect()->route('admin.research.roles-responsibility.index')
            ->with('success', 'Contact information updated successfully!');
    }

    // ──── Dashboard ────
    public function index()
    {
        return view('admin.research.roles-responsibility-index');
    }
}
