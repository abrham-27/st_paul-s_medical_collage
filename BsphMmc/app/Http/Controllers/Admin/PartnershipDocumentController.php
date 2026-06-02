<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class PartnershipDocumentController extends Controller
{
    public function index(): View
    {
        $documents = PartnershipDocument::orderBy('display_order')->paginate(15);
        return view('admin.partnerships.documents.index', compact('documents'));
    }

    public function create(): View
    {
        return view('admin.partnerships.documents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:partnership_documents',
            'document_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'document_category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['file_url'] = $request->file('document_file')->store('partnerships/documents', 'public');
        $validated['is_active'] = $request->boolean('is_active', true);
        unset($validated['document_file']);

        PartnershipDocument::create($validated);

        return redirect()->route('admin.partnerships.documents.index')
            ->with('success', 'Document created successfully!');
    }

    public function edit(PartnershipDocument $document): View
    {
        return view('admin.partnerships.documents.create', compact('document'));
    }

    public function update(Request $request, PartnershipDocument $document): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:partnership_documents,title,' . $document->id,
            'document_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'document_category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('document_file')) {
            $oldPath = $document->getRawOriginal('file_url');
            if ($oldPath && !str_starts_with($oldPath, 'http')) {
                Storage::disk('public')->delete($oldPath);
            }
            $validated['file_url'] = $request->file('document_file')->store('partnerships/documents', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        unset($validated['document_file']);

        $document->update($validated);

        return redirect()->route('admin.partnerships.documents.index')
            ->with('success', 'Document updated successfully!');
    }

    public function destroy(PartnershipDocument $document): RedirectResponse
    {
        $path = $document->getRawOriginal('file_url');
        if ($path && !str_starts_with($path, 'http')) {
            Storage::disk('public')->delete($path);
        }
        $document->delete();

        return redirect()->route('admin.partnerships.documents.index')
            ->with('success', 'Document deleted successfully!');
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*' => 'required|integer|exists:partnership_documents,id',
        ]);

        foreach ($validated['items'] as $index => $id) {
            PartnershipDocument::find($id)->update(['display_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
