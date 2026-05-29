@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <div class="page-header">
        <h1 class="page-title">Policies & Documents</h1>
        <a href="{{ route('admin.research.roles-responsibility.policies.create') }}" class="btn btn-primary">Upload New Policy</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($policies->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>File Type</th>
                                <th>Description</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($policies as $policy)
                                <tr>
                                    <td>{{ $policy->title }}</td>
                                    <td>{{ $policy->category ?? 'General' }}</td>
                                    <td><span class="badge badge-info">{{ strtoupper($policy->file_type) }}</span></td>
                                    <td>{{ Str::limit(strip_tags($policy->description), 80) }}</td>
                                    <td>{{ $policy->sort_order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $policy->status ? 'success' : 'secondary' }}">
                                            {{ $policy->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ $policy->file_url }}" target="_blank" class="btn btn-sm btn-outline-info" title="Download">📄</a>
                                        <a href="{{ route('admin.research.roles-responsibility.policies.edit', $policy) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.research.roles-responsibility.policies.destroy', $policy) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No policies found. <a href="{{ route('admin.research.roles-responsibility.policies.create') }}">Upload the first one</a>.</p>
            @endif
        </div>
    </div>
</div>
@endsection