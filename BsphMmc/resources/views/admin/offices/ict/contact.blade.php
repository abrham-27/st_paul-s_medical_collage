@extends('admin.layouts.app')
@section('title','ICT Contact Info')
@section('page-title','ICT Office · Contact Information')
@section('content')
<div class="py-6 max-w-xl">
    @if(session('success'))<div class="mb-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-sm text-green-700 dark:text-green-300">{{ session('success') }}</div>@endif
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('admin.offices.ict.contact.update') }}" class="space-y-5">
            @csrf @method('PUT')
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Office Name</label><input type="text" name="office_name" value="{{ old('office_name',$contact->office_name) }}" placeholder="ICT Department" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label><input type="email" name="email" value="{{ old('email',$contact->email) }}" placeholder="ict@sphmmc.edu.et" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label><input type="text" name="phone" value="{{ old('phone',$contact->phone) }}" placeholder="+251 11 275 3410" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location</label><input type="text" name="location" value="{{ old('location',$contact->location) }}" placeholder="Main Campus, ICT Building" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Working Hours</label><input type="text" name="working_hours" value="{{ old('working_hours',$contact->working_hours) }}" placeholder="Mon – Fri: 8:00 AM – 6:00 PM" class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></div>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">Save Contact Info</button>
        </form>
    </div>
</div>
@endsection
