@extends('admin.layouts.app')

@section('title', 'Gallery')
@section('page-title', 'Gallery Management')

@section('content')
<div class="py-6 space-y-4" x-data="{ uploadModal: false, editModal: false, editItem: null }">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" class="flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search gallery..."
                   class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none w-48">
            @if($categories->count())
                <select name="category"
                        class="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            @endif
            <button type="submit"
                    class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-search mr-1"></i> Filter
            </button>
        </form>
        <button @click="uploadModal=true"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
            <i class="fa-solid fa-upload"></i> Upload Images
        </button>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @forelse($galleries as $item)
            <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700">
                <img src="{{ Storage::url($item->image) }}"
                     class="w-full h-40 object-cover" alt="{{ $item->title }}">
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                    <button @click="editItem = {{ $item->toJson() }}; editModal = true"
                            class="p-2 bg-white rounded-lg text-blue-600 hover:bg-blue-50 transition">
                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                    </button>
                    <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}"
                          onsubmit="return confirm('Delete this image?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 bg-white rounded-lg text-red-600 hover:bg-red-50 transition">
                            <i class="fa-solid fa-trash text-sm"></i>
                        </button>
                    </form>
                </div>
                <div class="p-2">
                    <p class="text-xs font-medium text-gray-900 dark:text-white truncate">{{ $item->title }}</p>
                    @if($item->category)
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $item->category }}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400">
                <i class="fa-solid fa-images text-4xl mb-3 block"></i>
                <p>No images yet. Upload some!</p>
            </div>
        @endforelse
    </div>

    @if($galleries->hasPages())
        <div>{{ $galleries->links() }}</div>
    @endif

    {{-- Upload Modal --}}
    <div x-show="uploadModal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
        <div @click.outside="uploadModal=false"
             class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upload Images</h3>
                <button @click="uploadModal=false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" required
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                    <input type="text" name="category"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Images <span class="text-red-500">*</span></label>
                    <input type="file" name="images[]" multiple accept="image/*" required
                           class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">You can select multiple images at once.</p>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="flex-1 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                        Upload
                    </button>
                    <button type="button" @click="uploadModal=false"
                            class="flex-1 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div x-show="editModal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
        <div @click.outside="editModal=false"
             class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Image</h3>
                <button @click="editModal=false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <template x-if="editItem">
                <form method="POST" :action="`/admin/gallery/${editItem.id}`" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                        <input type="text" name="title" :value="editItem.title" required
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                        <input type="text" name="category" :value="editItem.category"
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                                class="flex-1 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Save
                        </button>
                        <button type="button" @click="editModal=false"
                                class="flex-1 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Cancel
                        </button>
                    </div>
                </form>
            </template>
        </div>
    </div>

</div>
@endsection
