@extends('admin.layouts.app')

@section('title', 'Public Health — Partnership & Collaboration')
@section('page-title', 'School of Public Health · Partnership & Collaboration')

@section('content')
<div class="py-6 max-w-3xl">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('admin.public-health.partnership.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Page Title</label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}"
                       placeholder="e.g. Partnership & Collaboration"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Content</label>
                <textarea name="content" rows="10"
                          placeholder="Describe partnerships, collaborations, partner institutions..."
                          class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y rich-editor">{{ old('content', $page->content) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Featured Image (optional)</label>
                @if($page->featured_image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($page->featured_image) }}"
                             class="h-24 rounded-lg object-cover border border-gray-200 dark:border-gray-600" alt="Current image">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Upload new to replace.</p>
                    </div>
                @endif
                <input type="file" name="featured_image" accept="image/*"
                       class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Save Partnership Page
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
