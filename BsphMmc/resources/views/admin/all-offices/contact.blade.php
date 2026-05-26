@extends('admin.layouts.app')

@section('title', 'All Offices · Contact')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">All Offices · Contact Information</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage contact information for all offices.</p>
        </div>

        <!-- Office Selector -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form method="GET" action="{{ route('admin.all-offices.contact') }}" class="flex items-end gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select Office</label>
                    <select name="office" onchange="this.form.submit()" class="block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @foreach($offices as $key => $name)
                            <option value="{{ $key }}" {{ $selectedOffice === $key ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <h4 class="text-red-800 font-medium mb-2">Please fix the following errors:</h4>
                    <ul class="text-red-700 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $offices[$selectedOffice] }} · Contact Information</h3>
            </div>

            <form action="{{ route('admin.all-offices.contact.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="office" value="{{ $selectedOffice }}" />

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Office Name</label>
                    <input type="text" name="office_name" value="{{ old('office_name', $contact->office_name) }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ old('email', $contact->email) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" name="location" value="{{ old('location', $contact->location) }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Working Hours</label>
                    <input type="text" name="working_hours" value="{{ old('working_hours', $contact->working_hours) }}" placeholder="e.g., Monday - Friday: 8:00 AM - 5:00 PM"
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Update Contact Info</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection