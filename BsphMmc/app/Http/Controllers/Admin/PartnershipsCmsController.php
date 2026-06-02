<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\PartnersPage;
use App\Models\PartnershipStatistic;
use App\Models\PartnershipDocument;
use App\Models\PartnershipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PartnershipsCmsController extends Controller
{
    public function index(): View
    {
        $externalPartnerCount = Partner::whereHas('category', function ($query) {
            $query->where('slug', 'external');
        })->count();

        return view('admin.partnerships.index', [
            'partnerCount' => Partner::count(),
            'externalPartnerCount' => $externalPartnerCount,
            'statisticsCount' => PartnershipStatistic::count(),
            'documentsCount' => PartnershipDocument::count(),
            'pendingApplicationsCount' => PartnershipApplication::where('status', 'pending')->count(),
            'applicationsCount' => PartnershipApplication::count(),
        ]);
    }

    public function editOverview(): View
    {
        $page = PartnersPage::getInstance();
        return view('admin.partnerships.overview-edit', compact('page'));
    }

    public function updateOverview(Request $request): RedirectResponse
    {
        $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'hero_banner' => 'nullable|image|max:5120',
            'overview_content' => 'nullable|string',
        ]);

        $page = PartnersPage::getInstance();

        $bannerPath = $page->getRawOriginal('hero_banner_image_url');
        if ($request->hasFile('hero_banner')) {
            if ($bannerPath && !str_starts_with($bannerPath, 'http')) {
                Storage::disk('public')->delete($bannerPath);
            }
            $bannerPath = $request->file('hero_banner')->store('partnerships/banners', 'public');
        }

        $page->update([
            'hero_title' => $request->input('hero_title', $page->hero_title),
            'hero_subtitle' => $request->input('hero_subtitle', $page->hero_subtitle),
            'hero_banner_image_url' => $bannerPath,
            'overview_content' => $request->input('overview_content', $page->overview_content),
        ]);

        return redirect()->route('admin.partnerships.overview-edit')
            ->with('success', 'Partners page overview updated successfully!');
    }
}
