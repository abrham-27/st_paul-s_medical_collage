@extends('admin.layouts.app')

@section('title', 'Manage ' . ucfirst($type) . ' Project')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    @if($type === 'irb')
                        ⚖️ Function of IRB
                    @elseif($type === 'idream')
                        🔬 iDream Lab
                    @else
                        📊 HDSS
                    @endif
                </h2>
                <p class="text-gray-600 dark:text-gray-400">Manage all content sections for this project</p>
            </div>
            <a href="{{ route('admin.research.projects.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Projects
            </a>
        </div>
    </div>

    <!-- Basic Info Form -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Basic Project Information</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.research.projects.basic-info.update', $type) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Project Title</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" id="title" name="title" value="{{ $project->title }}" required>
                    </div>
                    <div>
                        <label for="subtitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subtitle</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" id="subtitle" name="subtitle" value="{{ $project->subtitle }}">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="overview" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Overview Content</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" id="overview" name="overview" rows="8">{{ $project->overview }}</textarea>
                </div>

                <div class="mt-6">
                    <label for="hero_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Hero Image</label>
                    <input type="file" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" id="hero_image" name="hero_image" accept="image/*">
                    @if($project->hero_image)
                        <p class="text-sm text-gray-500 mt-1">Current: {{ basename($project->hero_image) }}</p>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contact Email</label>
                        <input type="email" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" id="contact_email" name="contact_email" value="{{ $project->contact_email }}">
                    </div>
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contact Phone</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" id="contact_phone" name="contact_phone" value="{{ $project->contact_phone }}">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="contact_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contact Address</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" id="contact_address" name="contact_address" rows="3">{{ $project->contact_address }}</textarea>
                </div>

                <div class="mt-6">
                    <label for="office_hours" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Office Hours</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" id="office_hours" name="office_hours" value="{{ $project->office_hours }}" placeholder="e.g., Monday - Friday: 8:00 AM - 5:00 PM">
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i> Save Basic Info
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Quick Add Forms -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Add Function -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Function</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.research.projects.functions.store', $type) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                            <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Icon</label>
                                <input type="text" name="icon" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" placeholder="🔧">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order</label>
                                <input type="number" name="order_index" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" min="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Features (one per line)</label>
                            <textarea name="features_text" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" placeholder="Feature 1&#10;Feature 2&#10;Feature 3"></textarea>
                        </div>
                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                            Add Function
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Workflow Step -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Workflow Step</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.research.projects.workflows.store', $type) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                            <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" required></textarea>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Step #</label>
                                <input type="number" name="step_number" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" min="1" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Icon</label>
                                <input type="text" name="icon" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" placeholder="📋">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Time</label>
                                <input type="text" name="estimated_time" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" placeholder="2-3 weeks">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Requirements (one per line)</label>
                            <textarea name="requirements_text" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" placeholder="Requirement 1&#10;Requirement 2"></textarea>
                        </div>
                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                            Add Workflow Step
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Current Content Display -->
    @if($project->functions && $project->functions->count() > 0)
        <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Current Functions ({{ $project->functions->count() }})</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($project->functions as $function)
                        <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                            <div class="flex items-start justify-between mb-2">
                                <span class="text-2xl">{{ $function->icon ?? '🔧' }}</span>
                                <span class="text-xs text-gray-500">#{{ $function->order_index ?? 0 }}</span>
                            </div>
                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $function->title }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ Str::limit($function->description, 100) }}</p>
                            @if($function->features && count($function->features) > 0)
                                <p class="text-xs text-blue-600 mt-2">{{ count($function->features) }} features</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if($project->workflows && $project->workflows->count() > 0)
        <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Current Workflow Steps ({{ $project->workflows->count() }})</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($project->workflows->sortBy('step_number') as $workflow)
                        <div class="flex items-start space-x-4 p-4 border border-gray-200 dark:border-gray-600 rounded-lg">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                    {{ $workflow->step_number }}
                                </span>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span>{{ $workflow->icon ?? '📋' }}</span>
                                    <h4 class="font-medium text-gray-900 dark:text-white">{{ $workflow->title }}</h4>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($workflow->description, 150) }}</p>
                                @if($workflow->estimated_time)
                                    <p class="text-xs text-green-600 mt-1">⏱️ {{ $workflow->estimated_time }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection