@extends('admin.layouts.app')
@section('title','ICT Services')
@section('page-title','ICT Office · Services')
@section('content')
<div class="py-6 space-y-4" x-data="{ addModal: false, editItem: null }">
    @if(session('success'))<div class="p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">{{ session('success') }}</div>@endif
    <div class="flex justify-end">
        <button @click="addModal=true" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition"><i class="fa-solid fa-plus"></i> Add Service</button>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs uppercase">
                <tr><th class="px-4 py-3 text-left">Icon</th><th class="px-4 py-3 text-left">Title</th><th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3 text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($items as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-4 py-3 text-2xl">{{ $item->icon ?? '⚙️' }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $item->title }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $item->status==='active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($item->status) }}</span></td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button @click="editItem={{ $item->toJson() }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition"><i class="fa-solid fa-pen-to-square text-sm"></i></button>
                            <form method="POST" action="{{ route('admin.offices.ict.services.destroy',$item) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition"><i class="fa-solid fa-trash text-sm"></i></button></form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">No services yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Add Modal --}}
    <div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
        <div @click.outside="addModal=false" class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-4"><h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Service</h3><button @click="addModal=false" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button></div>
            <form method="POST" action="{{ route('admin.offices.ict.services.store') }}" class="space-y-4">
                @csrf
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Icon (emoji)</label><input type="text" name="icon" placeholder="🌐" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title <span class="text-red-500">*</span></label><input type="text" name="title" required class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label><textarea name="description" rows="3" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Order</label><input type="number" name="display_order" value="0" min="0" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label><select name="status" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
                </div>
                <div class="flex gap-3 pt-2"><button type="submit" class="flex-1 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">Create</button><button type="button" @click="addModal=false" class="flex-1 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 transition">Cancel</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
