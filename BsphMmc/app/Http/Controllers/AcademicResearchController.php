<?php

namespace App\Http\Controllers;

use App\Models\SchoolResearchPublication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcademicResearchController extends Controller
{
    private const ALLOWED_SCHOOLS = ['medicine', 'nursing', 'public_health'];

    public function index(Request $request): JsonResponse
    {
        $query = SchoolResearchPublication::published()
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = '%' . trim($request->string('search')) . '%';

                $query->where(function ($inner) use ($term) {
                    $inner->where('title', 'like', $term)
                        ->orWhere('subtitle', 'like', $term)
                        ->orWhere('abstract', 'like', $term)
                        ->orWhere('authors', 'like', $term)
                        ->orWhere('journal_name', 'like', $term)
                        ->orWhere('keywords', 'like', $term);
                });
            })
            ->when($request->filled('school_type'), function ($query) use ($request) {
                $query->where('school_type', $this->normalizeSchool($request->string('school_type')));
            })
            ->when($request->filled('publication_type'), function ($query) use ($request) {
                $query->where('publication_type', $request->string('publication_type'));
            })
            ->orderByRaw('COALESCE(publication_date, created_at) DESC')
            ->orderByDesc('created_at');

        $perPage = max(1, min(1000, (int) $request->input('per_page', 12)));
        $publications = $query->paginate($perPage);

        $publicationTypes = SchoolResearchPublication::published()
            ->select('publication_type')
            ->whereNotNull('publication_type')
            ->where('publication_type', '!=', '')
            ->distinct()
            ->orderBy('publication_type')
            ->pluck('publication_type')
            ->values()
            ->all();

        return response()->json([
            'success' => true,
            'data' => $publications->through(function (SchoolResearchPublication $publication) {
                return $this->transform($publication);
            }),
            'meta' => [
                'current_page' => $publications->currentPage(),
                'last_page' => $publications->lastPage(),
                'per_page' => $publications->perPage(),
                'total' => $publications->total(),
                'publication_types' => $publicationTypes,
            ],
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $publication = SchoolResearchPublication::published()
            ->where('slug', $slug)
            ->first();

        if (! $publication) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->transform($publication),
        ]);
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
