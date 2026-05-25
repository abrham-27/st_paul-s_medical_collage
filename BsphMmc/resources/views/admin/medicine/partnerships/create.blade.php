@extends('admin.layouts.app')

@section('title', 'Medicine — Add Partnership')
@section('page-title', 'School of Medicine · Add Partnership')

@section('content')
<div class="py-6 max-w-3xl">

    <div class="flex items-center gap-2 mb-6">
        <a href="{{ route('admin.medicine.partnership') }}"
           class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <form method="POST" action="{{ route('admin.medicine.partnerships.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @include('admin.medicine.partnerships._form')
            <div class="pt-2 flex items-center gap-3">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Add New Partnership
                </button>
                <a href="{{ route('admin.medicine.partnership') }}"
                   class="px-6 py-2.5 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
