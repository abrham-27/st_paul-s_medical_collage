<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipContactInfo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PartnershipContactController extends Controller
{
    /**
     * Show edit form for contact information
     */
    public function edit(): View
    {
        $contact = PartnershipContactInfo::getInstance();
        return view('admin.partnerships.partnership-contact', compact('contact'));
    }

    /**
     * Update contact information
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'office_name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'office_hours' => 'nullable|string',
            'website_url' => 'nullable|url',
        ]);

        $contact = PartnershipContactInfo::getInstance();
        $contact->update($validated);

        return redirect()->route('admin.partnerships.contact.edit')
            ->with('success', 'Contact information updated successfully!');
    }
}
