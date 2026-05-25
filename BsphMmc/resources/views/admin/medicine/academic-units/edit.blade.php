@extends('admin.layouts.app')

@section('title', 'Medicine — Edit Academic Unit')
@section('page-title', 'School of Medicine · Edit Academic Unit')

@section('content')
<div class="py-6 max-w-2xl">

    <div class="flex items-center gap-2 mb-6">
        <a href="{{ route('admin.medicine.academic-units.index') }}"
           class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <form method="POST" action="{{ route('admin.medicine.academic-units.update', $academicUnit) }}" class="space-y-6">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Parent Sub-department</label>
                <select name="sub_department_id" required
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">Select Sub-department</option>
                    @foreach($subDepartments as $sub)
                        <option value="{{ $sub->id }}" {{ old('sub_department_id', $academicUnit->sub_department_id) == $sub->id ? 'selected' : '' }}>
                            {{ $sub->name }} ({{ $sub->department->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unit Name</label>
                <input type="text" name="name" value="{{ old('name', $academicUnit->name) }}"
                       required
                       placeholder="e.g. Cardiology"
                       class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" rows="4"
                          placeholder="Brief description..."
                          class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y rich-editor">{{ old('description', $academicUnit->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $academicUnit->display_order) }}"
                           min="0"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="status" value="1" {{ $academicUnit->status ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-blue-500">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Active</span>
                    </label>
                </div>
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Update Academic Unit
                </button>
                <a href="{{ route('admin.medicine.academic-units.index') }}"
                   class="px-6 py-2.5 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
