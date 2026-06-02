<?php

namespace App\Http\Controllers\Admin;

use App\Models\FeaturedPartner;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeaturedPartnerController extends Controller
{
    public function index()
    {
        $featuredPartners = FeaturedPartner::with('partner')
            ->orderBy('display_order')
            ->get();

        $featuredIds = $featuredPartners->pluck('partner_id')->toArray();
        $availablePartners = Partner::where('is_active', true)
            ->whereNotIn('id', $featuredIds)
            ->orderBy('name')
            ->get();

        return view('admin.partnerships.featured-partners', [
            'featuredPartners' => $featuredPartners,
            'availablePartners' => $availablePartners,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'partner_id' => 'required|exists:partners,id',
        ]);

        $count = FeaturedPartner::count();
        if ($count >= 5) {
            return back()->with('error', 'Maximum 5 featured partners allowed');
        }

        FeaturedPartner::create([
            'partner_id' => $validated['partner_id'],
            'display_order' => $count + 1,
        ]);

        return back()->with('success', 'Partner added to featured carousel');
    }

    public function remove($id)
    {
        $featured = FeaturedPartner::findOrFail($id);
        $featured->delete();

        return back()->with('success', 'Partner removed from featured carousel');
    }

    public function reorder(Request $request)
    {
        $partners = $request->input('partners', []);

        foreach ($partners as $index => $partnerId) {
            FeaturedPartner::where('partner_id', $partnerId)
                ->update(['display_order' => $index + 1]);
        }

        return back()->with('success', 'Featured partners reordered successfully');
    }
}
