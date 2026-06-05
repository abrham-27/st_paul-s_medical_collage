@extends('admin.layouts.app')

@section('title', isset($alumni) ? 'Edit Alumnus Profile' : 'Add Alumnus Profile')
@section('page-title', isset($alumni) ? 'Edit Alumnus Profile' : 'Add Alumnus Profile')

@section('content')
<div class="py-6 max-w-4xl">
    <div class="mb-4">
        <a href="{{ route('admin.alumni.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center gap-1">
            ← Back to Directory
        </a>
    </div>

    <!-- Error Alert -->
    @if($errors->any())
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200 dark:border-red-800" role="alert">
            <div class="font-medium mb-1">Please fix the errors below:</div>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden p-6">
        <form method="POST" 
              action="{{ $alumni ? route('admin.alumni.update', $alumni) : route('admin.alumni.store') }}" 
              enctype="multipart/form-data" 
              class="space-y-6">
            
            @csrf
            @if($alumni)
                @method('PUT')
            @endif

            <!-- Section 1: Personal & Contact Info -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4 pb-1 border-b border-gray-100 dark:border-gray-700">
                    Personal & Contact Info
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $alumni->name ?? '') }}" required placeholder="e.g. Dr. Sara Tekle"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $alumni->email ?? '') }}" required placeholder="e.g. sara.t@sphmmc.edu.et"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $alumni->phone ?? '') }}" placeholder="e.g. +251 911 234 567"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location (City, Country)</label>
                        <input type="text" name="location" value="{{ old('location', $alumni->location ?? '') }}" placeholder="e.g. Rochester, USA"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- Section 2: Education & Specialty -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4 pb-1 border-b border-gray-100 dark:border-gray-700">
                    Academic Info
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Graduation Year <span class="text-red-500">*</span></label>
                        <select name="graduation_year" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                            @for($year = date('Y') + 1; $year >= 2007; $year--)
                                <option value="{{ $year }}" {{ old('graduation_year', $alumni->graduation_year ?? 2015) == $year ? 'selected' : '' }}>
                                    Class of {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Degree Obtained <span class="text-red-500">*</span></label>
                        <input type="text" name="degree" value="{{ old('degree', $alumni->degree ?? 'Doctor of Medicine') }}" required placeholder="e.g. Doctor of Medicine"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Specialty <span class="text-red-500">*</span></label>
                        <input type="text" name="specialty" value="{{ old('specialty', $alumni->specialty ?? '') }}" required placeholder="e.g. Cardiology, Pediatrics"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- Section 3: Professional Info -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4 pb-1 border-b border-gray-100 dark:border-gray-700">
                    Professional Status
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Position / Title</label>
                        <input type="text" name="current_position" value="{{ old('current_position', $alumni->current_position ?? '') }}" placeholder="e.g. Senior Resident, Director"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Workplace / Hospital</label>
                        <input type="text" name="workplace" value="{{ old('workplace', $alumni->workplace ?? '') }}" placeholder="e.g. Mayo Clinic"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Publications Count</label>
                        <input type="number" name="publications" min="0" value="{{ old('publications', $alumni->publications ?? 0) }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- Section 4: Bio, Achievements, Awards -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4 pb-1 border-b border-gray-100 dark:border-gray-700">
                    Achievements & Biography
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Biography</label>
                        <textarea name="bio" rows="4" placeholder="Brief biography of the alumnus..."
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none">{{ old('bio', $alumni->bio ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Achievements (One per line)</label>
                        <textarea name="achievements_raw" rows="3" placeholder="e.g. Pioneered minimally invasive cardiac procedures&#10;Published 25+ research papers"
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none">{{ old('achievements_raw', $achievements_raw ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Honors & Awards (One per line)</label>
                        <textarea name="awards_raw" rows="3" placeholder="e.g. Excellence in Cardiology Award 2022&#10;Innovation in Medicine 2021"
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none">{{ old('awards_raw', $awards_raw ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 5: Social Links -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4 pb-1 border-b border-gray-100 dark:border-gray-700">
                    Social Connections
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">LinkedIn Profile Link</label>
                        <input type="url" name="linkedin" value="{{ old('linkedin', $alumni->linkedin ?? '') }}" placeholder="e.g. https://linkedin.com/in/saratekle"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Twitter Link</label>
                        <input type="url" name="twitter" value="{{ old('twitter', $alumni->twitter ?? '') }}" placeholder="e.g. https://twitter.com/saratekle"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ResearchGate Link</label>
                        <input type="url" name="research_gate" value="{{ old('research_gate', $alumni->research_gate ?? '') }}" placeholder="e.g. https://researchgate.net/profile/Sara-Tekle"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- Section 6: Image & Options -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4 pb-1 border-b border-gray-100 dark:border-gray-700">
                    Profile Image & Controls
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        @if(isset($alumni) && $alumni->getRawOriginal('image'))
                            <div class="flex-shrink-0">
                                <img src="{{ $alumni->image }}" alt="Current Photo" class="w-16 h-16 rounded-full object-cover border">
                            </div>
                        @endif
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Profile Photo</label>
                            <input type="file" name="image" accept="image/*"
                                   class="w-full text-sm text-gray-500 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-slate-50 dark:bg-gray-700 focus:outline-none py-1.5 px-3">
                            <p class="text-xs text-gray-400 mt-1">Leave empty to keep existing or use a default unsplash avatar.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6 pt-2">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="is_featured" value="1" 
                                   {{ old('is_featured', $alumni->is_featured ?? false) ? 'checked' : '' }}
                                   class="w-4.5 h-4.5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Feature Alumnus on Spotlight</span>
                        </label>
                        
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="is_active" value="1" 
                                   {{ old('is_active', $alumni->is_active ?? true) ? 'checked' : '' }}
                                   class="w-4.5 h-4.5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Profile Active / Approved</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit buttons -->
            <div class="flex gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    {{ isset($alumni) ? 'Save Changes' : 'Create Alumnus Profile' }}
                </button>
                <a href="{{ route('admin.alumni.index') }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
