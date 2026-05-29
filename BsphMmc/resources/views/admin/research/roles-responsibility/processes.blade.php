@extends('admin.layouts.app')

@section('title', 'Process Steps')
@section('page-title', 'Process Steps')

@section('content')
<div class="py-6 space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Process Steps</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage workflow and process steps</p>
        </div>
        <a href="{{ route('admin.research.roles-responsibility.processes.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-plus"></i>
            Add New Process
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        @if($processes->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Step #</th>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Description</th>
                            <th class="px-6 py-3 text-left">Icon</th>
                            <th class="px-6 py-3 text-left">Sort Order</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($processes as $process)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-semibold">
                                        {{ $process->step_number }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $process->title }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400 max-w-xs">
                                    <p class="line-clamp-2">{{ Str::limit(strip_tags($process->description), 100) }}</p>
                                </td>
                                <td class="px-6 py-4 text-lg">{{ $process->icon }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $process->sort_order }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $process->status ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                        {{ $process->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.research.roles-responsibility.processes.edit', $process) }}"
                                           class="p-1.5 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.research.roles-responsibility.processes.destroy', $process) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this process step?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg transition">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <i class="fa-solid fa-list-check text-4xl text-gray-400 dark:text-gray-600 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No process steps found</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Get started by creating your first process step.</p>
                <a href="{{ route('admin.research.roles-responsibility.processes.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    <i class="fa-solid fa-plus"></i>
                    Add the first one
                </a>
            </div>
        @endif
    </div>

</div>
@endsection