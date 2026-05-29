@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <div class="page-header">
        <h1 class="page-title">Process Steps</h1>
        <a href="{{ route('admin.research.roles-responsibility.processes.create') }}" class="btn btn-primary">Add New Process</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($processes->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Step #</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Icon</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($processes as $process)
                                <tr>
                                    <td>{{ $process->step_number }}</td>
                                    <td>{{ $process->title }}</td>
                                    <td>{{ Str::limit(strip_tags($process->description), 100) }}</td>
                                    <td>{{ $process->icon }}</td>
                                    <td>{{ $process->sort_order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $process->status ? 'success' : 'secondary' }}">
                                            {{ $process->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.research.roles-responsibility.processes.edit', $process) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.research.roles-responsibility.processes.destroy', $process) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?')">
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
                <p class="text-muted">No process steps found. <a href="{{ route('admin.research.roles-responsibility.processes.create') }}">Add the first one</a>.</p>
            @endif
        </div>
    </div>
</div>
@endsection