<?php

namespace App\Http\Controllers;

use App\Models\PartnershipStatistic;
use Illuminate\Http\JsonResponse;

class PartnershipStatisticsApiController extends Controller
{
    /**
     * Get all partnership statistics
     */
    public function index(): JsonResponse
    {
        $statistics = PartnershipStatistic::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return response()->json(['data' => $statistics]);
    }
}
