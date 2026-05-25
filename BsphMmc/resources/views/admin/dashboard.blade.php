@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="py-6 space-y-6">

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Posts</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['posts'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-newspaper text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-2 text-xs">
                <span class="text-green-600 dark:text-green-400 font-medium">{{ $stats['published'] }} published</span>
                <span class="text-gray-400">•</span>
                <span class="text-gray-500 dark:text-gray-400">{{ $stats['drafts'] }} drafts</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Gallery Images</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['gallery'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-images text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Academic Programs</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['academics'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-graduation-cap text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Statistics</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['statistics'] }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-chart-bar text-orange-600 dark:text-orange-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <a href="{{ route('admin.posts.create') }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition group">
                <i class="fa-solid fa-plus text-2xl text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400"></i>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">New Post</span>
            </a>
            <a href="{{ route('admin.gallery.index') }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-purple-500 dark:hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition group">
                <i class="fa-solid fa-upload text-2xl text-gray-400 group-hover:text-purple-600 dark:group-hover:text-purple-400"></i>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-purple-600 dark:group-hover:text-purple-400">Upload Images</span>
            </a>
            <a href="{{ route('admin.academics.create') }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-green-500 dark:hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 transition group">
                <i class="fa-solid fa-book-open text-2xl text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-400"></i>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-green-600 dark:group-hover:text-green-400">Add Program</span>
            </a>
            <a href="{{ route('admin.statistics.index') }}"
               class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-orange-500 dark:hover:border-orange-500 hover:bg-orange-50 dark:hover:bg-orange-900/20 transition group">
                <i class="fa-solid fa-chart-line text-2xl text-gray-400 group-hover:text-orange-600 dark:group-hover:text-orange-400"></i>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-orange-600 dark:group-hover:text-orange-400">Add Stat</span>
            </a>
        </div>
    </div>

    {{-- Recent Posts --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Posts</h2>
            <a href="{{ route('admin.posts.index') }}"
               class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all</a>
        </div>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($recentPosts as $post)
                <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-medium text-gray-900 dark:text-white truncate">{{ $post->title }}</h3>
                            <div class="flex items-center gap-3 mt-1 text-xs text-gray-500 dark:text-gray-400">
                                <span class="px-2 py-0.5 rounded-full bg-gray-100 dark:bg-gray-700 capitalize">{{ $post->type }}</span>
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                @if($post->author)
                                    <span>by {{ $post->author }}</span>
                                @endif
                            </div>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full
                            {{ $post->status === 'published' ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                    <i class="fa-solid fa-inbox text-3xl mb-2"></i>
                    <p class="text-sm">No posts yet</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
