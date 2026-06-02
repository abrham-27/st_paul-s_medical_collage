@extends('admin.layouts.app')

@section('content')
<div class="admin-content">
    <div class="content-header">
        <div>
            <h1>Success Stories</h1>
            <p class="breadcrumb"><a href="{{ route('admin.partnerships.index') }}">Partnerships</a> / Stories</p>
        </div>
        <a href="{{ route('admin.partnerships.success-stories.create') }}" class="btn btn-primary">+ Add Story</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Summary</th>
                    <th>Image</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stories as $story)
                    <tr>
                        <td><strong>{{ $story->title }}</strong></td>
                        <td>{{ Str::limit($story->summary, 50) }}</td>
                        <td>
                            @if($story->image_url)
                                <img src="{{ $story->image_url }}" alt="{{ $story->title }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>{{ $story->display_order }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.partnerships.success-stories.edit', $story->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.partnerships.success-stories.destroy', $story->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No stories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.admin-content {
    background: white;
    padding: 2rem;
    border-radius: 12px;
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.content-header h1 {
    font-size: 2rem;
    color: #2D2020;
    margin-bottom: 0.5rem;
}

.breadcrumb {
    color: #6B7280;
    font-size: 0.95rem;
}

.breadcrumb a {
    color: #2563eb;
    text-decoration: none;
}

.alert-success {
    background: #d4edda;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.table-container {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table thead {
    background: #f8f9fa;
    border-bottom: 2px solid #e2e8f0;
}

.table th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: #2D2020;
}

.table td {
    padding: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.table tbody tr:hover {
    background: #f8f9fa;
}

.actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn-primary {
    background: #2563eb;
    color: white;
}

.btn-sm {
    padding: 0.35rem 0.75rem;
    font-size: 0.8rem;
}

.btn-info {
    background: #17a2b8;
    color: white;
}

.btn-danger {
    background: #dc3545;
    color: white;
}

.text-center {
    text-align: center;
}

.text-muted {
    color: #6B7280;
}
</style>
@endsection
