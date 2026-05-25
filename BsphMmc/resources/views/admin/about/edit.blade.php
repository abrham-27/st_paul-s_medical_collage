@extends('admin.layouts.app')

@section('title', 'About Us')
@section('page-title', 'About Us — Page Content')

@section('content')
<div class="py-6 max-w-4xl">
    <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        {{-- Page Content --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3">Page Content</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Page Title <span class="text-red-500">*</span></label>
                    <input type="text" name="page_title" value="{{ old('page_title', $about->page_title) }}" required
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none @error('page_title') border-red-500 @enderror">
                    @error('page_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Subtitle</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $about->subtitle) }}"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Main Description</label>
                <textarea name="main_description" rows="5"
                          class="rich-editor w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y">{{ old('main_description', $about->main_description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">History / Background</label>
                <textarea name="history_text" rows="6"
                          class="rich-editor w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y">{{ old('history_text', $about->history_text) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Additional Content</label>
                <textarea name="additional_content" rows="4"
                          class="rich-editor w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y">{{ old('additional_content', $about->additional_content) }}</textarea>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">JSON format for why items and specialized centers. Edit carefully.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Featured Image</label>
                @if($about->featured_image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($about->featured_image) }}"
                             class="h-28 w-auto rounded-lg object-cover border border-gray-200 dark:border-gray-600" alt="Current">
                        <p class="text-xs text-gray-500 mt-1">Upload a new image to replace</p>
                    </div>
                @endif
                <input type="file" name="featured_image" accept="image/*"
                       class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
                @error('featured_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- SEO --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3">SEO Settings</h2>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SEO Title</label>
                <input type="text" name="seo_title" value="{{ old('seo_title', $about->seo_title) }}"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SEO Description</label>
                <textarea name="seo_description" rows="3" maxlength="500"
                          class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none">{{ old('seo_description', $about->seo_description) }}</textarea>
            </div>
        </div>

        <button type="submit"
                class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-floppy-disk mr-2"></i> Save Changes
        </button>
    </form>
</div>
@endsection
