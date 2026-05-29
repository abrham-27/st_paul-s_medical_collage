@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <div class="page-header">
        <h1 class="page-title">{{ isset($faq) ? 'Edit' : 'Add' }} FAQ</h1>
        <a href="{{ route('admin.research.roles-responsibility.faqs.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ isset($faq) ? route('admin.research.roles-responsibility.faqs.update', $faq) : route('admin.research.roles-responsibility.faqs.store') }}" method="POST">
                @csrf
                @if(isset($faq))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="question">Question *</label>
                    <textarea class="form-control @error('question') is-invalid @enderror" id="question" name="question" rows="3" required>{{ old('question', $faq->question ?? '') }}</textarea>
                    @error('question')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="answer">Answer *</label>
                    <textarea class="form-control rich-editor @error('answer') is-invalid @enderror" id="answer" name="answer" rows="8" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                    @error('answer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}" min="0">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if(isset($faq))
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', $faq->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                @endif

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">{{ isset($faq) ? 'Update' : 'Create' }} FAQ</button>
                    <a href="{{ route('admin.research.roles-responsibility.faqs.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
        .create(document.querySelector('#answer'), {
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