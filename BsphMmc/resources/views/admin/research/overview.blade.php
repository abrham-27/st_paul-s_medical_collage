@extends('admin.layouts.app')

@section('title', 'Research Overview - Admin')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Research Overview</h1>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.research.background') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Edit Background
                    </a>
                    <a href="{{ route('admin.research.mission') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Edit Mission
                    </a>
                    <a href="{{ route('admin.research.vision') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Edit Vision
                    </a>
                    <a href="{{ route('admin.research.goals') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Manage Goals
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Preview -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Background Preview -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Background</h2>
                @if($background)
                    <h3 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-2">{{ $background->title }}</h3>
                    <div class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3">
                        {!! Str::limit(strip_tags($background->content), 200) !!}
                    </div>
                    @if($background->image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $background->image) }}" alt="{{ $background->title }}" class="h-32 w-auto rounded-lg">
                        </div>
                    @endif
                @else
                    <p class="text-gray-500 dark:text-gray-400">No background content yet.</p>
                @endif
            </div>

            <!-- Mission & Vision Preview -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Mission & Vision</h2>
                <div class="space-y-4">
                    @if($mission)
                        <div>
                            <h3 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-2">Mission</h3>
                            <div class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                {!! Str::limit(strip_tags($mission->content), 150) !!}
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No mission content yet.</p>
                    @endif
                    
                    @if($vision)
                        <div>
                            <h3 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-2">Vision</h3>
                            <div class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                {!! Str::limit(strip_tags($vision->content), 150) !!}
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No vision content yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Goals Preview -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Goals</h2>
                <a href="{{ route('admin.research.goals') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Manage All Goals →
                </a>
            </div>
            @if($goals->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($goals->take(6) as $goal)
                        <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                            <h3 class="font-medium text-gray-900 dark:text-white mb-2">{{ $goal->title }}</h3>
                            @if($goal->description)
                                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ Str::limit($goal->description, 100) }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
                @if($goals->count() > 6)
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            And {{ $goals->count() - 6 }} more goals...
                        </p>
                    </div>
                @endif
            @else
                <p class="text-gray-500 dark:text-gray-400">No goals added yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
