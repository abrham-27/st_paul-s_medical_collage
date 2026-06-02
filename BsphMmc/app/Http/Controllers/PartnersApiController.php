<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\PartnersPage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PartnersApiController extends Controller
{
    /**
     * Get partners page settings
     */
    public function pageSettings(): JsonResponse
    {
        $page = PartnersPage::getInstance();
        return response()->json($page);
    }

    /**
     * Get all partners (paginated, filterable)
     */
    public function index(Request $request): JsonResponse
    {
        $query = Partner::where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('created_at', 'desc');

        // Filter by category
        if ($request->has('category')) {
            $category = PartnerCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured === 'true') {
            $query->where('is_featured', true);
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('short_description', 'like', "%$search%");
            });
        }

        $perPage = $request->get('per_page', 12);
        $partners = $query->paginate($perPage);

        return response()->json($partners);
    }

    /**
     * Get local partners
     */
    public function local(Request $request): JsonResponse
    {
        $category = PartnerCategory::where('slug', 'local')->first();
        
        if (!$category) {
            return response()->json(['data' => []], 200);
        }

        $partners = Partner::where('is_active', true)
            ->where('category_id', $category->id)
            ->orderBy('display_order')
            ->get();

        return response()->json(['data' => $partners]);
    }

    /**
     * Get external/international partners
     */
    public function external(Request $request): JsonResponse
    {
        $category = PartnerCategory::where('slug', 'external')->first();
        
        if (!$category) {
            return response()->json(['data' => []], 200);
        }

        $partners = Partner::where('is_active', true)
            ->where('category_id', $category->id)
            ->orderBy('display_order')
            ->get();

        return response()->json(['data' => $partners]);
    }

    /**
     * Get featured partners
     */
    public function featured(): JsonResponse
    {
        $partners = Partner::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->limit(6)
            ->get();

        return response()->json(['data' => $partners]);
    }

    /**
     * Get single partner by slug
     */
    public function show(string $slug): JsonResponse
    {
        $partner = Partner::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->first();

        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        return response()->json($partner);
    }
}
