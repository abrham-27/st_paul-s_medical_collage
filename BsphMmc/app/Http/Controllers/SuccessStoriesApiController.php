<?php

namespace App\Http\Controllers;

use App\Models\SuccessStory;
use Illuminate\Http\JsonResponse;

class SuccessStoriesApiController extends Controller
{
    /**
     * Get all success stories
     */
    public function index(): JsonResponse
    {
        $stories = SuccessStory::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return response()->json(['data' => $stories]);
    }

    /**
     * Get single success story
     */
    public function show(string $slug): JsonResponse
    {
        $story = SuccessStory::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$story) {
            return response()->json(['message' => 'Story not found'], 404);
        }

        return response()->json($story);
    }
}
