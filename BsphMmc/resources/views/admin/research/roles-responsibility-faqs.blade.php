@extends('admin.layouts.app')

@section('content')
<div class="admin-page">
    <div class="page-header">
        <h1 class="page-title">Frequently Asked Questions</h1>
        <a href="{{ route('admin.research.roles-responsibility.faqs.create') }}" class="btn btn-primary">Add New FAQ</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($faqs->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqs as $faq)
                                <tr>
                                    <td>{{ Str::limit($faq->question, 80) }}</td>
                                    <td>{{ Str::limit(strip_tags($faq->answer), 100) }}</td>
                                    <td>{{ $faq->sort_order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $faq->status ? 'success' : 'secondary' }}">
                                            {{ $faq->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.research.roles-responsibility.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.research.roles-responsibility.faqs.destroy', $faq) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?')">
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
                <p class="text-muted">No FAQs found. <a href="{{ route('admin.research.roles-responsibility.faqs.create') }}">Add the first one</a>.</p>
            @endif
        </div>
    </div>
</div>
@endsection