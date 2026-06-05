<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\AlumniEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlumniApiController extends Controller
{
    /**
     * Get all active alumni with optional filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = Alumni::where('is_active', true);

        // Filter by featured status
        if ($request->has('featured')) {
            $query->where('is_featured', $request->boolean('featured'));
        }

        // Filter by specialty
        if ($request->filled('specialty') && $request->input('specialty') !== 'all') {
            $query->where('specialty', $request->input('specialty'));
        }

        // Filter by graduation year
        if ($request->filled('year') && $request->input('year') !== 'all') {
            $query->where('graduation_year', $request->integer('year'));
        }

        // Search name, specialty, workplace, or location
        if ($request->filled('search')) {
            $search = '%' . $request->input('search') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('specialty', 'like', $search)
                  ->orWhere('workplace', 'like', $search)
                  ->orWhere('location', 'like', $search);
            });
        }

        // Return latest first
        $alumni = $query->orderBy('graduation_year', 'desc')
                        ->orderBy('name', 'asc')
                        ->get();

        return response()->json([
            'success' => true,
            'data' => $alumni
        ]);
    }

    /**
     * Get dynamic alumni statistics
     */
    public function stats(): JsonResponse
    {
        $count = Alumni::where('is_active', true)->count();
        $countries = Alumni::where('is_active', true)
            ->whereNotNull('location')
            ->where('location', '<>', '')
            ->distinct('location')
            ->count('location');
            
        $specialists = Alumni::where('is_active', true)
            ->whereNotNull('specialty')
            ->where('specialty', '<>', '')
            ->distinct('specialty')
            ->count('specialty');
            
        $publications = Alumni::where('is_active', true)->sum('publications');

        return response()->json([
            'success' => true,
            'data' => [
                [
                    'number' => (5000 + $count) . '+',
                    'label' => 'Alumni Worldwide',
                    'icon' => '🌍'
                ],
                [
                    'number' => (45 + $countries) . '+',
                    'label' => 'Countries Represented',
                    'icon' => '🏛️'
                ],
                [
                    'number' => (200 + $specialists) . '+',
                    'label' => 'Specialists Trained',
                    'icon' => '🩺'
                ],
                [
                    'number' => (1000 + $publications) . '+',
                    'label' => 'Research Publications',
                    'icon' => '🔬'
                ],
                [
                    'number' => '50+',
                    'label' => 'Hospital Directors',
                    'icon' => '🏥'
                ],
                [
                    'number' => '25+',
                    'label' => 'Academic Faculty',
                    'icon' => '🎓'
                ]
            ]
        ]);
    }

    /**
     * Get active upcoming events
     */
    public function events(): JsonResponse
    {
        $events = AlumniEvent::where('is_active', true)
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    /**
     * Register a new alumnus profile request
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer',
            'degree' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'current_position' => 'nullable|string|max:255',
            'workplace' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'linkedin' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'research_gate' => 'nullable|string|max:255',
            'publications' => 'nullable|integer',
            'achievements' => 'nullable',
            'awards' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Handle JSON fields (if sent as strings from multipart form data)
        if (isset($data['achievements']) && is_string($data['achievements'])) {
            $data['achievements'] = json_decode($data['achievements'], true) ?? [];
        }
        if (isset($data['awards']) && is_string($data['awards'])) {
            $data['awards'] = json_decode($data['awards'], true) ?? [];
        }

        // Process file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('alumni', 'public');
            $data['image'] = $path;
        } else {
            // Default placeholder image
            $data['image'] = 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face';
        }

        // Auto-approve and activate profiles for immediate display and testing
        $data['is_active'] = true;
        $data['is_featured'] = false;

        $alumnus = Alumni::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile registered successfully!',
            'data' => $alumnus
        ], 201);
    }
}
