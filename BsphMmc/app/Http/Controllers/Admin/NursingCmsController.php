<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NursingCmsController extends Controller
{
    public function overview()
    {
        $page = AcademicPage::getOrCreate('nursing', 'overview');
        $overviewContent = $this->parseOverviewContent($page->content);

        return view('admin.nursing.overview', compact('page', 'overviewContent'));
    }

    public function updateOverview(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'nullable|string|max:255',
            'hero_subtitle'     => 'nullable|string|max:255',
            'about_text'        => 'nullable|string',
            'secondary_title'   => 'nullable|string|max:255',
            'secondary_content' => 'nullable|string',
            'tertiary_title'    => 'nullable|string|max:255',
            'tertiary_content'  => 'nullable|string',
            'featured_image'    => 'nullable|image|max:3072',
            'timeline'          => 'nullable|array',
            'timeline.*.year'   => 'nullable|string|max:20',
            'timeline.*.title'  => 'nullable|string|max:255',
            'timeline.*.description' => 'nullable|string',
        ]);

        $page = AcademicPage::getOrCreate('nursing', 'overview');

        if ($request->hasFile('featured_image')) {
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('academic-pages', 'public');
        }

        $timeline = collect($request->input('timeline', []))
            ->filter(fn ($item) => !empty($item['year']) || !empty($item['title']) || !empty($item['description']))
            ->values()
            ->all();

        $validated['content'] = json_encode([
            'hero_subtitle' => $validated['hero_subtitle'] ?? null,
            'about_text' => $validated['about_text'] ?? null,
            'timeline' => $timeline,
        ]);

        unset($validated['hero_subtitle'], $validated['about_text'], $validated['timeline']);

        $page->update($validated);

        return back()->with('success', 'Overview page updated successfully.');
    }

    public function partnership()
    {
        $page = AcademicPage::getOrCreate('nursing', 'partnership');
        return view('admin.nursing.partnership', compact('page'));
    }

    public function updatePartnership(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'nullable|string|max:255',
            'content'        => 'nullable|string',
            'featured_image' => 'nullable|image|max:3072',
        ]);

        $page = AcademicPage::getOrCreate('nursing', 'partnership');

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

    private function parseOverviewContent(?string $content): array
    {
        $defaults = [
            'hero_subtitle' => '',
            'about_text' => '',
            'timeline' => [],
        ];

        if (!$content) {
            return $defaults;
        }

        $decoded = json_decode($content, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return array_merge($defaults, $decoded);
        }

        return array_merge($defaults, ['about_text' => $content]);
    }
}
