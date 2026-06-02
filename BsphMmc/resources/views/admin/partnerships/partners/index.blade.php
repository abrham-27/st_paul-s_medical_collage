@extends('admin.layouts.app')

@section('content')
<div class="admin-content">
    <div class="content-header">
        <div>
            <h1>Partners Management</h1>
            <p class="breadcrumb"><a href="{{ route('admin.partnerships.index') }}">Partnerships</a> / Partners</p>
        </div>
        <a href="{{ route('admin.partnerships.partners.create') }}" class="btn btn-primary">+ Add Partner</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Year</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                    <tr>
                        <td>
                            @if($partner->logo_image_url)
                                <img src="{{ $partner->logo_image_url }}" alt="{{ $partner->name }}" class="logo-thumb">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td><strong>{{ $partner->name }}</strong></td>
                        <td>{{ $partner->category->name ?? 'N/A' }}</td>
                        <td>{{ $partner->collaboration_type ?? 'N/A' }}</td>
                        <td>{{ $partner->partnership_year ?? 'N/A' }}</td>
                        <td>
                            @if($partner->is_featured)
                                <span class="badge badge-success">✓ Featured</span>
                            @else
                                <span class="badge badge-gray">Not Featured</span>
                            @endif
                        </td>
                        <td>
                            @if($partner->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.partnerships.partners.edit', $partner->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.partnerships.partners.destroy', $partner->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No partners found. <a href="{{ route('admin.partnerships.partners.create') }}">Create one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($partners->hasPages())
        <div class="pagination-wrapper">
            {{ $partners->links() }}
        </div>
    @endif
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

.breadcrumb a:hover {
    text-decoration: underline;
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.table-container {
    overflow-x: auto;
    margin-bottom: 2rem;
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

.logo-thumb {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
}

.badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.badge-success {
    background: #d4edda;
    color: #155724;
}

.badge-gray {
    background: #e2e8f0;
    color: #6B7280;
}

.badge-danger {
    background: #f8d7da;
    color: #721c24;
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
    transition: all 0.2s;
    font-size: 0.9rem;
}

.btn-primary {
    background: #2563eb;
    color: white;
}

.btn-primary:hover {
    background: #1d4ed8;
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

.pagination-wrapper {
    display: flex;
    justify-content: center;
    padding: 1rem 0;
}

.text-center {
    text-align: center;
}

.text-muted {
    color: #6B7280;
}

@media (max-width: 768px) {
    .content-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .table {
        font-size: 0.9rem;
    }

    .table th,
    .table td {
        padding: 0.75rem;
    }
}
</style>
@endsection
