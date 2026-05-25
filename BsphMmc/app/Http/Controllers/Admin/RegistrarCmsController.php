<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{OfficePage, OfficeService, OfficeProcess, OfficeContact};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegistrarCmsController extends Controller
{
    // About Registrar
    public function about()
    {
        $page = OfficePage::where('office_type', 'registrar')->first();
        if (!$page) {
            $page = new OfficePage([
                'office_type' => 'registrar',
                'title' => '',
                'description' => '',
                'featured_image' => null,
            ]);
        }
        return view('admin.offices.registrar.about', compact('page'));
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $page = OfficePage::updateOrCreate(
            ['office_type' => 'registrar'],
            [
                'title' => $request->title,
                'description' => $request->description,
                'featured_image' => $request->hasFile('featured_image') 
                    ? $request->file('featured_image')->store('office-images', 'public')
                    : null,
            ]
        );

        return redirect()->route('admin.offices.registrar.about')
            ->with('success', 'About Registrar page updated successfully!');
    }

    // Registrar Services
    public function services()
    {
        $services = OfficeService::where('office_type', 'registrar')
            ->active()
            ->ordered()
            ->get();
        return view('admin.offices.registrar.services', compact('services'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'display_order' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive'
        ]);

        $service = OfficeService::create([
            'office_type' => 'registrar',
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->hasFile('icon') 
                ? $request->file('icon')->store('service-icons', 'public')
                : null,
            'display_order' => $request->display_order,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.offices.registrar.services')
            ->with('success', 'Service added successfully!');
    }

    public function updateService(Request $request, OfficeService $officeService)
    {
        if ($officeService->office_type !== 'registrar') {
            abort(404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'display_order' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'display_order' => $request->display_order,
            'status' => $request->status,
        ];

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('service-icons', 'public');
        }

        $officeService->update($data);

        return redirect()->route('admin.offices.registrar.services')
            ->with('success', 'Service updated successfully!');
    }

    public function destroyService(OfficeService $officeService)
    {
        if ($officeService->office_type !== 'registrar') {
            abort(404);
        }

        $officeService->delete();

        return redirect()->route('admin.offices.registrar.services')
            ->with('success', 'Service deleted successfully!');
    }

    // Registration Process
    public function process()
    {
        $processes = OfficeProcess::where('office_type', 'registrar')
            ->active()
            ->ordered()
            ->get();
        return view('admin.offices.registrar.process', compact('processes'));
    }

    public function createProcess()
    {
        return view('admin.offices.registrar.create-process');
    }

    public function storeProcess(Request $request)
    {
        $request->validate([
            'step_number' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'sort_order' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive'
        ]);

        OfficeProcess::create([
            'office_type' => 'registrar',
            'step_number' => $request->step_number,
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->hasFile('icon') 
                ? $request->file('icon')->store('process-icons', 'public')
                : null,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.offices.registrar.process')
            ->with('success', 'Process step added successfully!');
    }

    public function editProcess(OfficeProcess $officeProcess)
    {
        if ($officeProcess->office_type !== 'registrar') {
            abort(404);
        }

        return view('admin.offices.registrar.edit-process', compact('officeProcess'));
    }

    public function updateProcess(Request $request, OfficeProcess $officeProcess)
    {
        if ($officeProcess->office_type !== 'registrar') {
            abort(404);
        }

        $request->validate([
            'step_number' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'sort_order' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive'
        ]);

        $data = [
            'step_number' => $request->step_number,
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ];

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('process-icons', 'public');
        }

        $officeProcess->update($data);

        return redirect()->route('admin.offices.registrar.process')
            ->with('success', 'Process step updated successfully!');
    }

    public function destroyProcess(OfficeProcess $officeProcess)
    {
        if ($officeProcess->office_type !== 'registrar') {
            abort(404);
        }

        $officeProcess->delete();

        return redirect()->route('admin.offices.registrar.process')
            ->with('success', 'Process step deleted successfully!');
    }

    // Contact Info
    public function contact()
    {
        $contact = OfficeContact::where('office_type', 'registrar')->first();
        if (!$contact) {
            $contact = new OfficeContact([
                'office_type' => 'registrar',
                'office_name' => 'Registrar Office',
                'email' => '',
                'phone' => '',
                'location' => '',
                'working_hours' => '',
            ]);
        }
        return view('admin.offices.registrar.contact', compact('contact'));
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'working_hours' => 'required|string|max:255'
        ]);

        OfficeContact::updateOrCreate(
            ['office_type' => 'registrar'],
            [
                'office_name' => $request->office_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
                'working_hours' => $request->working_hours,
            ]
        );

        return redirect()->route('admin.offices.registrar.contact')
            ->with('success', 'Contact information updated successfully!');
    }
}
