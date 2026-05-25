@extends('admin.layouts.app')

@section('title', $schoolName . ' · Add Research & Publication')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Add Research & Publication</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Create a new research or publication item for {{ $schoolName }}.</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form action="{{ route('admin.academics.research-publications.store', ['school' => $school]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="school_type" value="{{ $school }}" />

                <div class="grid gap-4 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subtitle</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle') }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Abstract</label>
                    <textarea name="abstract" rows="8" class="ckeditor mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">{{ old('abstract') }}</textarea>
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Authors</label>
                        <input type="text" name="authors" value="{{ old('authors') }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Publication Type</label>
                        <select name="publication_type" class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Type</option>
                            @foreach(['Research','Publication','Journal','Conference','Thesis'] as $type)
                                <option value="{{ $type }}" {{ old('publication_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid gap-4 lg:grid-cols-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Publication Date</label>
                        <input type="date" name="publication_date" value="{{ old('publication_date') }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Journal Name</label>
                        <input type="text" name="journal_name" value="{{ old('journal_name') }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Display Order</label>
                        <input type="number" name="display_order" value="{{ old('display_order', 0) }}" min="0"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">DOI Link</label>
                        <input type="url" name="doi_link" value="{{ old('doi_link') }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">External Link</label>
                        <input type="url" name="external_link" value="{{ old('external_link') }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cover Image</label>
                        <input type="file" name="cover_image" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">PDF File</label>
                        <input type="file" name="pdf_file" accept="application/pdf"
                               class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keywords / Tags</label>
                    <input type="text" name="keywords" value="{{ old('keywords') }}" placeholder="comma separated"
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div class="grid gap-4 lg:grid-cols-3 items-end">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                        <label for="featured" class="text-sm text-gray-700 dark:text-gray-300">Featured</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="status" name="status" value="published" {{ old('status') === 'published' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                        <label for="status" class="text-sm text-gray-700 dark:text-gray-300">Publish now</label>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.academics.research-publications.index', ['school' => $school]) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">Save Entry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.ClassicEditor) {
            document.querySelectorAll('textarea.ckeditor').forEach(function (textarea) {
                ClassicEditor.create(textarea).catch(function (error) { console.error(error); });
            });
        }
    });
</script>
@endsection
