<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Leader;
use App\Models\MissionVision;
use App\Models\CoreValue;
use Illuminate\Http\JsonResponse;

class AboutController extends Controller
{
    public function aboutPage(): JsonResponse
    {
        $about = AboutPage::instance();

        if ($about->featured_image) {
            $about->featured_image_url = asset('storage/' . $about->featured_image);
        }

        return response()->json(['success' => true, 'data' => $about]);
    }

    public function leaders(): JsonResponse
    {
        $leaders = Leader::active()->ordered()->get()->map(function ($leader) {
            if ($leader->profile_image) {
                $leader->profile_image_url = asset('storage/' . $leader->profile_image);
            }
            return $leader;
        });

        return response()->json(['success' => true, 'data' => $leaders]);
    }

    public function missionVisionValues(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'mission' => MissionVision::mission(),
                'vision'  => MissionVision::vision(),
                'values'  => CoreValue::ordered()->get(),
            ],
        ]);
    }
}
