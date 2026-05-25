@extends('admin.layouts.app')

@section('title', 'Medicine — Departments')
@section('page-title', 'School of Medicine · Departments')

@section('content')
<div class="py-6">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Main Departments</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage the main department categories</p>
        </div>
        <a href="{{ route('admin.medicine.departments.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-plus"></i> Add Department
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs uppercase">
                <tr>
                    <th class="px-5 py-3 text-left">Order</th>
                    <th class="px-5 py-3 text-left">Name</th>
                    <th class="px-5 py-3 text-left">Slug</th>
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($departments as $department)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-5 py-3 text-gray-900 dark:text-white">{{ $department->display_order }}</td>
                    <td class="px-5 py-3 font-medium text-gray-900 dark:text-white">
                        <div class="flex items-center gap-3">
                            @if($department->icon)
                                <img src="{{ Storage::url($department->icon) }}" class="w-8 h-8 rounded-lg object-cover" alt="">
                            @endif
                            {{ $department->name }}
                        </div>
                    </td>
                    <td class="px-5 py-3 text-gray-500 dark:text-gray-400">{{ $department->slug }}</td>
                    <td class="px-5 py-3">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $department->status ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400' }}">
                            {{ $department->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.medicine.departments.edit', $department) }}"
                               class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.medicine.departments.destroy', $department) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this department? This will also delete all sub-departments and academic units.')"
                                        class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-8 text-center text-gray-500 dark:text-gray-400">
                        No departments found. Create your first department.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex items-center gap-4">
        <a href="{{ route('admin.medicine.sub-departments.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition">
            <i class="fa-solid fa-sitemap"></i> Manage Sub-Departments
        </a>
        <a href="{{ route('admin.medicine.academic-units.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
            <i class="fa-solid fa-graduation-cap"></i> Manage Academic Units
        </a>
    </div>

</div>
@endsection
