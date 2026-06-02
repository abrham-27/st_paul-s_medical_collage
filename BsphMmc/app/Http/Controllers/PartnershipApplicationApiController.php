<?php

namespace App\Http\Controllers;

use App\Models\PartnershipApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PartnershipApplicationApiController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'institution_type' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'city' => 'nullable|string|max:100',
            'website_url' => 'nullable|url|max:500',
            'contact_person_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_role' => 'nullable|string|max:255',
            'collaboration_interests' => 'nullable|string|max:5000',
            'message' => 'nullable|string|max:5000',
        ]);

        $application = PartnershipApplication::create([
            ...$validated,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your partnership application has been submitted successfully. Our team will review it and contact you soon.',
            'data' => ['id' => $application->id],
        ], 201);
    }
}
