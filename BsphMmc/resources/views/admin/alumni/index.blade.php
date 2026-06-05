@extends('admin.layouts.app')

@section('title', 'Alumni Management')
@section('page-title', 'Alumni Directory Management')

@section('content')
<div class="py-6 space-y-4">
    <!-- Success Alert -->
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200 dark:border-green-800 flex items-center gap-2" role="alert">
            <i class="fa-solid fa-circle-check"></i>
            <div>
                <span class="font-medium">Success!</span> {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between gap-4 items-center bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
        <!-- Search bar -->
        <form method="GET" action="{{ route('admin.alumni.index') }}" class="w-full sm:max-w-md flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Search by name, email, specialty, workplace..." 
                   class="flex-1 px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                Search
            </button>
            @if(request('search'))
                <a href="{{ route('admin.alumni.index') }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition flex items-center">
                    Clear
                </a>
            @endif
        </form>

        <a href="{{ route('admin.alumni.create') }}"
           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-plus"></i> Add Alumnus Profile
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left w-16">Photo</th>
                        <th class="px-6 py-3 text-left">Alumnus Name</th>
                        <th class="px-6 py-3 text-left">Education</th>
                        <th class="px-6 py-3 text-left">Specialty</th>
                        <th class="px-6 py-3 text-left">Workplace & Title</th>
                        <th class="px-6 py-3 text-center">Featured</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($alumni as $alumnus)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4">
                                <img src="{{ $alumnus->image }}" alt="{{ $alumnus->name }}" 
                                     class="w-10 h-10 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600">
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 dark:text-white">{{ $alumnus->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $alumnus->email }}</div>
                                @if($alumnus->phone)
                                    <div class="text-xs text-gray-400 dark:text-gray-500">{{ $alumnus->phone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-gray-800 dark:text-gray-200 font-medium">{{ $alumnus->degree }}</div>
                                <div class="text-xs text-blue-600 dark:text-blue-400 font-semibold">Class of {{ $alumnus->graduation_year }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200 font-medium">
                                {{ $alumnus->specialty }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $alumnus->current_position ?? 'N/A' }}</div>
                                <div class="text-xs">🏢 {{ $alumnus->workplace ?? 'N/A' }}</div>
                                @if($alumnus->location)
                                    <div class="text-xs">📍 {{ $alumnus->location }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($alumnus->is_featured)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200">
                                        ★ Featured
                                    </span>
                                @else
                                    <span class="text-gray-400 dark:text-gray-600">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.alumni.toggle-status', $alumnus) }}">
                                    @csrf @method('PUT')
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition cursor-pointer
                                                {{ $alumnus->is_active 
                                                    ? 'bg-green-100 text-green-800 hover:bg-green-200 dark:bg-green-900 dark:text-green-200' 
                                                    : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                        {{ $alumnus->is_active ? 'Active / Approved' : 'Pending Approval' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.alumni.edit', $alumnus) }}"
                                       class="p-1.5 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg transition"
                                       title="Edit Profile">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.alumni.destroy', $alumnus) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this Alumnus profile?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="p-1.5 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg transition"
                                                title="Delete Profile">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <i class="fa-solid fa-user-graduation text-3xl mb-2 block"></i>
                                No alumni found matching query.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($alumni->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $alumni->appends(request()->input())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
