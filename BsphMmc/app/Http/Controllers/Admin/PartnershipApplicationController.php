<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnershipApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $query = PartnershipApplication::query()->latest();

        if ($request->filled('status') && array_key_exists($request->status, PartnershipApplication::STATUSES)) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('institution_name', 'like', "%{$search}%")
                    ->orWhere('contact_email', 'like', "%{$search}%")
                    ->orWhere('contact_person_name', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(15)->withQueryString();

        $counts = [
            'pending' => PartnershipApplication::where('status', 'pending')->count(),
            'under_review' => PartnershipApplication::where('status', 'under_review')->count(),
            'approved' => PartnershipApplication::where('status', 'approved')->count(),
            'declined' => PartnershipApplication::where('status', 'declined')->count(),
        ];

        return view('admin.partnerships.applications.index', compact('applications', 'counts'));
    }

    public function show(PartnershipApplication $application): View
    {
        return view('admin.partnerships.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, PartnershipApplication $application): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,declined',
            'admin_feedback' => 'nullable|string|max:5000',
        ]);

        $application->update([
            'status' => $validated['status'],
            'admin_feedback' => $validated['admin_feedback'] ?? $application->admin_feedback,
            'reviewed_at' => now(),
        ]);

        $label = PartnershipApplication::STATUSES[$validated['status']] ?? $validated['status'];

        return redirect()
            ->route('admin.partnerships.applications.show', $application)
            ->with('success', "Application marked as {$label}.");
    }

    public function destroy(PartnershipApplication $application): RedirectResponse
    {
        $application->delete();

        return redirect()
            ->route('admin.partnerships.applications.index')
            ->with('success', 'Application deleted.');
    }
}
