<?php

namespace App\Http\Controllers;

use App\Models\PartnershipArea;
use Illuminate\Http\JsonResponse;

class PartnershipAreasApiController extends Controller
{
    /**
     * Get all partnership areas
     */
    public function index(): JsonResponse
    {
        $areas = PartnershipArea::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return response()->json(['data' => $areas]);
    }
}
