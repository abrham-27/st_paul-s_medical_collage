@extends('admin.layouts.app')

@section('title', $schoolName . ' — Admin')
@section('page-title', $schoolName)

@section('content')
<div class="py-6 space-y-6">

    {{-- Stats row --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Total Staff</p>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $staffCount }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Active Staff</p>
            <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $activeStaff }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">School</p>
            <p class="text-sm font-semibold text-blue-600 dark:text-blue-400 capitalize">{{ str_replace('_', ' ', $school) }}</p>
        </div>
    </div>

    {{-- Management cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

        {{-- Overview CMS --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-file-lines text-blue-600 dark:text-blue-300"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Overview Page</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">About &middot; Mission &middot; Vision</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                    {{ $overviewPage && $overviewPage->title ? 'Last updated: ' . $overviewPage->updated_at->diffForHumans() : 'Not configured yet.' }}
                </p>
                @if($school === 'nursing')
                    <a href="{{ route('admin.nursing.overview') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Overview
                    </a>
                @elseif($school === 'public_health')
                    <a href="{{ route('admin.public-health.overview') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Overview
                    </a>
                @elseif($school === 'medicine')
                    <a href="{{ route('admin.medicine.overview') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Overview
                    </a>
                @else
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-400 text-xs font-medium rounded-lg cursor-not-allowed">
                        Coming Soon
                    </span>
                @endif
            </div>
        </div>

        {{-- Nursing Departments --}}
        @if($school === 'nursing')
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-sitemap text-teal-600 dark:text-teal-300"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Departments</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Cards &middot; Detail pages &middot; Landing</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                    Manage the four nursing departments and the departments landing page.
                </p>
                <a href="{{ route('admin.nursing.departments.index') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-teal-600 text-white text-xs font-medium rounded-lg hover:bg-teal-700 transition">
                    <i class="fa-solid fa-pen-to-square"></i> Manage Departments
                </a>
            </div>
        </div>
        @endif

        {{-- Public Health Departments --}}
        @if($school === 'public_health')
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-sitemap text-teal-600 dark:text-teal-300"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Departments</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Epidemiology &middot; Health Management &middot; Programs</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                    Manage the public health department pages and academic programs.
                </p>
                <a href="{{ route('admin.public-health.departments.index') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-teal-600 text-white text-xs font-medium rounded-lg hover:bg-teal-700 transition">
                    <i class="fa-solid fa-pen-to-square"></i> Manage Departments
                </a>
            </div>
        </div>
        @endif

        {{-- Academic Staffs --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-chalkboard-user text-green-600 dark:text-green-300"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Academic Staffs</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activeStaff }} active &middot; {{ $staffCount }} total</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                    Manage staff profiles, positions, and departments.
                </p>
                <a href="{{ route('admin.academic-staffs.index') }}?school={{ $school }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-600 text-white text-xs font-medium rounded-lg hover:bg-green-700 transition">
                    <i class="fa-solid fa-users"></i> Manage Staffs
                </a>
            </div>
        </div>

        {{-- Partnership & Collaboration — Medicine only --}}
        @if($school === 'medicine')
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-handshake text-purple-600 dark:text-purple-300"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Partnership & Collaboration</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Partners &middot; Links &middot; Content</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                    {{ ($partnershipsCount ?? 0) > 0 ? $partnershipsCount . ' partnership(s) published' : 'No partnerships yet.' }}
                </p>
                <a href="{{ route('admin.medicine.partnership') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-purple-600 text-white text-xs font-medium rounded-lg hover:bg-purple-700 transition">
                    <i class="fa-solid fa-handshake"></i> Manage Partnerships
                </a>
            </div>
        </div>
        @endif

        {{-- Add Staff shortcut --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-user-plus text-yellow-600 dark:text-yellow-300"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Add New Staff</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Quick add a staff member</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                    Create a new staff profile for this school.
                </p>
                <a href="{{ route('admin.academic-staffs.create') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-yellow-500 text-white text-xs font-medium rounded-lg hover:bg-yellow-600 transition">
                    <i class="fa-solid fa-plus"></i> Add Staff
                </a>
            </div>
        </div>

    </div>

    {{-- Recent staff table --}}
    @if($staffCount > 0)
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900 dark:text-white text-sm">Recent Staff</h3>
            <a href="{{ route('admin.academic-staffs.index') }}?school={{ $school }}"
               class="text-xs text-blue-600 hover:underline">View all →</a>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Position</th>
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach(\App\Models\AcademicStaff::bySchool($school)->ordered()->take(5)->get() as $staff)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $staff->full_name }}</td>
                    <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $staff->position }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $staff->status === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400' }}">
                            {{ ucfirst($staff->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>
@endsection
