@extends('admin.layouts.app')

@section('title', 'Nursing — Departments Landing')
@section('page-title', 'School of Nursing · Departments Landing')

@section('content')
<div class="py-6 max-w-3xl">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.nursing.departments.index') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">← Back to departments</a>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('admin.nursing.departments.landing.update') }}" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Hero title</label>
                <input type="text" name="hero_title" value="{{ old('hero_title', $landing->hero_title) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Hero subtitle</label>
                <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $landing->hero_subtitle) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Excellence section (JSON)</label>
                <textarea name="excellence_json" rows="8" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 font-mono text-xs">{{ old('excellence_json', json_encode($landing->excellence ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Stats section (JSON)</label>
                <textarea name="stats_json" rows="6" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 font-mono text-xs">{{ old('stats_json', json_encode($landing->stats ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Programs section (JSON)</label>
                <textarea name="programs_json" rows="10" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 font-mono text-xs">{{ old('programs_json', json_encode($landing->programs ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">Save landing</button>
        </form>
    </div>
</div>
@endsection
