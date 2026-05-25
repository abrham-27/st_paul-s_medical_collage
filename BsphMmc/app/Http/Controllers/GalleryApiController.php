<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\JsonResponse;

class GalleryApiController extends Controller
{
    public function index(): JsonResponse
    {
        $items = Gallery::orderByDesc('created_at')
            ->take(12)
            ->get()
            ->map(function ($item) {
                if ($item->image && !str_starts_with($item->image, 'http')) {
                    $item->image = asset('storage/' . $item->image);
                }
                return $item;
            });

        return response()->json([
            'success' => true,
            'data'    => $items,
        ]);
    }
}
