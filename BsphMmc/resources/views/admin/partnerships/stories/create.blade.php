@extends('admin.layouts.app')

@section('content')
<div class="admin-form">
    <div class="form-header">
        <h1>{{ isset($story) ? 'Edit Success Story' : 'Create Success Story' }}</h1>
        <a href="{{ route('admin.partnerships.success-stories.index') }}" class="btn btn-secondary">← Back</a>
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

    <form action="{{ isset($story) ? route('admin.partnerships.success-stories.update', $story->id) : route('admin.partnerships.success-stories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($story))
            @method('PUT')
        @endif

        <div class="form-section">
            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" id="title" name="title" value="{{ $story->title ?? old('title') }}" required class="form-control">
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="summary">Summary</label>
                <textarea id="summary" name="summary" rows="3" class="form-control">{{ $story->summary ?? old('summary') }}</textarea>
                <small>Brief overview shown in card</small>
                @error('summary') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="content">Full Story Content</label>
                <textarea id="content" name="content" rows="8" class="form-control ckeditor">{{ $story->content ?? old('content') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="image">Story Image</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control">
                    @if(isset($story) && $story->image_url)
                        <div style="margin-top: 1rem;">
                            <img src="{{ $story->image_url }}" alt="{{ $story->title }}" style="max-width: 200px; border-radius: 8px;">
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="display_order">Display Order</label>
                    <input type="number" id="display_order" name="display_order" value="{{ $story->display_order ?? old('display_order', 0) }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $story->is_active ?? true) ? 'checked' : '' }}>
                    Active (visible on website)
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">{{ isset($story) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.partnerships.success-stories.index') }}" class="btn btn-secondary">Cancel</a>
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
