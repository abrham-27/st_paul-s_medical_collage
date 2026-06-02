@extends('admin.layouts.app')

@section('content')
<div class="admin-form">
    <div class="form-header">
        <h1>{{ isset($document) ? 'Edit Document' : 'Add Document' }}</h1>
        <a href="{{ route('admin.partnerships.documents.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($document) ? route('admin.partnerships.documents.update', $document->id) : route('admin.partnerships.documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($document))
            @method('PUT')
        @endif

        <div class="form-section">
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="{{ $document->title ?? old('title') }}" required class="form-control" placeholder="e.g., MOU 2024">
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="document_category">Category</label>
                    <select id="document_category" name="document_category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach(['MOU', 'Agreement', 'Report', 'Other'] as $cat)
                            <option value="{{ $cat }}" {{ (isset($document) && $document->document_category == $cat) || old('document_category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('document_category') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="document_file">Document File {{ isset($document) ? '' : '*' }}</label>
                    <input type="file" id="document_file" name="document_file" class="form-control" accept=".pdf,.doc,.docx" {{ isset($document) ? '' : 'required' }}>
                    <small>PDF, DOC, or DOCX (max 10MB)</small>
                    @if(isset($document) && $document->file_url)
                        <p style="margin-top:0.5rem;"><a href="{{ $document->file_url }}" target="_blank">View current file</a></p>
                    @endif
                    @error('document_file') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="6" class="form-control ckeditor">{{ $document->description ?? old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $document->is_active ?? true) ? 'checked' : '' }}>
                    Active (visible on website)
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">{{ isset($document) ? 'Update' : 'Add' }}</button>
            <a href="{{ route('admin.partnerships.documents.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
.admin-form { background: white; padding: 2rem; border-radius: 12px; }
.form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
.form-header h1 { font-size: 2rem; color: #2D2020; margin: 0; }
.alert-danger { background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; }
.form-section { margin-bottom: 2rem; }
.form-group { margin-bottom: 1.5rem; }
.form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2D2020; }
.form-control { width: 100%; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 6px; font-family: inherit; font-size: 1rem; }
.form-control:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
.form-group small { display: block; margin-top: 0.5rem; color: #6B7280; }
.form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; }
.error { color: #dc3545; font-size: 0.9rem; margin-top: 0.5rem; }
.form-actions { display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0; }
.btn { padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600; border: none; cursor: pointer; font-size: 1rem; }
.btn-primary { background: #2563eb; color: white; }
.btn-secondary { background: #e2e8f0; color: #2D2020; }
.checkbox-label { display: flex; align-items: center; gap: 0.5rem; font-weight: 500; }
</style>
@endsection

@push('scripts')
@include('admin.partnerships.partials.ckeditor')
@endpush
