<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HomeHero;
use Illuminate\Http\JsonResponse;

class HomeHeroApiController extends Controller
{
    public function index(): JsonResponse
    {
        $slides = HomeHero::active()->get()->map(function ($slide) {
            if ($slide->image && !str_starts_with($slide->image, 'http')) {
                $slide->image = $slide->image_url;
            }
            return $slide;
        });

        return response()->json([
            'success' => true,
            'data' => $slides,
        ]);
    }
}
