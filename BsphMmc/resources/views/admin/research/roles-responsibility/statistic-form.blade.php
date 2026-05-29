@extends('admin.layouts.app')

@section('title', isset($statistic) ? 'Edit Statistic' : 'Add Statistic')
@section('page-title', isset($statistic) ? 'Edit Statistic' : 'Add Statistic')

@section('content')
<div class="py-6 space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ isset($statistic) ? 'Edit' : 'Add' }} Statistic</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ isset($statistic) ? 'Update the statistic information' : 'Create a new statistic highlight' }}</p>
        </div>
        <a href="{{ route('admin.research.roles-responsibility.statistics.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Back to List
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <form action="{{ isset($statistic) ? route('admin.research.roles-responsibility.statistics.update', $statistic) : route('admin.research.roles-responsibility.statistics.store') }}" method="POST" class="space-y-6">
                @csrf
                @if(isset($statistic))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="label" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Label <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="label" 
                               name="label" 
                               value="{{ old('label', $statistic->label ?? '') }}" 
                               required 
                               placeholder="e.g., Research Projects"
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('label') border-red-500 @enderror">
                        @error('label')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Value <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="value" 
                               name="value" 
                               value="{{ old('value', $statistic->value ?? '') }}" 
                               required 
                               placeholder="e.g., 150+"
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('value') border-red-500 @enderror">
                        @error('value')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Icon (emoji or text)
                        </label>
                        <input type="text" 
                               id="icon" 
                               name="icon" 
                               value="{{ old('icon', $statistic->icon ?? '') }}" 
                               placeholder="📊"
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('icon') border-red-500 @enderror">
                        @error('icon')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sort Order
                        </label>
                        <input type="number" 
                               id="sort_order" 
                               name="sort_order" 
                               value="{{ old('sort_order', $statistic->sort_order ?? 0) }}" 
                               min="0"
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('sort_order') border-red-500 @enderror">
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3" 
                              placeholder="Optional description or context"
                              class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none @error('description') border-red-500 @enderror">{{ old('description', $statistic->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                @if(isset($statistic))
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="status" 
                               name="status" 
                               value="1" 
                               {{ old('status', $statistic->status) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="status" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Active
                        </label>
                    </div>
                @endif

                <div class="flex items-center gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        <i class="fa-solid fa-{{ isset($statistic) ? 'save' : 'plus' }}"></i>
                        {{ isset($statistic) ? 'Update' : 'Create' }} Statistic
                    </button>
                    <a href="{{ route('admin.research.roles-responsibility.statistics.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        <i class="fa-solid fa-times"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection