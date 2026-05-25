<?php

namespace App\Http\Controllers;

use App\Models\SchoolResearchPublication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcademicResearchPublicationApiController extends Controller
{
    private const ALLOWED_SCHOOLS = ['medicine', 'nursing', 'public_health'];

    public function index(string $school, Request $request): JsonResponse
    {
        $school = $this->normalizeSchool($school);

        $query = SchoolResearchPublication::published()
            ->where('school_type', $school)
            ->orderByDesc('featured')
            ->orderByDesc('publication_date');

        $perPage = 9;
        $publications = $query->paginate($perPage);

        $data = $publications->through(function (SchoolResearchPublication $publication) {
            return $this->transform($publication);
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'current_page' => $publications->currentPage(),
                'last_page' => $publications->lastPage(),
                'per_page' => $publications->perPage(),
                'total' => $publications->total(),
            ],
        ]);
    }

    public function show(string $school, string $slug): JsonResponse
    {
        $school = $this->normalizeSchool($school);

        $publication = SchoolResearchPublication::published()
            ->where('school_type', $school)
            ->where('slug', $slug)
            ->first();

        if (! $publication) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $this->transform($publication)]);
    }

    private function transform(SchoolResearchPublication $publication): array
    {
        return [
            'id' => $publication->id,
            'slug' => $publication->slug,
            'school_type' => $publication->school_type,
            'title' => $publication->title,
            'subtitle' => $publication->subtitle,
            'abstract' => $publication->abstract,
            'authors' => $publication->authors,
            'publication_type' => $publication->publication_type,
            'publication_date' => $publication->publication_date ? $publication->publication_date->toDateString() : null,
            'journal_name' => $publication->journal_name,
            'doi_link' => $publication->doi_link,
            'external_link' => $publication->external_link,
            'cover_image' => $publication->cover_image ? asset('storage/' . $publication->cover_image) : null,
            'pdf_file' => $publication->pdf_file ? asset('storage/' . $publication->pdf_file) : null,
            'keywords' => $publication->keywords,
            'featured' => $publication->featured,
            'status' => $publication->status,
            'display_order' => $publication->display_order,
            'created_at' => $publication->created_at->toDateTimeString(),
            'updated_at' => $publication->updated_at->toDateTimeString(),
        ];
    }

    private function normalizeSchool(string $school): string
    {
        if ($school === 'public-health') {
            $school = 'public_health';
        }

        if (! in_array($school, self::ALLOWED_SCHOOLS, true)) {
            abort(404);
        }

        return $school;
    }
}
