@extends('admin.layouts.app')

@section('title', 'Nursing — Departments')
@section('page-title', 'School of Nursing · Departments')

@section('content')
<div class="py-6 max-w-4xl">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Manage nursing department cards and detail page content.
        </p>
        <a href="{{ route('admin.nursing.departments.landing') }}"
           class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-layer-group"></i> Edit Landing Page
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-900/50 text-left text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3">Department</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($departments as $department)
                    <tr>
                        <td class="px-4 py-3">{{ $department->display_order }}</td>
                        <td class="px-4 py-3">
                            <span class="mr-2">{{ $department->icon }}</span>
                            {{ $department->title }}
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $department->slug }}</td>
                        <td class="px-4 py-3">
                            @if($department->status)
                                <span class="text-green-600">Active</span>
                            @else
                                <span class="text-gray-400">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.nursing.departments.edit', $department) }}"
                               class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            No departments found. Run migrations to seed default content.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
