@extends('admin.layouts.app')

@section('title', 'Edit Nursing Department')
@section('page-title', 'School of Nursing · Edit Department')

@section('content')
<div class="py-6 max-w-3xl">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.nursing.departments.index') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">← Back to departments</a>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('admin.nursing.departments.update', $department) }}" class="space-y-5">
            @csrf @method('PUT')

            <p class="text-xs text-gray-500">Slug: <strong>{{ $department->slug }}</strong> (fixed)</p>

            <div>
                <label class="block text-sm font-medium mb-1">Icon (emoji)</label>
                <input type="text" name="icon" value="{{ old('icon', $department->icon) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Card title</label>
                <input type="text" name="title" value="{{ old('title', $department->title) }}" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $department->subtitle) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Card description</label>
                <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700">{{ old('description', $department->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Card features (one per line)</label>
                <textarea name="features_text" rows="4" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 font-mono text-sm">{{ old('features_text', implode("\n", $department->features ?? [])) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Detail page JSON</label>
                <p class="text-xs text-gray-500 mb-2">Includes page_title, hero_tagline, mission_text, intro, areas, training, careers, stats.</p>
                <textarea name="detail_json" rows="16" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 font-mono text-xs">{{ old('detail_json', json_encode($department->detail ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Display order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $department->display_order) }}" min="0" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                </div>
                <div class="flex items-end pb-2">
                    <label class="inline-flex items-center gap-2 text-sm">
                        <input type="checkbox" name="status" value="1" {{ old('status', $department->status) ? 'checked' : '' }}>
                        Active
                    </label>
                </div>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">Save department</button>
        </form>
    </div>
</div>
@endsection
