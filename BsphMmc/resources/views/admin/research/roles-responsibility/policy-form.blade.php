@extends('admin.layouts.app')

@section('title', isset($policy) ? 'Edit Policy Document' : 'Upload Policy Document')
@section('page-title', isset($policy) ? 'Edit Policy Document' : 'Upload Policy Document')

@section('content')
<div class="py-6 space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ isset($policy) ? 'Edit Policy Document' : 'Upload Policy Document' }}</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ isset($policy) ? 'Update the policy document information' : 'Upload a new policy or guideline document' }}</p>
        </div>
        <a href="{{ route('admin.research.roles-responsibility.policies.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Back to List
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <form action="{{ isset($policy) ? route('admin.research.roles-responsibility.policies.update', $policy) : route('admin.research.roles-responsibility.policies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if(isset($policy))
                    @method('PUT')
                @endif

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Policy Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $policy->title ?? '') }}" 
                           required 
                           placeholder="Research Ethics Guideline"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Category
                    </label>
                    <input type="text" 
                           id="category" 
                           name="category" 
                           value="{{ old('category', $policy->category ?? '') }}" 
                           placeholder="Ethical, Operational, etc."
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="6" 
                              placeholder="Brief description of this policy..."
                              class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none rich-editor @error('description') border-red-500 @enderror">{{ old('description', $policy->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="file_path" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Policy File (PDF, DOC, DOCX) {{ !isset($policy) ? '*' : '' }}
                    </label>
                    @if(isset($policy) && $policy->file_path)
                        <div class="mb-3 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                            <p class="text-sm text-blue-800 dark:text-blue-200">
                                <i class="fa-solid fa-file mr-2"></i>
                                Current file: <strong>{{ basename($policy->file_path) }}</strong>
                            </p>
                        </div>
                    @endif
                    <input type="file" 
                           id="file_path" 
                           name="file" 
                           accept=".pdf,.doc,.docx"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300 @error('file') border-red-500 @enderror">
                    @if(!isset($policy))
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">File is required for new policies</p>
                    @endif
                    @error('file')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Sort Order
                    </label>
                    <input type="number" 
                           id="sort_order" 
                           name="sort_order" 
                           value="{{ old('sort_order', $policy->sort_order ?? 0) }}" 
                           min="0"
                           class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status
                    </label>
                    <select id="status" 
                            name="status" 
                            class="w-full px-4 py-2.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <option value="1" {{ old('status', $policy->status ?? 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !old('status', $policy->status ?? 1) ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="flex items-center gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        <i class="fa-solid fa-{{ isset($policy) ? 'save' : 'upload' }}"></i>
                        {{ isset($policy) ? 'Update Policy' : 'Upload Policy' }}
                    </button>
                    <a href="{{ route('admin.research.roles-responsibility.policies.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        <i class="fa-solid fa-times"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let editorInstance;
    
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', '|', 'undo', 'redo'],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
        })
        .then(editor => {
            editorInstance = editor;
            
            // Ensure form submission works with CKEditor
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                // Update the original textarea with CKEditor content
                document.querySelector('#description').value = editor.getData();
            });
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });
});
</script>
@endpush
@endsection