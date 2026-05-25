<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LatestPost;
use App\Models\Gallery;
use App\Models\Academic;
use App\Models\Statistic;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts'      => LatestPost::count(),
            'gallery'    => Gallery::count(),
            'academics'  => Academic::count(),
            'statistics' => Statistic::count(),
            'published'  => LatestPost::where('status', 'published')->count(),
            'drafts'     => LatestPost::where('status', 'draft')->count(),
        ];

        $recentPosts = LatestPost::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPosts'));
    }
}
