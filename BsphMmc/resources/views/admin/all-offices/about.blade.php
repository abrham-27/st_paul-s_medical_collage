@extends('admin.layouts.app')

@section('title', 'All Offices · About')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">All Offices · About</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage about section content for all offices.</p>
        </div>

        <!-- Office Selector -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form method="GET" action="{{ route('admin.all-offices.about') }}" class="flex items-end gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select Office</label>
                    <select name="office" onchange="this.form.submit()" class="block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @foreach($offices as $key => $name)
                            <option value="{{ $key }}" {{ $selectedOffice === $key ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <h4 class="text-red-800 font-medium mb-2">Please fix the following errors:</h4>
                    <ul class="text-red-700 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $offices[$selectedOffice] }} · About Content</h3>
            </div>

            <form action="{{ route('admin.all-offices.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="office" value="{{ $selectedOffice }}" />

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" value="{{ old('title', $page->title) }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                    <textarea name="content" rows="12" class="ckeditor mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">{{ old('content', $page->content) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Featured Image</label>
                    <input type="file" name="featured_image" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <p class="text-xs text-gray-500 mt-1">Max size: 3MB. Supported: JPG, PNG, GIF</p>
                    
                    @if($page->featured_image)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $page->featured_image) }}" alt="Featured" class="h-32 w-auto rounded-lg border border-gray-200" />
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Current featured image</p>
                        </div>
                    @endif
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Update About</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.ClassicEditor) {
            document.querySelectorAll('textarea.ckeditor').forEach(function (textarea) {
                ClassicEditor.create(textarea).catch(function (error) { console.error(error); });
            });
        }
    });
</script>
@endsection