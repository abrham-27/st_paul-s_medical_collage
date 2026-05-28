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
        try {
            $about = AboutPage::instance();

            // Decode HTML entities in text fields
            $about->page_title = html_entity_decode($about->page_title ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $about->subtitle = html_entity_decode($about->subtitle ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $about->main_description = html_entity_decode($about->main_description ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $about->history_text = html_entity_decode($about->history_text ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $about->seo_title = html_entity_decode($about->seo_title ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $about->seo_description = html_entity_decode($about->seo_description ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
            
            // Handle additional_content JSON
            if ($about->additional_content) {
                $decodedContent = html_entity_decode($about->additional_content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                // Remove HTML tags to extract JSON
                $cleanContent = strip_tags($decodedContent);
                try {
                    $parsedContent = json_decode($cleanContent, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $about->additional_content = $parsedContent;
                    } else {
                        \Log::warning('JSON decode error: ' . json_last_error_msg());
                    }
                } catch (\Exception $e) {
                    \Log::warning('Failed to parse additional_content JSON: ' . $e->getMessage());
                }
            }

            // Ensure featured_image_url is set
            if ($about->featured_image) {
                $about->featured_image_url = asset('storage/' . $about->featured_image);
            }
            
            return response()->json([
                'success' => true, 
                'data' => $about->toArray()
            ]);
        } catch (\Exception $e) {
            \Log::error('About page API error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch about page data'
            ], 500);
        }
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
        try {
            $mission = MissionVision::mission();
            $vision = MissionVision::vision();
            $values = CoreValue::ordered()->get();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'mission' => $mission->toArray(),
                    'vision'  => $vision->toArray(),
                    'values'  => $values->toArray(),
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('Mission Vision Values API error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch mission vision values data'
            ], 500);
        }
    }
}
