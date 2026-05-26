@extends('admin.layouts.app')

@section('title', 'All Offices · ' . ($project ? 'Edit' : 'Add') . ' Project')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">All Offices · {{ $project ? 'Edit' : 'Add' }} Project</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $project ? 'Update' : 'Create a new' }} project for offices.</p>
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

            <form action="{{ $project ? route('admin.all-offices.projects.update', ['officeProject' => $project]) : route('admin.all-offices.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if($project)
                    @method('PUT')
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Office</label>
                    <select name="office" required class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @foreach($offices as $key => $name)
                            <option value="{{ $key }}" {{ $selectedOffice === $key ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Excerpt</label>
                    <textarea name="excerpt" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">{{ old('excerpt', $project->excerpt ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                    <textarea name="content" rows="12" class="ckeditor mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">{{ old('content', $project->content ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Image</label>
                    <input type="file" name="image" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <p class="text-xs text-gray-500 mt-1">Max size: 3MB. Supported: JPG, PNG, GIF</p>
                    
                    @if($project && $project->image)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $project->image) }}" alt="Project" class="h-32 w-auto rounded-lg border border-gray-200" />
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Current project image</p>
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" required class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        <option value="published" {{ old('status', $project->status ?? 'published') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $project->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.all-offices.projects', ['office' => $selectedOffice]) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">{{ $project ? 'Update' : 'Create' }} Project</button>
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