<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolResearchPublication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolResearchPublicationController extends Controller
{
    private const ALLOWED_SCHOOLS = [
        'medicine' => 'School of Medicine',
        'nursing' => 'School of Nursing',
        'public_health' => 'School of Public Health',
    ];

    public function index(Request $request, string $school)
    {
        $school = $this->normalizeSchool($school);

        $query = SchoolResearchPublication::query()
            ->where('school_type', $school)
            ->orderByDesc('featured')
            ->orderByDesc('publication_date');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('authors', 'like', '%' . $request->search . '%')
                  ->orWhere('keywords', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('publication_type')) {
            $query->where('publication_type', $request->publication_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('sort') && in_array($request->sort, ['date_asc', 'date_desc'], true)) {
            $query->orderBy('publication_date', $request->sort === 'date_asc' ? 'asc' : 'desc');
        }

        $publications = $query->paginate(15)->withQueryString();
        $schoolName = self::ALLOWED_SCHOOLS[$school];

        return view('admin.academics.research-publications.index', compact('publications', 'school', 'schoolName'));
    }

    public function create(string $school)
    {
        $school = $this->normalizeSchool($school);
        $schoolName = self::ALLOWED_SCHOOLS[$school];
        return view('admin.academics.research-publications.create', compact('school', 'schoolName'));
    }

    public function store(Request $request, string $school)
    {
        $school = $this->normalizeSchool($school);

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'abstract' => 'nullable|string',
                'authors' => 'nullable|string|max:255',
                'publication_type' => 'nullable|string|max:100',
                'publication_date' => 'nullable|date',
                'journal_name' => 'nullable|string|max:255',
                'doi_link' => 'nullable|url|max:500',
                'external_link' => 'nullable|url|max:500',
                'cover_image' => 'nullable|image|max:5120',
                'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
                'keywords' => 'nullable|string|max:500',
                'featured' => 'sometimes|boolean',
                'display_order' => 'nullable|integer',
            ]);

            $validated['school_type'] = $school;
            $validated['featured'] = $request->has('featured');
            $validated['status'] = $request->has('status') ? 'published' : 'draft';
            $validated['display_order'] = $validated['display_order'] ?? 0;
            $validated['slug'] = SchoolResearchPublication::generateSlug($validated['title']);

            // Handle file uploads with error checking
            if ($request->hasFile('cover_image')) {
                $file = $request->file('cover_image');
                if ($file->isValid()) {
                    try {
                        $validated['cover_image'] = $file->store('research/covers', 'public');
                    } catch (\Exception $e) {
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['cover_image' => 'Failed to upload cover image: ' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['cover_image' => 'Invalid cover image file.']);
                }
            }

            if ($request->hasFile('pdf_file')) {
                $file = $request->file('pdf_file');
                if ($file->isValid()) {
                    try {
                        $validated['pdf_file'] = $file->store('research/pdfs', 'public');
                    } catch (\Exception $e) {
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['pdf_file' => 'Failed to upload PDF file: ' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['pdf_file' => 'Invalid PDF file.']);
                }
            }

            SchoolResearchPublication::create($validated);

            return redirect()->route('admin.academics.research-publications.index', ['school' => $school])
                ->with('success', 'Research or publication entry created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create entry: ' . $e->getMessage()]);
        }
    }

    public function edit(string $school, SchoolResearchPublication $publication)
    {
        $school = $this->normalizeSchool($school);
        $schoolName = self::ALLOWED_SCHOOLS[$school];

        if ($publication->school_type !== $school) {
            abort(404);
        }

        return view('admin.academics.research-publications.edit', compact('publication', 'school', 'schoolName'));
    }

    public function update(Request $request, string $school, SchoolResearchPublication $publication)
    {
        $school = $this->normalizeSchool($school);

        if ($publication->school_type !== $school) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'abstract' => 'nullable|string',
            'authors' => 'nullable|string|max:255',
            'publication_type' => 'nullable|string|max:100',
            'publication_date' => 'nullable|date',
            'journal_name' => 'nullable|string|max:255',
            'doi_link' => 'nullable|url|max:500',
            'external_link' => 'nullable|url|max:500',
            'cover_image' => 'nullable|image|max:5120',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'keywords' => 'nullable|string|max:500',
            'featured' => 'sometimes|boolean',
            'display_order' => 'nullable|integer',
        ]);

        $validated['featured'] = $request->has('featured');
        $validated['status'] = $request->has('status') ? 'published' : 'draft';
        $validated['display_order'] = $validated['display_order'] ?? 0;

        // Handle file uploads with error checking
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            if ($file->isValid()) {
                if ($publication->cover_image) {
                    Storage::disk('public')->delete($publication->cover_image);
                }
                $validated['cover_image'] = $file->store('research/covers', 'public');
            }
        }

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            if ($file->isValid()) {
                if ($publication->pdf_file) {
                    Storage::disk('public')->delete($publication->pdf_file);
                }
                $validated['pdf_file'] = $file->store('research/pdfs', 'public');
            }
        }

        $publication->update($validated);

        return redirect()->route('admin.academics.research-publications.index', ['school' => $school])
            ->with('success', 'Research or publication entry updated successfully.');
    }

    public function destroy(string $school, SchoolResearchPublication $publication)
    {
        $school = $this->normalizeSchool($school);

        if ($publication->school_type !== $school) {
            abort(404);
        }

        if ($publication->cover_image) {
            Storage::disk('public')->delete($publication->cover_image);
        }
        if ($publication->pdf_file) {
            Storage::disk('public')->delete($publication->pdf_file);
        }

        $publication->delete();

        return redirect()->route('admin.academics.research-publications.index', ['school' => $school])
            ->with('success', 'Research or publication entry deleted successfully.');
    }

    private function normalizeSchool(string $school): string
    {
        if ($school === 'public-health') {
            $school = 'public_health';
        }

        if (! array_key_exists($school, self::ALLOWED_SCHOOLS)) {
            abort(404);
        }

        return $school;
    }
}
