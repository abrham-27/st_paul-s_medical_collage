<?php

namespace App\Http\Controllers;

use App\Models\NursingPartnership;
use Illuminate\Http\JsonResponse;

class NursingPartnershipApiController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $partnerships = NursingPartnership::where('status', 1)
                ->orderBy('display_order')
                ->orderBy('title')
                ->get()
                ->map(fn ($p) => $this->formatListItem($p));

            return response()->json($partnerships);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Partnerships are not available.'], 503);
        }
    }

    public function show(string $slug): JsonResponse
    {
        $partnership = NursingPartnership::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return response()->json($this->formatDetail($partnership));
    }

    private function formatListItem(NursingPartnership $partnership): array
    {
        return [
            'id'             => $partnership->id,
            'title'          => $partnership->title,
            'slug'           => $partnership->slug,
            'area'           => $partnership->area,
            'area_label'     => $partnership->area_label,
            'featured_image' => $this->imageUrl($partnership->featured_image),
            'excerpt'        => $partnership->content
                ? \Illuminate\Support\Str::limit(strip_tags($partnership->content), 160)
                : null,
        ];
    }

    private function formatDetail(NursingPartnership $partnership): array
    {
        return [
            'id'             => $partnership->id,
            'title'          => $partnership->title,
            'slug'           => $partnership->slug,
            'content'        => $partnership->content,
            'area'           => $partnership->area,
            'area_label'     => $partnership->area_label,
            'featured_image' => $this->imageUrl($partnership->featured_image),
            'display_order'  => $partnership->display_order,
        ];
    }

    private function imageUrl(?string $path): ?string
    {
        if (!$path) return null;
        if (str_starts_with($path, 'http')) return $path;
        return asset('storage/' . $path);
    }
}
