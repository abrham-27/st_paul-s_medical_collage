@extends('admin.layouts.app')

@section('title', $officeName . ' · Gallery')

@section('content')
<div class="py-6">
    <div class="max-w-6xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $officeName }} · Gallery</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage gallery images for {{ $officeName }}.</p>
        </div>

        <!-- Upload Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Upload Images</h3>
            
            <form action="{{ route('admin.offices.generic.gallery.store', ['office' => $office]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid gap-4 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title (Optional)</label>
                        <input type="text" name="title" placeholder="Gallery title"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category (Optional)</label>
                        <input type="text" name="category" placeholder="e.g., Events, Facilities"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Images</label>
                    <input type="file" name="images[]" multiple accept="image/*" required
                           class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <p class="text-xs text-gray-500 mt-1">Max size: 3MB per image. Supported: JPG, PNG, GIF</p>
                </div>
                
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Upload Images</button>
            </form>
        </div>

        <!-- Gallery Grid -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Gallery Images</h3>
            </div>
            
            @if($items->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-6">
                    @foreach($items as $item)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-32 object-cover rounded-lg">
                            
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                <form action="{{ route('admin.offices.generic.gallery.destroy', ['office' => $office, 'officeGallery' => $item]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this image?')" class="px-3 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">Delete</button>
                                </form>
                            </div>
                            
                            @if($item->title)
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2 truncate">{{ $item->title }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <div class="p-6">
                    {{ $items->links() }}
                </div>
            @else
                <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                    No images uploaded yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection