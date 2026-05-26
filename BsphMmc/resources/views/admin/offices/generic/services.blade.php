@extends('admin.layouts.app')

@section('title', $officeName . ' · Services')

@section('content')
<div class="py-6">
    <div class="max-w-6xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $officeName }} · Services</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage services offered by {{ $officeName }}.</p>
        </div>

        <!-- Add New Service Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Add New Service</h3>
            
            <form action="{{ route('admin.offices.generic.services.store', ['office' => $office]) }}" method="POST" class="grid gap-4 lg:grid-cols-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" required
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Icon (Emoji)</label>
                    <input type="text" name="icon" placeholder="📋"
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Display Order</label>
                    <input type="number" name="display_order" value="0"
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" required class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="lg:col-span-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="lg:col-span-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Add Service</button>
                </div>
            </form>
        </div>

        <!-- Services List -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Current Services</h3>
            </div>
            
            @if($items->count() > 0)
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($items as $service)
                        <div class="p-6">
                            <form action="{{ route('admin.offices.generic.services.update', ['office' => $office, 'officeService' => $service]) }}" method="POST" class="grid gap-4 lg:grid-cols-5 items-end">
                                @csrf
                                @method('PUT')
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                    <input type="text" name="title" value="{{ $service->title }}" required
                                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Icon</label>
                                    <input type="text" name="icon" value="{{ $service->icon }}"
                                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order</label>
                                    <input type="number" name="display_order" value="{{ $service->display_order }}"
                                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select name="status" class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                        <option value="active" {{ $service->status === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $service->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="flex gap-2">
                                    <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Update</button>
                                    <form action="{{ route('admin.offices.generic.services.destroy', ['office' => $office, 'officeService' => $service]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this service?')" class="px-3 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">Delete</button>
                                    </form>
                                </div>
                                
                                <div class="lg:col-span-5">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <textarea name="description" rows="2" class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">{{ $service->description }}</textarea>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
                
                <div class="p-6">
                    {{ $items->links() }}
                </div>
            @else
                <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                    No services added yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection