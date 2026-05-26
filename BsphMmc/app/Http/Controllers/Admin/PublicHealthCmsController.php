<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicHealthCmsController extends Controller
{
    public function overview()
    {
        $page = AcademicPage::getOrCreate('public_health', 'overview');
        return view('admin.public-health.overview', compact('page'));
    }

    public function updateOverview(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'nullable|string|max:255',
            'content'           => 'nullable|string',
            'secondary_title'   => 'nullable|string|max:255',
            'secondary_content' => 'nullable|string',
            'tertiary_title'    => 'nullable|string|max:255',
            'tertiary_content'  => 'nullable|string',
            'featured_image'    => 'nullable|image|max:3072',
        ]);

        $page = AcademicPage::getOrCreate('public_health', 'overview');

        if ($request->hasFile('featured_image')) {
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('academic-pages', 'public');
        }

        $page->update($validated);

        return back()->with('success', 'Overview page updated successfully.');
    }

    public function partnership()
    {
        $page = AcademicPage::getOrCreate('public_health', 'partnership');
        return view('admin.public-health.partnership', compact('page'));
    }

    public function updatePartnership(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'nullable|string|max:255',
            'content'        => 'nullable|string',
            'featured_image' => 'nullable|image|max:3072',
        ]);

        $page = AcademicPage::getOrCreate('public_health', 'partnership');

        if ($request->hasFile('featured_image')) {
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('academic-pages', 'public');
        }

        $page->update($validated);

        return back()->with('success', 'Partnership page updated successfully.');
    }

    // ── Departments ───────────────────────────────────────────────────────────

    private const DEPT_PAGES = [
        'epidemiology'      => 'dept_epidemiology',
        'health_management' => 'dept_health_management',
        'program'           => 'dept_program',
    ];

    private const DEPT_LABELS = [
        'epidemiology'      => 'Department of Epidemiology',
        'health_management' => 'Department of Health Management, Promotion, Reproductive Health and Nutrition',
        'program'           => 'Academic Programs',
    ];

    public function departmentsIndex()
    {
        $pages = [];
        foreach (self::DEPT_PAGES as $key => $pageType) {
            $pages[$key] = AcademicPage::where('school_type', 'public_health')
                ->where('page_type', $pageType)->first();
        }
        $deptLabels = self::DEPT_LABELS;
        return view('admin.public-health.departments.index', compact('pages', 'deptLabels'));
    }

    public function departmentEdit(string $dept)
    {
        if (!array_key_exists($dept, self::DEPT_PAGES)) abort(404);
        $page = AcademicPage::getOrCreate('public_health', self::DEPT_PAGES[$dept]);
        $label = self::DEPT_LABELS[$dept];
        return view('admin.public-health.departments.edit', compact('page', 'dept', 'label'));
    }

    public function departmentUpdate(Request $request, string $dept)
    {
        if (!array_key_exists($dept, self::DEPT_PAGES)) abort(404);
        $validated = $request->validate([
            'title'          => 'nullable|string|max:255',
            'content'        => 'nullable|string',
            'featured_image' => 'nullable|image|max:3072',
        ]);
        $page = AcademicPage::getOrCreate('public_health', self::DEPT_PAGES[$dept]);
        if ($request->hasFile('featured_image')) {
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('academic-pages', 'public');
        }
        $page->update($validated);
        return back()->with('success', 'Department page updated successfully.');
    }
}
