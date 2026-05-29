@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h2>{{ isset($policy) ? 'Edit Policy Document' : 'Upload Policy Document' }}</h2>

    <form action="{{ isset($policy) ? route('admin.research.roles-responsibility.policies.update', $policy) : route('admin.research.roles-responsibility.policies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($policy))
            @method('PUT')
        @endif

        <div class="card">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="title">Policy Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $policy->title ?? '') }}" placeholder="Research Ethics Guideline" required>
                    @error('title')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category" class="form-control"
                           value="{{ old('category', $policy->category ?? '') }}" placeholder="Ethical, Operational, etc.">
                </div>

                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control rich-editor @error('description') is-invalid @enderror"
                              rows="6" placeholder="Brief description of this policy...">{{ old('description', $policy->description ?? '') }}</textarea>
                    @error('description')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group mb-3">
                    <label for="file_path">Policy File (PDF, DOC, DOCX)</label>
                    @if(isset($policy) && $policy->file_path)
                        <p><small>Current file: <strong>{{ basename($policy->file_path) }}</strong></small></p>
                    @endif
                    <input type="file" name="file_path" id="file_path" class="form-control @error('file_path') is-invalid @enderror"
                           accept=".pdf,.doc,.docx">
                    @if(!isset($policy))<small class="form-text text-muted">File is required for new policies</small>@endif
                    @error('file_path')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ old('status', $policy->status ?? 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !old('status', $policy->status ?? 1) ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($policy) ? 'Update Policy' : 'Upload Policy' }}
                    </button>
                    <a href="{{ route('admin.research.roles-responsibility.policies.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
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
        .catch(error => {
            console.error(error);
        });
});
</script>
@endpush
@endsection
