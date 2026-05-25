@extends('admin.layouts.app')

@section('title', 'Hero Section')
@section('page-title', 'Hero Section')

@section('content')
<div class="py-6 max-w-6xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Hero Slides Manager</h2>
        <a href="{{ route('admin.home-content.hero.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-plus"></i> Add New Slide
        </a>
    </div>

    @if($slides->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
            <i class="fa-solid fa-images text-4xl text-gray-300 dark:text-gray-600 mb-4 block"></i>
            <p class="text-gray-600 dark:text-gray-400 mb-4">No hero slides yet. Create at least 5 slides to get started.</p>
            <a href="{{ route('admin.home-content.hero.create') }}"
               class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-plus"></i> Create First Slide
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($slides as $slide)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition">
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                            <!-- Slide Image -->
                            <div class="lg:col-span-1">
                                @if($slide->image)
                                    <div class="rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-700" style="height: 150px;">
                                        <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-full h-40 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-500 dark:text-gray-400">
                                        <i class="fa-solid fa-image text-2xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Slide Content -->
                            <div class="lg:col-span-2">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $slide->title }}</h3>
                                        @if($slide->subtitle)
                                            <p class="text-sm text-blue-600 dark:text-blue-400">{{ $slide->subtitle }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($slide->status)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                                <i class="fa-solid fa-check"></i> Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                                                <i class="fa-solid fa-ban"></i> Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($slide->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">{{ $slide->description }}</p>
                                @endif

                                <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-1">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <span>Order: <strong>{{ $slide->display_order }}</strong></span>
                                    </div>
                                    @if($slide->button_text)
                                        <div class="flex items-center gap-1">
                                            <i class="fa-solid fa-link"></i>
                                            <span>Button: <strong>{{ $slide->button_text }}</strong></span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="lg:col-span-1 flex items-center justify-end gap-2">
                                <a href="{{ route('admin.home-content.hero.edit', $slide) }}"
                                   class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800 transition" title="Edit">
                                    <i class="fa-solid fa-pen text-sm"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.home-content.hero.destroy', $slide) }}" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this slide?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-800 transition" title="Delete">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Info Notice -->
        <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
            <p class="text-sm text-blue-800 dark:text-blue-200">
                <i class="fa-solid fa-info-circle mr-2"></i>
                Hero slides are displayed in order. You can reorder them by editing and changing the order number. Recommended: at least 5 slides.
            </p>
        </div>
    @endif
</div>
@endsection
