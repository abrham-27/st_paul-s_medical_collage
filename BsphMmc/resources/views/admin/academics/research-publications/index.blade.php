@extends('admin.layouts.app')

@section('title', $schoolName . ' · Research & Publications')

@section('content')
<div class="py-6 space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $schoolName }} · Research & Publications</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage research papers, journals, conference entries, and thesis publications for this school.</p>
        </div>
        <a href="{{ route('admin.academics.research-publications.create', ['school' => $school]) }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-plus"></i> Add New Entry
        </a>
    </div>

    <form action="" method="GET" class="grid gap-4 lg:grid-cols-4">
        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Search</label>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Title, author, keywords"
                   class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
        </div>
        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Type</label>
            <select name="publication_type" class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Types</option>
                @foreach(['Research','Publication','Journal','Conference','Thesis'] as $type)
                    <option value="{{ $type }}" {{ request('publication_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</label>
            <select name="status" class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                <option value="">Any Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Sort</label>
            <select name="sort" class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                <option value="">Featured / Newest</option>
                <option value="date_desc" {{ request('sort') === 'date_desc' ? 'selected' : '' }}>Date Descending</option>
                <option value="date_asc" {{ request('sort') === 'date_asc' ? 'selected' : '' }}>Date Ascending</option>
            </select>
        </div>
        <div class="lg:col-span-4 flex justify-end">
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm rounded-lg hover:bg-gray-800 transition">
                <i class="fa-solid fa-filter"></i> Filter
            </button>
        </div>
    </form>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-50 dark:bg-gray-900 text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Publication Date</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Featured</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($publications as $publication)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-4 py-4">
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $publication->title }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $publication->authors }}</p>
                        </td>
                        <td class="px-4 py-4">{{ $publication->publication_type ?? 'N/A' }}</td>
                        <td class="px-4 py-4">{{ $publication->publication_date ? $publication->publication_date->format('M d, Y') : '-' }}</td>
                        <td class="px-4 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $publication->status === 'published' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-200' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }}">
                                {{ ucfirst($publication->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-4">{{ $publication->featured ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-4 space-x-2">
                            <a href="{{ route('admin.academics.research-publications.edit', ['school' => $school, 'publication' => $publication]) }}"
                               class="inline-flex items-center gap-2 px-3 py-2 bg-blue-600 text-white rounded-lg text-xs hover:bg-blue-700">Edit</a>
                            <form action="{{ route('admin.academics.research-publications.destroy', ['school' => $school, 'publication' => $publication]) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 bg-red-600 text-white rounded-lg text-xs hover:bg-red-700" onclick="return confirm('Delete this publication?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">No research or publication entries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $publications->links() }}
    </div>
</div>
@endsection
