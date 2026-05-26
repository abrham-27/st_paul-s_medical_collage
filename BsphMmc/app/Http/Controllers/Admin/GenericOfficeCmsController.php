<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{OfficePage, OfficeGallery, OfficeService, OfficeProject, OfficeContact, OfficeProcess};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GenericOfficeCmsController extends Controller
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
    public function about(string $office)
    {
        $office = $this->validateOffice($office);
        $officeName = $this->getOfficeName($office);
        $page = OfficePage::getOrCreate($office);
        return view('admin.offices.generic.about', compact('page', 'office', 'officeName'));
    }

    public function updateAbout(Request $request, string $office)
    {
        $office = $this->validateOffice($office);
        $validated = $request->validate([
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

        $page->update($validated);
        return back()->with('success', 'About section updated.');
    }

    // Gallery Management
    public function gallery(string $office)
    {
        $office = $this->validateOffice($office);
        $officeName = $this->getOfficeName($office);
        $items = OfficeGallery::where('office_type', $office)->orderBy('sort_order')->paginate(20);
        return view('admin.offices.generic.gallery', compact('items', 'office', 'officeName'));
    }

    public function storeGallery(Request $request, string $office)
    {
        $office = $this->validateOffice($office);
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|max:3072'
        ]);

        foreach ($request->file('images') as $file) {
            OfficeGallery::create([
                'office_type' => $office,
                'title' => $request->title,
                'category' => $request->category,
                'image' => $file->store("offices/{$office}/gallery", 'public'),
                'sort_order' => OfficeGallery::where('office_type', $office)->max('sort_order') + 1,
            ]);
        }

        return back()->with('success', 'Images uploaded.');
    }

    public function destroyGallery(string $office, OfficeGallery $officeGallery)
    {
        $office = $this->validateOffice($office);
        
        if ($officeGallery->office_type !== $office) {
            abort(404);
        }

        Storage::disk('public')->delete($officeGallery->image);
        $officeGallery->delete();
        return back()->with('success', 'Image deleted.');
    }

    // Services Management
    public function services(string $office)
    {
        $office = $this->validateOffice($office);
        $officeName = $this->getOfficeName($office);
        $items = OfficeService::where('office_type', $office)->ordered()->paginate(20);
        return view('admin.offices.generic.services', compact('items', 'office', 'officeName'));
    }

    public function storeService(Request $request, string $office)
    {
        $office = $this->validateOffice($office);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive'
        ]);

        $validated['office_type'] = $office;
        OfficeService::create($validated);
        return back()->with('success', 'Service created.');
    }

    public function updateService(Request $request, string $office, OfficeService $officeService)
    {
        $office = $this->validateOffice($office);
        
        if ($officeService->office_type !== $office) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'display_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive'
        ]);

        $officeService->update($validated);
        return back()->with('success', 'Service updated.');
    }

    public function destroyService(string $office, OfficeService $officeService)
    {
        $office = $this->validateOffice($office);
        
        if ($officeService->office_type !== $office) {
            abort(404);
        }

        $officeService->delete();
        return back()->with('success', 'Service deleted.');
    }

    // Projects Management
    public function projects(string $office)
    {
        $office = $this->validateOffice($office);
        $officeName = $this->getOfficeName($office);
        $items = OfficeProject::where('office_type', $office)->latest()->paginate(15);
        return view('admin.offices.generic.projects', compact('items', 'office', 'officeName'));
    }

    public function createProject(string $office)
    {
        $office = $this->validateOffice($office);
        $officeName = $this->getOfficeName($office);
        return view('admin.offices.generic.project-form', ['project' => null, 'office' => $office, 'officeName' => $officeName]);
    }

    public function storeProject(Request $request, string $office)
    {
        $office = $this->validateOffice($office);
        $validated = $request->validate([
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

        OfficeProject::create($validated);
        return redirect()->route('admin.offices.generic.projects', ['office' => $office])
            ->with('success', 'Project created.');
    }

    public function editProject(string $office, OfficeProject $officeProject)
    {
        $office = $this->validateOffice($office);
        $officeName = $this->getOfficeName($office);
        
        if ($officeProject->office_type !== $office) {
            abort(404);
        }

        return view('admin.offices.generic.project-form', ['project' => $officeProject, 'office' => $office, 'officeName' => $officeName]);
    }

    public function updateProject(Request $request, string $office, OfficeProject $officeProject)
    {
        $office = $this->validateOffice($office);
        
        if ($officeProject->office_type !== $office) {
            abort(404);
        }

        $validated = $request->validate([
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

        $officeProject->update($validated);
        return redirect()->route('admin.offices.generic.projects', ['office' => $office])
            ->with('success', 'Project updated.');
    }

    public function destroyProject(string $office, OfficeProject $officeProject)
    {
        $office = $this->validateOffice($office);
        
        if ($officeProject->office_type !== $office) {
            abort(404);
        }

        if ($officeProject->image) {
            Storage::disk('public')->delete($officeProject->image);
        }
        
        $officeProject->delete();
        return back()->with('success', 'Project deleted.');
    }

    // Process Management
    public function process(string $office)
    {
        $office = $this->validateOffice($office);
        $officeName = $this->getOfficeName($office);
        $items = OfficeProcess::where('office_type', $office)->orderBy('step_number')->paginate(20);
        return view('admin.offices.generic.process', compact('items', 'office', 'officeName'));
    }

    public function storeProcess(Request $request, string $office)
    {
        $office = $this->validateOffice($office);
        $validated = $request->validate([
            'step_number' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'status' => 'required|in:active,inactive'
        ]);

        $validated['office_type'] = $office;
        OfficeProcess::create($validated);
        return back()->with('success', 'Process step created.');
    }

    public function updateProcess(Request $request, string $office, OfficeProcess $officeProcess)
    {
        $office = $this->validateOffice($office);
        
        if ($officeProcess->office_type !== $office) {
            abort(404);
        }

        $validated = $request->validate([
            'step_number' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'status' => 'required|in:active,inactive'
        ]);

        $officeProcess->update($validated);
        return back()->with('success', 'Process step updated.');
    }

    public function destroyProcess(string $office, OfficeProcess $officeProcess)
    {
        $office = $this->validateOffice($office);
        
        if ($officeProcess->office_type !== $office) {
            abort(404);
        }

        $officeProcess->delete();
        return back()->with('success', 'Process step deleted.');
    }

    // Contact Management
    public function contact(string $office)
    {
        $office = $this->validateOffice($office);
        $officeName = $this->getOfficeName($office);
        $contact = OfficeContact::getOrCreate($office);
        return view('admin.offices.generic.contact', compact('contact', 'office', 'officeName'));
    }

    public function updateContact(Request $request, string $office)
    {
        $office = $this->validateOffice($office);
        $validated = $request->validate([
            'office_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255'
        ]);

        OfficeContact::getOrCreate($office)->update($validated);
        return back()->with('success', 'Contact info updated.');
    }
}