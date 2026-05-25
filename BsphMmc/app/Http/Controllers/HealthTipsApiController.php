<?php

namespace App\Http\Controllers;

use App\Models\HealthCategory;
use Illuminate\Http\JsonResponse;

class HealthTipsApiController extends Controller
{
    public function categories(): JsonResponse
    {
        $categories = HealthCategory::with('diseases')->ordered()->get();

        return response()->json(['success' => true, 'data' => $categories]);
    }
}
