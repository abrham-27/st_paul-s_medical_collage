@extends('admin.layouts.app')

@section('content')
<div class="admin-form">
    <div class="form-header">
        <h1>{{ isset($area) ? 'Edit Area' : 'Create Area' }}</h1>
        <a href="{{ route('admin.partnerships.areas.index') }}" class="btn btn-secondary">← Back</a>
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

    <form action="{{ isset($area) ? route('admin.partnerships.areas.update', $area->id) : route('admin.partnerships.areas.store') }}" method="POST">
        @csrf
        @if(isset($area))
            @method('PUT')
        @endif

        <div class="form-section">
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="{{ $area->title ?? old('title') }}" required class="form-control" placeholder="e.g., Research Collaboration">
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="icon_class">Icon/Emoji</label>
                    <input type="text" id="icon_class" name="icon_class" value="{{ $area->icon_class ?? old('icon_class') }}" class="form-control" placeholder="🔬" maxlength="50">
                    <small>Single emoji representing the area</small>
                    @error('icon_class') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="display_order">Display Order</label>
                    <input type="number" id="display_order" name="display_order" value="{{ $area->display_order ?? old('display_order', 0) }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" rows="6" class="form-control ckeditor">{{ $area->description ?? old('description') }}</textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $area->is_active ?? true) ? 'checked' : '' }}>
                Active (visible on website)
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">{{ isset($area) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.partnerships.areas.index') }}" class="btn btn-secondary">Cancel</a>
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
    margin-bottom: 2rem;
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

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
.checkbox-label { display: flex; align-items: center; gap: 0.5rem; font-weight: 500; }
</style>
@endsection

@push('scripts')
@include('admin.partnerships.partials.ckeditor')
@endpush
