<?php

namespace App\Http\Controllers;

use App\Models\PartnershipDocument;
use Illuminate\Http\JsonResponse;

class PartnershipDocumentsApiController extends Controller
{
    /**
     * Get all partnership documents
     */
    public function index(): JsonResponse
    {
        $documents = PartnershipDocument::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return response()->json(['data' => $documents]);
    }

    /**
     * Get documents by category
     */
    public function byCategory(string $category): JsonResponse
    {
        $documents = PartnershipDocument::where('is_active', true)
            ->where('document_category', $category)
            ->orderBy('display_order')
            ->get();

        return response()->json(['data' => $documents]);
    }
}
