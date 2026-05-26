<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{OfficePage, OfficeGallery, OfficeService, OfficeProject, OfficeContact};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AllOfficesController extends Controller
{
    private const ALLOWED_OFFICES = [
        'provost' => 'Provost Office',
        'bdvp' => 'Business Development Vice Provost',
        'msvp' => 'Medical Service Vice Provost',
        'finance' => 'Finance Office',
        'arvp' => 'Academic Research Vice Provost',
        'registrar' => 'Registrar Office',
        'ict' => 'ICT Department',
        'library' => 'Library Services',
    ];

    private function validateOffice(string $office): string
    {
        if (!array_key_exists($office, self::ALLOWED_OFFICES)) {
            abort(404, 'Office not found');
        }
        return $office;
    }

    private function getOfficeName(string $office): string
    {
        return self::ALLOWED_OFFICES[$office] ?? 'Unknown Office';
    }

    // About/Page Management
    public function about(Request $request)
    {
        $selectedOffice = $request->get('office', 'provost');
        $selectedOffice = $this->validateOffice($selectedOffice);
        
        $page = OfficePage::getOrCreate($selectedOffice);
        $offices = self::ALLOWED_OFFICES;
        
        return view('admin.all-offices.about', compact('page', 'selectedOffice', 'offices'));
    }

    public function updateAbout(Request $request)
    {
        $office = $this->validateOffice($request->office);
        
        $validated = $request->validate([
            'office' => 'required|string',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|max:3072'
        ]);

        $page = OfficePage::getOrCreate($office);
        
        if ($request->hasFile('featured_image')) {
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store("offices/{$office}", 'public');
        }

        unset($validated['office']); // Remove office from validated data
        $page->update($validated);
        
        return redirect()->route('admin.all-offices.about', ['office' => $office])
            ->with('success', 'About section updated successfully.');
    }

    // Services Management
    public function services(Request $request)
    {
        $selectedOffice = $request->get('office', 'provost');
        $selectedOffice = $this->validateOffice($selectedOffice);
        
        $items = OfficeService::where('office_type', $selectedOffice)->ordered()->paginate(20);
        $offices = self::ALLOWED_OFFICES;
        
        return view('admin.all-offices.services', compact('items', 'selectedOffice', 'offices'));
    }

    public function storeService(Request $request)
    {
        $office = $this->validateOffice($request->office);
        
        $validated = $request->validate([
            'office' => 'required|string',
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive'
        ]);

        $validated['office_type'] = $office;
        unset($validated['office']);
        
        OfficeService::create($validated);
        
        return redirect()->route('admin.all-offices.services', ['office' => $office])
            ->with('success', 'Service created successfully.');
    }

    public function updateService(Request $request, OfficeService $officeService)
    {
        $office = $this->validateOffice($request->office);
        
        $validated = $request->validate([
            'office' => 'required|string',
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive'
        ]);

        unset($validated['office']);
        $officeService->update($validated);
        
        return redirect()->route('admin.all-offices.services', ['office' => $office])
            ->with('success', 'Service updated successfully.');
    }

    public function destroyService(Request $request, OfficeService $officeService)
    {
        $office = $this->validateOffice($request->office);
        
        $officeService->delete();
        
        return redirect()->route('admin.all-offices.services', ['office' => $office])
            ->with('success', 'Service deleted successfully.');
    }

    // Projects Management
    public function projects(Request $request)
    {
        $selectedOffice = $request->get('office', 'provost');
        $selectedOffice = $this->validateOffice($selectedOffice);
        
        $items = OfficeProject::where('office_type', $selectedOffice)->latest()->paginate(15);
        $offices = self::ALLOWED_OFFICES;
        
        return view('admin.all-offices.projects', compact('items', 'selectedOffice', 'offices'));
    }

    public function createProject(Request $request)
    {
        $selectedOffice = $request->get('office', 'provost');
        $selectedOffice = $this->validateOffice($selectedOffice);
        
        $offices = self::ALLOWED_OFFICES;
        
        return view('admin.all-offices.project-form', [
            'project' => null, 
            'selectedOffice' => $selectedOffice, 
            'offices' => $offices
        ]);
    }

    public function storeProject(Request $request)
    {
        $office = $this->validateOffice($request->office);
        
        $validated = $request->validate([
            'office' => 'required|string',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:3072',
            'status' => 'required|in:published,draft'
        ]);

        $validated['office_type'] = $office;
        $validated['slug'] = OfficeProject::generateSlug($validated['title']);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store("offices/{$office}/projects", 'public');
        }

        unset($validated['office']);
        OfficeProject::create($validated);
        
        return redirect()->route('admin.all-offices.projects', ['office' => $office])
            ->with('success', 'Project created successfully.');
    }

    public function editProject(Request $request, OfficeProject $officeProject)
    {
        $selectedOffice = $request->get('office', $officeProject->office_type);
        $selectedOffice = $this->validateOffice($selectedOffice);
        
        $offices = self::ALLOWED_OFFICES;
        
        return view('admin.all-offices.project-form', [
            'project' => $officeProject, 
            'selectedOffice' => $selectedOffice, 
            'offices' => $offices
        ]);
    }

    public function updateProject(Request $request, OfficeProject $officeProject)
    {
        $office = $this->validateOffice($request->office);
        
        $validated = $request->validate([
            'office' => 'required|string',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:3072',
            'status' => 'required|in:published,draft'
        ]);

        if ($request->hasFile('image')) {
            if ($officeProject->image) {
                Storage::disk('public')->delete($officeProject->image);
            }
            $validated['image'] = $request->file('image')->store("offices/{$office}/projects", 'public');
        }

        unset($validated['office']);
        $officeProject->update($validated);
        
        return redirect()->route('admin.all-offices.projects', ['office' => $office])
            ->with('success', 'Project updated successfully.');
    }

    public function destroyProject(Request $request, OfficeProject $officeProject)
    {
        $office = $this->validateOffice($request->office);
        
        if ($officeProject->image) {
            Storage::disk('public')->delete($officeProject->image);
        }
        
        $officeProject->delete();
        
        return redirect()->route('admin.all-offices.projects', ['office' => $office])
            ->with('success', 'Project deleted successfully.');
    }

    // Contact Management
    public function contact(Request $request)
    {
        $selectedOffice = $request->get('office', 'provost');
        $selectedOffice = $this->validateOffice($selectedOffice);
        
        $contact = OfficeContact::getOrCreate($selectedOffice);
        $offices = self::ALLOWED_OFFICES;
        
        return view('admin.all-offices.contact', compact('contact', 'selectedOffice', 'offices'));
    }

    public function updateContact(Request $request)
    {
        $office = $this->validateOffice($request->office);
        
        $validated = $request->validate([
            'office' => 'required|string',
            'office_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255'
        ]);

        unset($validated['office']);
        OfficeContact::getOrCreate($office)->update($validated);
        
        return redirect()->route('admin.all-offices.contact', ['office' => $office])
            ->with('success', 'Contact information updated successfully.');
    }
}