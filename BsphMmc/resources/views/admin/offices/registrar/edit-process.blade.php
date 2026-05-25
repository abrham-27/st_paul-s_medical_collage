@extends('admin.layouts.app')

@section('title', 'Edit Process Step - Admin')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.offices.registrar.process') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Process Step</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <form action="{{ route('admin.offices.registrar.process.update', $officeProcess) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Step Number -->
                    <div class="mb-6">
                        <label for="step_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Step Number</label>
                        <input type="number" 
                               id="step_number" 
                               name="step_number" 
                               value="{{ $officeProcess->step_number }}"
                               min="1"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ $officeProcess->title }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent rich-editor"
                                  required>{{ $officeProcess->description }}</textarea>
                    </div>

                    <!-- Icon -->
                    <div class="mb-6">
                        <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Icon (Optional)</label>
                        <input type="file" 
                               id="icon" 
                               name="icon" 
                               accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @if($officeProcess->icon)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $officeProcess->icon) }}" alt="Current icon" class="h-12 w-12 rounded">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Current icon</p>
                            </div>
                        @endif
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Upload an icon image for this step. If not provided, the step number will be displayed.</p>
                    </div>

                    <!-- Sort Order -->
                    <div class="mb-6">
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort Order</label>
                        <input type="number" 
                               id="sort_order" 
                               name="sort_order" 
                               value="{{ $officeProcess->sort_order }}"
                               min="1"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <select id="status" 
                                name="status" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            <option value="active" {{ $officeProcess->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $officeProcess->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.offices.registrar.process') }}" 
                           class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Update Process Step
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
