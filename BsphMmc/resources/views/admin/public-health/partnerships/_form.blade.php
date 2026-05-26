@php $partnership = $partnership ?? null; @endphp

<div class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Partnership Title</label>
        <input type="text" name="title" value="{{ old('title', $partnership?->title) }}"
               required placeholder="e.g. Collaboration with WHO Ethiopia"
               class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
        @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Area</label>
        <select name="area" required
                class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="local" {{ old('area', $partnership?->area ?? 'local') === 'local' ? 'selected' : '' }}>Local</option>
            <option value="international" {{ old('area', $partnership?->area) === 'international' ? 'selected' : '' }}>International</option>
        </select>
        @error('area')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Partnership Content</label>
        <textarea name="content" rows="6" placeholder="Partnership details..."
                  class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-y rich-editor">{{ old('content', $partnership?->content) }}</textarea>
        @error('content')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Featured Image (optional)</label>
        @if($partnership?->featured_image)
            <div class="mb-2">
                <img src="{{ Storage::url($partnership->featured_image) }}"
                     class="h-24 rounded-lg object-cover border border-gray-200 dark:border-gray-600" alt="Current image">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Current image — upload new to replace.</p>
            </div>
        @endif
        <input type="file" name="featured_image" accept="image/*"
               class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Display Order</label>
            <input type="number" name="display_order" value="{{ old('display_order', $partnership?->display_order ?? 0) }}"
                   min="0"
                   class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
        </div>
        <div class="flex items-center pt-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="status" value="1"
                       {{ old('status', $partnership?->status ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 text-blue-600 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-blue-500">
                <span class="text-sm text-gray-700 dark:text-gray-300">Active</span>
            </label>
        </div>
    </div>
</div>
