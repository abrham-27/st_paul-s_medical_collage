@extends('admin.layouts.app')

@section('title', $category->name . ' — Diseases')
@section('page-title', $category->icon . ' ' . $category->name . ' — Diseases')

@section('content')
<div class="py-6 space-y-4" x-data="{ addModal: false, editModal: false, editItem: null }">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.health-tips.index') }}"
           class="inline-flex items-center gap-2 text-sm text-blue-600 dark:text-blue-400 hover:underline">
            <i class="fa-solid fa-arrow-left"></i> Back to Categories
        </a>
        <button @click="addModal=true"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fa-solid fa-plus"></i> Add Disease
        </button>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Disease</th>
                        <th class="px-6 py-3 text-left">Symptoms</th>
                        <th class="px-6 py-3 text-left">Prevention</th>
                        <th class="px-6 py-3 text-left">Advice</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($diseases as $disease)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900 dark:text-white">{{ $disease->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-1">{{ $disease->description }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                <span class="text-xs">{{ count($disease->symptoms ?? []) }} items</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                <span class="text-xs">{{ count($disease->prevention ?? []) }} items</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                <span class="text-xs">{{ count($disease->advice ?? []) }} items</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click="editItem = {{ $disease->toJson() }}; editModal = true"
                                            class="p-1.5 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form method="POST"
                                          action="{{ route('admin.health-tips.diseases.destroy', [$category, $disease]) }}"
                                          onsubmit="return confirm('Delete this disease?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="p-1.5 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900 rounded-lg transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                No diseases in this category yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Disease Modal --}}
    <div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
        <div @click.outside="addModal=false" class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Disease</h3>
                <button @click="addModal=false" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <form method="POST" action="{{ route('admin.health-tips.diseases.store', $category) }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                    <textarea name="description" rows="2"
                              class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                </div>
                @foreach(['symptoms' => 'Symptoms', 'prevention' => 'Prevention Steps', 'advice' => 'Expert Advice'] as $field => $label)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ $label }}</label>
                    <p class="text-xs text-gray-400 mb-1">One item per line</p>
                    <textarea name="{{ $field }}" rows="4"
                              class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y font-mono"></textarea>
                </div>
                @endforeach
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">Add Disease</button>
                    <button type="button" @click="addModal=false" class="flex-1 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 transition">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Disease Modal --}}
    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
        <div @click.outside="editModal=false" class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Disease</h3>
                <button @click="editModal=false" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <template x-if="editItem">
                <form method="POST" :action="`/admin/health-tips/categories/{{ $category->id }}/diseases/${editItem.id}`" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                        <input type="text" name="name" :value="editItem.name" required
                               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                        <textarea name="description" rows="2" x-text="editItem.description"
                                  class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Symptoms <span class="text-xs text-gray-400">(one per line)</span></label>
                        <textarea name="symptoms" rows="4" x-text="(editItem.symptoms || []).join('\n')"
                                  class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y font-mono"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prevention Steps <span class="text-xs text-gray-400">(one per line)</span></label>
                        <textarea name="prevention" rows="4" x-text="(editItem.prevention || []).join('\n')"
                                  class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y font-mono"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Expert Advice <span class="text-xs text-gray-400">(one per line)</span></label>
                        <textarea name="advice" rows="4" x-text="(editItem.advice || []).join('\n')"
                                  class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y font-mono"></textarea>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="flex-1 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">Save</button>
                        <button type="button" @click="editModal=false" class="flex-1 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 transition">Cancel</button>
                    </div>
                </form>
            </template>
        </div>
    </div>

</div>
@endsection
