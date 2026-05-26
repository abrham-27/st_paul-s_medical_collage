@extends('admin.layouts.app')

@section('title', 'Public Health — Departments')
@section('page-title', 'School of Public Health · Departments')

@section('content')
<div class="py-6">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        Manage the content for each public health department and academic programs section.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

        @foreach($deptLabels as $key => $label)
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-{{ $key === 'program' ? 'graduation-cap' : 'microscope' }} text-teal-600 dark:text-teal-300"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $label }}</h3>
                    </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                    @if($pages[$key])
                        Last updated: {{ $pages[$key]->updated_at->diffForHumans() }}
                    @else
                        Not configured yet.
                    @endif
                </p>
                <a href="{{ route('admin.public-health.departments.edit', $key) }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-teal-600 text-white text-xs font-medium rounded-lg hover:bg-teal-700 transition">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
