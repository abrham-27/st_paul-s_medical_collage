<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{OfficePage, OfficeGallery, OfficeService, OfficeProject, OfficeContact};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IctCmsController extends Controller
{
    private const OFFICE = 'ict';

    public function about()
    {
        $page = OfficePage::getOrCreate(self::OFFICE);
        return view('admin.offices.ict.about', compact('page'));
    }

    public function updateAbout(Request $request)
    {
        $v = $request->validate(['title' => 'nullable|string|max:255', 'content' => 'nullable|string', 'featured_image' => 'nullable|image|max:3072']);
        $page = OfficePage::getOrCreate(self::OFFICE);
        if ($request->hasFile('featured_image')) {
            if ($page->featured_image) Storage::disk('public')->delete($page->featured_image);
            $v['featured_image'] = $request->file('featured_image')->store('offices/ict', 'public');
        }
        $page->update($v);
        return back()->with('success', 'About section updated.');
    }

    public function gallery()
    {
        $items = OfficeGallery::where('office_type', self::OFFICE)->orderBy('sort_order')->paginate(20);
        return view('admin.offices.ict.gallery', compact('items'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate(['images' => 'required', 'images.*' => 'image|max:3072']);
        foreach ($request->file('images') as $file) {
            OfficeGallery::create([
                'office_type' => self::OFFICE,
                'title'       => $request->title,
                'category'    => $request->category,
                'image'       => $file->store('offices/ict/gallery', 'public'),
                'sort_order'  => OfficeGallery::where('office_type', self::OFFICE)->max('sort_order') + 1,
            ]);
        }
        return back()->with('success', 'Images uploaded.');
    }

    public function destroyGallery(OfficeGallery $officeGallery)
    {
        Storage::disk('public')->delete($officeGallery->image);
        $officeGallery->delete();
        return back()->with('success', 'Image deleted.');
    }

    public function services()
    {
        $items = OfficeService::where('office_type', self::OFFICE)->ordered()->paginate(20);
        return view('admin.offices.ict.services', compact('items'));
    }

    public function storeService(Request $request)
    {
        $v = $request->validate(['title' => 'required|string|max:255', 'icon' => 'nullable|string|max:10', 'description' => 'nullable|string', 'display_order' => 'nullable|integer', 'status' => 'required|in:active,inactive']);
        $v['office_type'] = self::OFFICE;
        OfficeService::create($v);
        return back()->with('success', 'Service created.');
    }

    public function updateService(Request $request, OfficeService $officeService)
    {
        $v = $request->validate(['title' => 'required|string|max:255', 'icon' => 'nullable|string|max:10', 'description' => 'nullable|string', 'display_order' => 'nullable|integer', 'status' => 'required|in:active,inactive']);
        $officeService->update($v);
        return back()->with('success', 'Service updated.');
    }

    public function destroyService(OfficeService $officeService)
    {
        $officeService->delete();
        return back()->with('success', 'Service deleted.');
    }

    public function projects()
    {
        $items = OfficeProject::where('office_type', self::OFFICE)->latest()->paginate(15);
        return view('admin.offices.ict.projects', compact('items'));
    }

    public function createProject()
    {
        return view('admin.offices.ict.project-form', ['project' => null]);
    }

    public function storeProject(Request $request)
    {
        $v = $request->validate(['title' => 'required|string|max:255', 'excerpt' => 'nullable|string', 'content' => 'nullable|string', 'image' => 'nullable|image|max:3072', 'status' => 'required|in:published,draft']);
        $v['office_type'] = self::OFFICE;
        $v['slug'] = OfficeProject::generateSlug($v['title']);
        if ($request->hasFile('image')) $v['image'] = $request->file('image')->store('offices/ict/projects', 'public');
        OfficeProject::create($v);
        return redirect()->route('admin.offices.ict.projects')->with('success', 'Project created.');
    }

    public function editProject(OfficeProject $officeProject)
    {
        return view('admin.offices.ict.project-form', ['project' => $officeProject]);
    }

    public function updateProject(Request $request, OfficeProject $officeProject)
    {
        $v = $request->validate(['title' => 'required|string|max:255', 'excerpt' => 'nullable|string', 'content' => 'nullable|string', 'image' => 'nullable|image|max:3072', 'status' => 'required|in:published,draft']);
        if ($request->hasFile('image')) {
            if ($officeProject->image) Storage::disk('public')->delete($officeProject->image);
            $v['image'] = $request->file('image')->store('offices/ict/projects', 'public');
        }
        $officeProject->update($v);
        return redirect()->route('admin.offices.ict.projects')->with('success', 'Project updated.');
    }

    public function destroyProject(OfficeProject $officeProject)
    {
        if ($officeProject->image) Storage::disk('public')->delete($officeProject->image);
        $officeProject->delete();
        return back()->with('success', 'Project deleted.');
    }

    public function contact()
    {
        $contact = OfficeContact::getOrCreate(self::OFFICE);
        return view('admin.offices.ict.contact', compact('contact'));
    }

    public function updateContact(Request $request)
    {
        $v = $request->validate(['office_name' => 'nullable|string|max:255', 'email' => 'nullable|email|max:255', 'phone' => 'nullable|string|max:50', 'location' => 'nullable|string|max:255', 'working_hours' => 'nullable|string|max:255']);
        OfficeContact::getOrCreate(self::OFFICE)->update($v);
        return back()->with('success', 'Contact info updated.');
    }
}
