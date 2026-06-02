@extends('admin.layouts.app')

@section('content')
<div class="admin-form">
    <div class="form-header">
        <h1>Edit Partner</h1>
        <a href="{{ route('admin.partnerships.partners.index') }}" class="btn btn-secondary">← Back to Partners</a>
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

    <form action="{{ route('admin.partnerships.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h2>Basic Information</h2>

            <div class="form-group">
                <label for="name">Partner Name *</label>
                <input type="text" id="name" name="name" value="{{ $partner->name }}" required class="form-control">
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="category_id">Category *</label>
                    <select id="category_id" name="category_id" required class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $partner->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="collaboration_type">Collaboration Type</label>
                    <input type="text" id="collaboration_type" name="collaboration_type" value="{{ $partner->collaboration_type }}" placeholder="e.g., Research, Academic Exchange" class="form-control">
                </div>

                <div class="form-group">
                    <label for="partnership_year">Partnership Year</label>
                    <input type="number" id="partnership_year" name="partnership_year" value="{{ $partner->partnership_year }}" placeholder="YYYY" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="short_description">Short Description *</label>
                <textarea id="short_description" name="short_description" rows="3" required class="form-control">{{ $partner->short_description }}</textarea>
                <small>Brief overview (shown in card listing)</small>
                @error('short_description') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="full_description">Full Description</label>
                <textarea id="full_description" name="full_description" rows="8" class="form-control ckeditor">{{ $partner->full_description }}</textarea>
            </div>
        </div>

        <div class="form-section">
            <h2>Media & Links</h2>

            <div class="form-group">
                <label for="logo">Partner Logo</label>
                <input type="file" id="logo" name="logo" accept="image/*" class="form-control">
                <small>PNG, JPG, or WEBP (max 4MB)</small>
                @if($partner->logo_image_url)
                    <div style="margin-top: 1rem;">
                        <img src="{{ $partner->logo_image_url }}" alt="{{ $partner->name }}" style="max-width: 200px; border-radius: 8px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="website_url">Website URL</label>
                <input type="url" id="website_url" name="website_url" value="{{ $partner->website_url }}" placeholder="https://example.com" class="form-control">
            </div>
        </div>

        <div class="form-section">
            <h2>Settings</h2>

            <div class="form-row">
                <div class="form-group checkbox">
                    <label>
                        <input type="checkbox" name="is_featured" value="1" {{ $partner->is_featured ? 'checked' : '' }}>
                        Featured Partner (shows in carousel)
                    </label>
                </div>

                <div class="form-group checkbox">
                    <label>
                        <input type="checkbox" name="is_active" value="1" {{ $partner->is_active ? 'checked' : '' }}>
                        Active (visible on public page)
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="display_order">Display Order</label>
                <input type="number" id="display_order" name="display_order" value="{{ $partner->display_order }}" class="form-control">
                <small>Lower numbers appear first</small>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Partner</button>
            <a href="{{ route('admin.partnerships.partners.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
.admin-form {
    background: white;
    padding: 2rem;
    border-radius: 12px;
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.form-header h1 {
    font-size: 2rem;
    color: #2D2020;
    margin: 0;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.form-section {
    margin-bottom: 2.5rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #e2e8f0;
}

.form-section:last-of-type {
    border-bottom: none;
}

.form-section h2 {
    font-size: 1.3rem;
    color: #2D2020;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #2D2020;
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-family: inherit;
    font-size: 1rem;
}

.form-control:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-group small {
    display: block;
    margin-top: 0.5rem;
    color: #6B7280;
}

.form-group.checkbox label {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    font-weight: 500;
}

.form-group.checkbox input {
    margin-right: 0.75rem;
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.error {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-primary {
    background: #2563eb;
    color: white;
}

.btn-secondary {
    background: #e2e8f0;
    color: #2D2020;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

@push('scripts')
@include('admin.partnerships.partials.ckeditor')
@endpush
