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
}
