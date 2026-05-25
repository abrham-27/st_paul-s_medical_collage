@extends('admin.layouts.app')
@section('title','ICT Gallery')
@section('page-title','ICT Office · Gallery')
@section('content')
<div class="py-6 space-y-4" x-data="{ uploadModal: false }">
    @if(session('success'))<div class="p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">{{ session('success') }}</div>@endif
    <div class="flex justify-end">
        <button @click="uploadModal=true" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-upload"></i> Upload Images
        </button>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @forelse($items as $item)
        <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700">
            <img src="{{ Storage::url($item->image) }}" class="w-full h-36 object-cover" alt="{{ $item->title }}">
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                <form method="POST" action="{{ route('admin.offices.ict.gallery.destroy', $item) }}" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2 bg-white rounded-lg text-red-600 hover:bg-red-50 transition"><i class="fa-solid fa-trash text-sm"></i></button>
                </form>
            </div>
            @if($item->title)<div class="p-2"><p class="text-xs font-medium text-gray-900 dark:text-white truncate">{{ $item->title }}</p></div>@endif
        </div>
        @empty
        <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400"><i class="fa-solid fa-images text-4xl mb-3 block"></i><p>No images yet.</p></div>
        @endforelse
    </div>
    @if($items->hasPages())<div>{{ $items->links() }}</div>@endif

    <div x-show="uploadModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
        <div @click.outside="uploadModal=false" class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upload Images</h3>
                <button @click="uploadModal=false" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form method="POST" action="{{ route('admin.offices.ict.gallery.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label><input type="text" name="title" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label><input type="text" name="category" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Images <span class="text-red-500">*</span></label><input type="file" name="images[]" multiple accept="image/*" required class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"></div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">Upload</button>
                    <button type="button" @click="uploadModal=false" class="flex-1 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 transition">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
