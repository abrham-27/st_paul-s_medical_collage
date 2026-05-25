@extends('admin.layouts.app')

@section('title', 'Edit Post')
@section('page-title', 'Edit Post')

@section('content')
<div class="py-6 max-w-4xl">
    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-5">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3">Edit Post</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none @error('title') border-red-500 @enderror">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type <span class="text-red-500">*</span></label>
                    <select name="type" id="post-type"
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        @foreach(['news','announcement','event','document'] as $t)
                            <option value="{{ $t }}" {{ old('type', $post->type) === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status"
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Author</label>
                    <input type="text" name="author" value="{{ old('author', $post->author) }}"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div id="event-date-field">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Event Date</label>
                    <input type="datetime-local" name="event_date"
                           value="{{ old('event_date', $post->event_date ? $post->event_date->format('Y-m-d\TH:i') : '') }}"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Content</label>
                <textarea name="content" rows="8"
                          class="rich-editor w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y">{{ old('content', $post->content) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Featured Image</label>
                @if($post->featured_image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($post->featured_image) }}"
                             class="h-24 w-auto rounded-lg object-cover border border-gray-200 dark:border-gray-600" alt="Current image">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Current image — upload a new one to replace it</p>
                    </div>
                @endif
                <input type="file" name="featured_image" accept="image/*"
                       class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Changes
            </button>
            <a href="{{ route('admin.posts.index') }}"
               class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
    const typeSelect = document.getElementById('post-type');
    const eventField = document.getElementById('event-date-field');
    function toggleEventDate() {
        eventField.style.display = typeSelect.value === 'event' ? 'block' : 'none';
    }
    typeSelect.addEventListener('change', toggleEventDate);
    toggleEventDate();
</script>
@endsection
