@extends('admin.layouts.app')

@section('title', 'Nursing — Edit Partnership')
@section('page-title', 'School of Nursing · Edit Partnership')

@section('content')
<div class="py-6 max-w-3xl">

    <div class="flex items-center gap-2 mb-6">
        <a href="{{ route('admin.nursing.partnerships.index') }}"
           class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <form method="POST" action="{{ route('admin.nursing.partnerships.update', $partnership) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.nursing.partnerships._form', ['partnership' => $partnership])
            <div class="pt-2 flex items-center gap-3">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Update Partnership
                </button>
                <a href="{{ route('admin.nursing.partnerships.index') }}"
                   class="px-6 py-2.5 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
