@extends('admin.layouts.app')

@section('title', 'Academic Staffs')
@section('page-title', 'Academic Staffs')

@section('content')
<div class="py-6 space-y-4">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search staff..."
                   class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none w-48">
            <select name="school"
                    class="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="">All Schools</option>
                <option value="medicine"      {{ request('school') === 'medicine'      ? 'selected' : '' }}>School of Medicine</option>
                <option value="nursing"       {{ request('school') === 'nursing'       ? 'selected' : '' }}>School of Nursing</option>
                <option value="public_health" {{ request('school') === 'public_health' ? 'selected' : '' }}>School of Public Health</option>
            </select>
            <select name="status"
                    class="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="">All Status</option>
                <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-search mr-1"></i> Filter
            </button>
        </form>
        <a href="{{ route('admin.academic-staffs.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
            <i class="fa-solid fa-plus"></i> Add Staff
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">Staff</th>
                    <th class="px-4 py-3 text-left">School</th>
                    <th class="px-4 py-3 text-left">Position</th>
                    <th class="px-4 py-3 text-left">Department</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($staffs as $staff)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if($staff->profile_image)
                                    <img src="{{ Storage::url($staff->profile_image) }}"
                                         class="w-9 h-9 rounded-full object-cover flex-shrink-0" alt="{{ $staff->full_name }}">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center flex-shrink-0">
                                        <span class="text-blue-600 dark:text-blue-300 font-bold text-sm">{{ strtoupper(substr($staff->full_name, 0, 1)) }}</span>
                                    </div>
                                @endif
                                <span class="font-medium text-gray-900 dark:text-white">{{ $staff->full_name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300 capitalize">
                            {{ str_replace('_', ' ', $staff->school_type) }}
                        </td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $staff->position }}</td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $staff->department ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $staff->status === 'active'
                                    ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300'
                                    : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400' }}">
                                {{ ucfirst($staff->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.academic-staffs.edit', $staff) }}"
                                   class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition">
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.academic-staffs.destroy', $staff) }}"
                                      onsubmit="return confirm('Delete {{ $staff->full_name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-16 text-center text-gray-500 dark:text-gray-400">
                            <i class="fa-solid fa-users text-4xl mb-3 block"></i>
                            <p>No staff members yet. <a href="{{ route('admin.academic-staffs.create') }}" class="text-blue-600 hover:underline">Add one</a>.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($staffs->hasPages())
        <div>{{ $staffs->links() }}</div>
    @endif

</div>
@endsection
