@extends('admin.layouts.app')

@section('title', 'Partnership Applications')
@section('page-title', 'Partnership Applications')

@section('content')
<div class="admin-content">
    <div class="content-header">
        <div>
            <h1>Partnership Applications</h1>
            <p class="breadcrumb">
                <a href="{{ route('admin.partnerships.index') }}">Partnerships</a> / Applications
            </p>
        </div>
        <a href="{{ route('admin.partnerships.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Partnerships
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="filter-bar">
        <a href="{{ route('admin.partnerships.applications.index') }}"
           class="filter-pill {{ !request('status') ? 'active' : '' }}">
            All <span class="count">({{ array_sum($counts) }})</span>
        </a>
        @foreach(\App\Models\PartnershipApplication::STATUSES as $key => $label)
            <a href="{{ route('admin.partnerships.applications.index', ['status' => $key]) }}"
               class="filter-pill {{ request('status') === $key ? 'active' : '' }}">
                {{ $label }} <span class="count">({{ $counts[$key] ?? 0 }})</span>
            </a>
        @endforeach
    </div>

    <form method="GET" class="search-toolbar">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search institution, contact, or email…">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
        @if(request('search'))
            <a href="{{ route('admin.partnerships.applications.index', request()->only('status')) }}"
               class="btn btn-secondary">Clear</a>
        @endif
    </form>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Institution</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                    <tr>
                        <td>
                            <span class="cell-primary">{{ $app->institution_name }}</span>
                            @if($app->institution_type)
                                <span class="cell-sub">{{ ucfirst(str_replace('_', ' ', $app->institution_type)) }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="cell-primary">{{ $app->contact_person_name }}</span>
                            <span class="cell-sub">{{ $app->contact_email }}</span>
                        </td>
                        <td>
                            {{ $app->country ?? '—' }}
                            @if($app->city)
                                <span class="cell-sub">{{ $app->city }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $app->status }}">{{ $app->status_label }}</span>
                        </td>
                        <td>{{ $app->created_at->format('M d, Y') }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.partnerships.applications.show', $app) }}" class="btn btn-sm btn-info">
                                <i class="fa-solid fa-eye"></i> Review
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div><i class="fa-solid fa-inbox"></i></div>
                                <p>No applications found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($applications->hasPages())
        <div class="pagination-wrap">
            {{ $applications->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@include('admin.partnerships.partials.crud-styles')
@endsection
