@extends('admin.layouts.app')

@section('title', 'Medicine — Edit Sub-department')
@section('page-title', 'School of Medicine · Edit Sub-department')

@section('content')
<div class="py-6 max-w-2xl">

    <div class="flex items-center gap-2 mb-6">
        <a href="{{ route('admin.medicine.sub-departments.index') }}"
           class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <form method="POST" action="{{ route('admin.medicine.sub-departments.update', $subDepartment) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Parent Department</label>
                <select name="department_id" required
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">Select Department</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id', $subDepartment->department_id) == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sub-department Name</label>
                <input type="text" name="name" value="{{ old('name', $subDepartment->name) }}"
                       required
                       placeholder="e.g. Anatomy"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $subDepartment->slug) }}"
                       required
                       placeholder="e.g. anatomy"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">URL-friendly identifier</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" rows="4"
                          placeholder="Brief description..."
                          class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y rich-editor">{{ old('description', $subDepartment->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Icon (optional)</label>
                @if($subDepartment->icon)
                    <div class="mb-2">
                        <img src="{{ Storage::url($subDepartment->icon) }}"
                             class="h-16 rounded-lg object-cover border border-gray-200 dark:border-gray-600" alt="Current icon">
                    </div>
                @endif
                <input type="file" name="icon" accept="image/*"
                       class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Header Image (optional)</label>
                @if($subDepartment->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($subDepartment->image) }}"
                             class="h-24 w-full rounded-lg object-cover border border-gray-200 dark:border-gray-600" alt="Current image">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $subDepartment->display_order) }}"
                           min="0"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="status" value="1" {{ $subDepartment->status ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-blue-500">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Active</span>
                    </label>
                </div>
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Update Sub-department
                </button>
                <a href="{{ route('admin.medicine.sub-departments.index') }}"
                   class="px-6 py-2.5 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
