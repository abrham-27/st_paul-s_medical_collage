{{-- Edit Hero Section --}}
@extends('admin.layouts.app')

@section('content')
<div class="form-container">
    <h1>Edit Hero Section</h1>
    
    <form action="{{ route('admin.research.roles-responsibility.hero.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ $hero->title ?? '' }}" class="form-control" required>
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="subtitle">Subtitle</label>
            <input type="text" id="subtitle" name="subtitle" value="{{ $hero->subtitle ?? '' }}" class="form-control">
            @error('subtitle') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-control rich-editor" rows="6">{{ $hero->content ?? '' }}</textarea>
            @error('content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="image">Banner Image</label>
            <input type="file" id="image" name="image" accept="image/*" class="form-control">
            @if($hero->image ?? false)
                <p>Current: <img src="{{ asset('storage/' . $hero->image) }}" style="max-width: 300px; margin-top: 1rem;"></p>
            @endif
        </div>

        <div class="form-group">
            <label for="cta_button_text">CTA Button Text</label>
            <input type="text" id="cta_button_text" name="cta_button_text" value="{{ $hero->cta_button_text ?? '' }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="cta_button_link">CTA Button Link</label>
            <input type="text" id="cta_button_link" name="cta_button_link" value="{{ $hero->cta_button_link ?? '' }}" class="form-control">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.research.roles-responsibility.index') }}" class="btn">Back</a>
        </div>
    </form>
</div>

<style>
.form-container { max-width: 600px; margin: 2rem auto; background: white; padding: 2rem; border-radius: 8px; }
.form-group { margin-bottom: 1.5rem; }
.form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; }
.form-control { width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; }
.btn { padding: 0.75rem 1.5rem; margin-right: 0.5rem; background: #0066cc; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
.btn:hover { background: #0052a3; }
.error { color: #dc3545; font-size: 0.875rem; }
</style>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
        .create(document.querySelector('#content'), {
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
