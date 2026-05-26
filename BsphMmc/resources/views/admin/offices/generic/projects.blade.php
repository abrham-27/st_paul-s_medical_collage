@extends('admin.layouts.app')

@section('title', $officeName . ' · Projects')

@section('content')
<div class="py-6">
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $officeName }} · Projects</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage projects for {{ $officeName }}.</p>
            </div>
            <a href="{{ route('admin.offices.generic.projects.create', ['office' => $office]) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Add New Project</a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            @if($items->count() > 0)
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($items as $project)
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $project->title }}</h3>
                                        <span class="px-2 py-1 text-xs rounded-full {{ $project->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </div>
                                    
                                    @if($project->excerpt)
                                        <p class="text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($project->excerpt, 150) }}</p>
                                    @endif
                                    
                                    <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                        <span>Slug: {{ $project->slug }}</span>
                                        <span>Created: {{ $project->created_at->format('M j, Y') }}</span>
                                    </div>
                                </div>
                                
                                @if($project->image)
                                    <div class="ml-4">
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-20 h-20 object-cover rounded-lg">
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex gap-2 mt-4">
                                <a href="{{ route('admin.offices.generic.projects.edit', ['office' => $office, 'officeProject' => $project]) }}" class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Edit</a>
                                <form action="{{ route('admin.offices.generic.projects.destroy', ['office' => $office, 'officeProject' => $project]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this project?')" class="px-3 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="p-6">
                    {{ $items->links() }}
                </div>
            @else
                <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                    No projects added yet. <a href="{{ route('admin.offices.generic.projects.create', ['office' => $office]) }}" class="text-blue-600 hover:underline">Add the first project</a>.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection