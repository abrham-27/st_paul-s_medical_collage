@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <div class="page-header">
        <h1 class="page-title">Contact Information</h1>
        <a href="{{ route('admin.research.roles-responsibility.index') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.research.roles-responsibility.contact.update') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="office_name">Office Name *</label>
                    <input type="text" class="form-control @error('office_name') is-invalid @enderror" id="office_name" name="office_name" value="{{ old('office_name', $contact->office_name ?? '') }}" required>
                    @error('office_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="office_location">Office Location</label>
                    <input type="text" class="form-control @error('office_location') is-invalid @enderror" id="office_location" name="office_location" value="{{ old('office_location', $contact->office_location ?? '') }}" placeholder="Building, Floor, Room number">
                    @error('office_location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $contact->email ?? '') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $contact->phone ?? '') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="office_hours">Office Hours</label>
                    <textarea class="form-control @error('office_hours') is-invalid @enderror" id="office_hours" name="office_hours" rows="3" placeholder="e.g., Monday - Friday: 8:00 AM - 5:00 PM">{{ old('office_hours', $contact->office_hours ?? '') }}</textarea>
                    @error('office_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website', $contact->website ?? '') }}" placeholder="https://example.com">
                    @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="additional_info">Additional Information</label>
                    <textarea class="form-control rich-editor @error('additional_info') is-invalid @enderror" id="additional_info" name="additional_info" rows="6">{{ old('additional_info', $contact->additional_info ?? '') }}</textarea>
                    @error('additional_info')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', $contact->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Contact Information</button>
                    <a href="{{ route('admin.research.roles-responsibility.index') }}" class="btn btn-secondary">Cancel</a>
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
        .create(document.querySelector('#additional_info'), {
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