<?php

namespace App\Http\Controllers;

use App\Models\AcademicPage;
use Illuminate\Http\JsonResponse;

class AcademicPageApiController extends Controller
{
    public function show(string $school, string $page): JsonResponse
    {
        $allowed_schools = ['medicine', 'nursing', 'public_health'];
        $allowed_pages   = ['overview', 'partnership', 'dept_epidemiology', 'dept_health_management', 'dept_program'];

        if (!in_array($school, $allowed_schools) || !in_array($page, $allowed_pages)) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        $record = AcademicPage::where('school_type', $school)
            ->where('page_type', $page)
            ->first();

        if (!$record) {
            return response()->json(['success' => true, 'data' => $this->getDefaultAcademicPageData($school, $page)]);
        }

        $hasContent = !empty($record->title)
            || !empty($record->content)
            || !empty($record->secondary_title)
            || !empty($record->secondary_content)
            || !empty($record->tertiary_title)
            || !empty($record->tertiary_content)
            || !empty($record->featured_image);

        if (!$hasContent) {
            return response()->json(['success' => true, 'data' => $this->getDefaultAcademicPageData($school, $page)]);
        }

        $data = $record->toArray();

        if ($record->featured_image && !str_starts_with($record->featured_image, 'http')) {
            $data['featured_image'] = asset('storage/' . $record->featured_image);
        }

        return response()->json(['success' => true, 'data' => $data]);

    }

    protected function getDefaultAcademicPageData(string $school, string $page): ?array
    {
        if ($school === 'public_health' && $page === 'overview') {
            return [
                'title' => 'About School of Public Health',
                'content' => "The School of Public Health (SPH) is one of the schools under Saint Paul's Hospital Millennium Medical College (SPHMMC). SPH is one of the nation's premier schools of public health, with a strong track record of outstanding research, teaching, and community service excellence.",
                'secondary_title' => 'Mission',
                'secondary_content' => 'To advance the health of the people by developing and implementing innovative Public Health Education, research and community services through proposing interventions and health policies based on scientific knowledge and evidence.',
                'tertiary_title' => 'Vision',
                'tertiary_content' => 'Leader in the development of academic programs that are nationally and internationally recognized because of the impact of the innovative researches on health policy and interventions in Ethiopia by 2027/28.',
                'featured_image' => null,
            ];
        }

        if ($school === 'public_health' && $page === 'partnership') {
            return [
                'title' => 'Partnership & Collaboration',
                'content' => 'The School of Public Health at SPHMMC collaborates with national and international partners to advance public health education, research, and community service.',
                'secondary_title' => null,
                'secondary_content' => null,
                'tertiary_title' => null,
                'tertiary_content' => null,
                'featured_image' => null,
            ];
        }

        return null;
    }
}
