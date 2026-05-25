@extends('admin.layouts.app')

@section('title', 'Medicine — Overview Page')
@section('page-title', 'School of Medicine · Overview')

@section('content')
<div class="py-6 max-w-3xl">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        This page manages the Overview content for the School of Medicine.
    </p>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('admin.medicine.overview.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            {{-- About Section --}}
            <div class="border-b border-gray-100 dark:border-gray-700 pb-6">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded text-xs flex items-center justify-center font-bold">A</span>
                    About Section
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">About Title</label>
                        <input type="text" name="title" value="{{ old('title', $page->title) }}"
                               placeholder="e.g. Excellence in Medical Education"
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">About Content</label>
                        <textarea name="content" rows="6"
                                  placeholder="About section content..."
                                  class="rich-editor w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y">{{ old('content', $page->content) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Mission Section --}}
            <div class="border-b border-gray-100 dark:border-gray-700 pb-6">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 rounded text-xs flex items-center justify-center font-bold">M</span>
                    Mission Section
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mission Title</label>
                        <input type="text" name="secondary_title" value="{{ old('secondary_title', $page->secondary_title) }}"
                               placeholder="e.g. Our Mission"
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mission Content</label>
                        <textarea name="secondary_content" rows="5"
                                  placeholder="Mission statement..."
                                  class="rich-editor w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y">{{ old('secondary_content', $page->secondary_content) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Vision Section --}}
            <div class="border-b border-gray-100 dark:border-gray-700 pb-6">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 rounded text-xs flex items-center justify-center font-bold">V</span>
                    Vision Section
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vision Title</label>
                        <input type="text" name="tertiary_title" value="{{ old('tertiary_title', $page->tertiary_title) }}"
                               placeholder="e.g. Our Vision"
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vision Content</label>
                        <textarea name="tertiary_content" rows="5"
                                  placeholder="Vision statement..."
                                  class="rich-editor w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y">{{ old('tertiary_content', $page->tertiary_content) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Featured Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Featured Image (optional)</label>
                @if($page->featured_image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($page->featured_image) }}"
                             class="h-24 rounded-lg object-cover border border-gray-200 dark:border-gray-600" alt="Current image">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Current image — upload new to replace.</p>
                    </div>
                @endif
                <input type="file" name="featured_image" accept="image/*"
                       class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Save Overview
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
