<?php

namespace App\Http\Controllers;

use App\Models\PartnershipContactInfo;
use Illuminate\Http\JsonResponse;

class PartnershipContactApiController extends Controller
{
    /**
     * Get partnership contact information
     */
    public function index(): JsonResponse
    {
        $contact = PartnershipContactInfo::getInstance();
        return response()->json($contact);
    }
}
