<?php

namespace App\Http\Controllers;

use App\Models\SpecializedCenter;
use Illuminate\Http\JsonResponse;

class SpecializedCentersApiController extends Controller
{
    public function index(): JsonResponse
    {
        $centers = SpecializedCenter::ordered()->get();

        return response()->json(['success' => true, 'data' => $centers]);
    }
}
