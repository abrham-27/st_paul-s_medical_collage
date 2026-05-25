@extends('admin.layouts.app')
@section('title','ICT Projects')
@section('page-title','ICT Office · Projects')
@section('content')
<div class="py-6 space-y-4">
    @if(session('success'))<div class="p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">{{ session('success') }}</div>@endif
    <div class="flex justify-end">
        <a href="{{ route('admin.offices.ict.projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition"><i class="fa-solid fa-plus"></i> New Project</a>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs uppercase">
                <tr><th class="px-4 py-3 text-left">Project</th><th class="px-4 py-3 text-left">Status</th><th class="px-4 py-3 text-left">Date</th><th class="px-4 py-3 text-right">Actions</th></tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($items as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            @if($item->image)<img src="{{ Storage::url($item->image) }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0">@else<div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-diagram-project text-blue-500 text-sm"></i></div>@endif
                            <span class="font-medium text-gray-900 dark:text-white">{{ Str::limit($item->title,50) }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3"><span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $item->status==='published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($item->status) }}</span></td>
                    <td class="px-4 py-3 text-gray-500 dark:text-gray-400 text-xs">{{ $item->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.offices.ict.projects.edit',$item) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition"><i class="fa-solid fa-pen-to-square text-sm"></i></a>
                            <form method="POST" action="{{ route('admin.offices.ict.projects.destroy',$item) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition"><i class="fa-solid fa-trash text-sm"></i></button></form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">No projects yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())<div>{{ $items->links() }}</div>@endif
</div>
@endsection
