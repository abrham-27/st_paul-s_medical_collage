@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <div class="page-header">
        <h1 class="page-title">Statistics & Highlights</h1>
        <a href="{{ route('admin.research.roles-responsibility.statistics.create') }}" class="btn btn-primary">Add New Statistic</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($statistics->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Label</th>
                                <th>Value</th>
                                <th>Icon</th>
                                <th>Description</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statistics as $statistic)
                                <tr>
                                    <td>{{ $statistic->label }}</td>
                                    <td><strong>{{ $statistic->value }}</strong></td>
                                    <td>{{ $statistic->icon }}</td>
                                    <td>{{ Str::limit($statistic->description, 50) }}</td>
                                    <td>{{ $statistic->sort_order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $statistic->status ? 'success' : 'secondary' }}">
                                            {{ $statistic->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.research.roles-responsibility.statistics.edit', $statistic) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.research.roles-responsibility.statistics.destroy', $statistic) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?')">
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
                <p class="text-muted">No statistics found. <a href="{{ route('admin.research.roles-responsibility.statistics.create') }}">Add the first one</a>.</p>
            @endif
        </div>
    </div>
</div>
@endsection