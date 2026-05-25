@extends('admin.layouts.app')
@section('title', $project ? 'Edit Project' : 'New Project')
@section('page-title', 'ICT Office · ' . ($project ? 'Edit Project' : 'New Project'))
@section('content')
<div class="py-6 max-w-2xl">
    @if($errors->any())<div class="mb-4 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-lg text-sm text-red-700 dark:text-red-300"><ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST"
              action="{{ $project ? route('admin.offices.ict.projects.update',$project) : route('admin.offices.ict.projects.store') }}"
              enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if($project) @method('PUT') @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $project?->title) }}" required class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Short Description</label>
                <textarea name="excerpt" rows="3" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none">{{ old('excerpt', $project?->excerpt) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Content</label>
                <textarea name="content" rows="7" class="rich-editor w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y">{{ old('content', $project?->content) }}</textarea>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Image</label>
                    @if($project?->image)<div class="mb-2"><img src="{{ Storage::url($project->image) }}" class="w-16 h-16 rounded-lg object-cover border border-gray-200 dark:border-gray-600"></div>@endif
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="published" {{ old('status',$project?->status ?? 'published') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft"     {{ old('status',$project?->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">{{ $project ? 'Save Changes' : 'Create Project' }}</button>
                <a href="{{ route('admin.offices.ict.projects') }}" class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
