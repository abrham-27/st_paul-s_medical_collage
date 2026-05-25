@extends('admin.layouts.app')

@section('title', 'Research Projects - Admin')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Research Projects</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Function of IRB -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <span class="text-2xl mr-3">⚖️</span>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Function of IRB</h2>
                    </div>
                    
                    <form action="{{ route('admin.research.projects.irb.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Basic Fields -->
                        <div class="mb-6">
                            <label for="irb_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                            <input type="text" 
                                   id="irb_title" 
                                   name="title" 
                                   value="{{ $irb->title ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                        </div>

                        <div class="mb-6">
                            <label for="irb_content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content</label>
                            <textarea id="irb_content" 
                                      name="content" 
                                      rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent rich-editor"
                                      required>{{ $irb->content ?? '' }}</textarea>
                        </div>

                        <!-- Structured Content Toggle -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="legal_framework" class="mr-2" checked>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Enable Legal Framework Section</span>
                            </label>
                        </div>

                        <!-- Legal Framework Cards -->
                        <div class="mb-6">
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-4">Legal & Regulatory Framework</h3>
                            @php
                                $legalFramework = $irb ? json_decode($irb->legal_framework, true) : ['cards' => []];
                                $cards = $legalFramework['cards'] ?? [];
                            @endphp
                            @for ($i = 0; $i < 3; $i++)
                                @php
                                    $card = $cards[$i] ?? ['icon' => '🏛️', 'title' => '', 'content' => '', 'items' => []];
                                @endphp
                                <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 mb-4">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Card {{ $i + 1 }}</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Icon</label>
                                            <input type="text" name="legal_framework_{{ $i }}_icon" value="{{ $card['icon'] }}" 
                                                   class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                                            <input type="text" name="legal_framework_{{ $i }}_title" value="{{ $card['title'] }}" 
                                                   class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Content</label>
                                        <textarea name="legal_framework_{{ $i }}_content" rows="3" 
                                                  class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ $card['content'] }}</textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Items (one per line)</label>
                                        <textarea name="legal_framework_{{ $i }}_items" rows="2" 
                                                  class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ implode("\n", $card['items'] ?? []) }}</textarea>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <!-- IRB Structure -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="irb_structure" class="mr-2" checked>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Enable IRB Structure Section</span>
                            </label>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-4">IRB Structure</h3>
                            @php
                                $irbStructure = $irb ? json_decode($irb->irb_structure, true) : ['intro_text' => '', 'members' => []];
                                $members = $irbStructure['members'] ?? [];
                            @endphp
                            <div class="mb-4">
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Intro Text</label>
                                <textarea name="irb_intro_text" rows="2" 
                                          class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ $irbStructure['intro_text'] ?? '' }}</textarea>
                            </div>
                            @for ($i = 0; $i < 6; $i++)
                                @php
                                    $member = $members[$i] ?? ['icon' => '👤', 'title' => '', 'desc' => ''];
                                @endphp
                                <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 mb-4">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Member {{ $i + 1 }}</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Icon</label>
                                            <input type="text" name="irb_member_{{ $i }}_icon" value="{{ $member['icon'] }}" 
                                                   class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                                            <input type="text" name="irb_member_{{ $i }}_title" value="{{ $member['title'] }}" 
                                                   class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                                            <input type="text" name="irb_member_{{ $i }}_desc" value="{{ $member['desc'] }}" 
                                                   class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <!-- Appointment & Training -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="appointment_training" class="mr-2" checked>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Enable Appointment & Training Section</span>
                            </label>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-4">Appointment & Training</h3>
                            @php
                                $appointmentTraining = $irb ? json_decode($irb->appointment_training, true) : ['cards' => []];
                                $appointmentCards = $appointmentTraining['cards'] ?? [];
                            @endphp
                            @for ($i = 0; $i < 2; $i++)
                                @php
                                    $card = $appointmentCards[$i] ?? ['icon' => '📋', 'title' => '', 'content' => '', 'steps' => [], 'items' => []];
                                @endphp
                                <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 mb-4">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Card {{ $i + 1 }}</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Icon</label>
                                            <input type="text" name="appointment_{{ $i }}_icon" value="{{ $card['icon'] }}" 
                                                   class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                                            <input type="text" name="appointment_{{ $i }}_title" value="{{ $card['title'] }}" 
                                                   class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Content</label>
                                        <textarea name="appointment_{{ $i }}_content" rows="2" 
                                                  class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ $card['content'] }}</textarea>
                                    </div>
                                    
                                    @if($i == 0)
                                        <!-- Steps for first card -->
                                        <div class="mb-3">
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Steps</label>
                                            @for ($j = 0; $j < 3; $j++)
                                                @php
                                                    $step = ($card['steps'][$j] ?? ['num' => ($j+1).'', 'text' => '']);
                                                @endphp
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $j + 1 }}.</span>
                                                    <input type="text" name="appointment_{{ $i }}_step_{{ $j }}_text" value="{{ $step['text'] }}" 
                                                           class="flex-1 px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                                </div>
                                            @endfor
                                        </div>
                                    @else
                                        <!-- Items for second card -->
                                        <div class="mb-3">
                                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Items (one per line)</label>
                                            <textarea name="appointment_{{ $i }}_items" rows="2" 
                                                      class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white">{{ implode("\n", $card['items'] ?? []) }}</textarea>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>

                        <!-- Image -->
                        <div class="mb-6">
                            <label for="irb_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image</label>
                            <input type="file" 
                                   id="irb_image" 
                                   name="image" 
                                   accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @if($irb && $irb->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $irb->image) }}" alt="Current image" class="h-20 w-auto rounded">
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Update IRB
                        </button>
                    </form>
                </div>
            </div>

            <!-- iDream Lab -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <span class="text-2xl mr-3">🔬</span>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">iDream Lab</h2>
                    </div>
                    
                    <form action="{{ route('admin.research.projects.idream.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="idream_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                            <input type="text" 
                                   id="idream_title" 
                                   name="title" 
                                   value="{{ $idream->title ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="idream_content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content</label>
                            <textarea id="idream_content" 
                                      name="content" 
                                      rows="6"
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent rich-editor"
                                      required>{{ $idream->content ?? '' }}</textarea>
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label for="idream_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image</label>
                            <input type="file" 
                                   id="idream_image" 
                                   name="image" 
                                   accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @if($idream && $idream->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $idream->image) }}" alt="Current image" class="h-20 w-auto rounded">
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Update iDream Lab
                        </button>
                    </form>
                </div>
            </div>

            <!-- HDSS -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <span class="text-2xl mr-3">📊</span>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">HDSS</h2>
                    </div>
                    
                    <form action="{{ route('admin.research.projects.hdss.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="hdss_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                            <input type="text" 
                                   id="hdss_title" 
                                   name="title" 
                                   value="{{ $hdss->title ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="hdss_content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content</label>
                            <textarea id="hdss_content" 
                                      name="content" 
                                      rows="6"
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent rich-editor"
                                      required>{{ $hdss->content ?? '' }}</textarea>
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label for="hdss_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image</label>
                            <input type="file" 
                                   id="hdss_image" 
                                   name="image" 
                                   accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @if($hdss && $hdss->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $hdss->image) }}" alt="Current image" class="h-20 w-auto rounded">
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Update HDSS
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
