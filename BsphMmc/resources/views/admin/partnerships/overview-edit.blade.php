@extends('admin.layouts.app')

@section('content')
<div class="admin-form">
    <div class="form-header">
        <h1>Edit Overview Page</h1>
        <a href="{{ route('admin.partnerships.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.partnerships.overview-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h2>Hero Section</h2>

            <div class="form-group">
                <label for="hero_title">Hero Title</label>
                <input type="text" id="hero_title" name="hero_title" value="{{ $page->hero_title ?? old('hero_title') }}" placeholder="Institutional Partnerships & Collaborations" class="form-control">
            </div>

            <div class="form-group">
                <label for="hero_subtitle">Hero Subtitle</label>
                <textarea id="hero_subtitle" name="hero_subtitle" rows="3" class="form-control" placeholder="Building bridges with leading institutions worldwide...">{{ $page->hero_subtitle ?? old('hero_subtitle') }}</textarea>
            </div>

            <div class="form-group">
                <label for="hero_banner">Hero Banner Image</label>
                <input type="file" id="hero_banner" name="hero_banner" accept="image/*" class="form-control">
                <small>Background image for hero section (recommended: 1920×500px)</small>
                @if($page->hero_banner_image_url)
                    <p style="margin-top:0.75rem;"><img src="{{ $page->hero_banner_image_url }}" alt="Current banner" style="max-width:100%;max-height:200px;border-radius:8px;"></p>
                @endif
            </div>
        </div>

        <div class="form-section">
            <h2>Overview Content</h2>

            <div class="form-group">
                <label for="overview_content">Overview Content</label>
                <textarea id="overview_content" name="overview_content" rows="10" class="form-control ckeditor">{{ $page->overview_content ?? old('overview_content') }}</textarea>
                <small>Main content displayed on the partnerships page overview section</small>
            </div>
        </div>

        <div class="form-section">
            <h2>Meta Information</h2>

            <div class="form-group">
                <label for="meta_title">Meta Title (SEO)</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ $page->meta_title ?? old('meta_title') }}" placeholder="Page title for search engines" class="form-control" maxlength="60">
                <small>Recommended: 50-60 characters</small>
            </div>

            <div class="form-group">
                <label for="meta_description">Meta Description (SEO)</label>
                <textarea id="meta_description" name="meta_description" rows="2" class="form-control" placeholder="Brief page description..." maxlength="160">{{ $page->meta_description ?? old('meta_description') }}</textarea>
                <small>Recommended: 150-160 characters</small>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('admin.partnerships.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
.admin-form {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    max-width: 900px;
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.form-header h1 {
    font-size: 2rem;
    color: #2D2020;
    margin: 0;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
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
    margin-top: 0;
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
    font-size: 0.9rem;
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

.btn-primary:hover {
    background: #1d4ed8;
}

.btn-secondary {
    background: #e2e8f0;
    color: #2D2020;
}

.btn-secondary:hover {
    background: #cbd5e1;
}

@media (max-width: 768px) {
    .admin-form {
        padding: 1rem;
    }

    .form-actions {
        flex-direction: column;
    }
}
</style>
@endsection

@push('scripts')
@include('admin.partnerships.partials.ckeditor')
@endpush
