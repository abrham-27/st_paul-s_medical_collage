<?php
namespace App\Http\Controllers;
use App\Models\{OfficePage, OfficeGallery, OfficeService, OfficeProject, OfficeProcess, OfficeContact};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfficeApiController extends Controller
{
    private function img(?string $p): ?string {
        if (!$p) return null;
        return str_starts_with($p,'http') ? $p : asset('storage/'.$p);
    }

    public function page(string $office): JsonResponse {
        $page = OfficePage::where('office_type',$office)->first();
        if ($page && $page->featured_image) $page->featured_image = $this->img($page->featured_image);
        return response()->json(['success'=>true,'data'=>$page]);
    }

    public function gallery(string $office): JsonResponse {
        $items = OfficeGallery::where('office_type',$office)->orderBy('sort_order')->get()
            ->map(fn($i) => array_merge($i->toArray(), ['image'=>$this->img($i->image)]));
        return response()->json(['success'=>true,'data'=>$items]);
    }

    public function services(string $office): JsonResponse {
        $items = OfficeService::where('office_type',$office)->active()->ordered()->get()
            ->map(fn($i) => array_merge($i->toArray(), ['icon'=>$this->img($i->icon)]));
        return response()->json(['success'=>true,'data'=>$items]);
    }

    public function projects(string $office): JsonResponse {
        $items = OfficeProject::where('office_type',$office)->published()->latest()->get()
            ->map(fn($i) => array_merge($i->toArray(), ['image'=>$this->img($i->image)]));
        return response()->json(['success'=>true,'data'=>$items]);
    }

    public function project(string $office, string $slug): JsonResponse {
        $p = OfficeProject::where('office_type',$office)->where('slug',$slug)->published()->firstOrFail();
        $data = $p->toArray();
        $data['image'] = $this->img($p->image);
        return response()->json(['success'=>true,'data'=>$data]);
    }

    public function process(string $office): JsonResponse {
        $items = OfficeProcess::where('office_type',$office)->active()->ordered()->get()
            ->map(fn($i) => array_merge($i->toArray(), ['icon'=>$this->img($i->icon)]));
        return response()->json(['success'=>true,'data'=>$items]);
    }

    public function contact(string $office): JsonResponse {
        $c = OfficeContact::where('office_type',$office)->first();
        return response()->json(['success'=>true,'data'=>$c]);
    }
}
