@extends('admin.layouts.app')

@section('title', 'Review Application')
@section('page-title', 'Review Application')

@section('content')
<div class="admin-content">
    <div class="content-header">
        <div>
            <h1>{{ $application->institution_name }}</h1>
            <p class="breadcrumb">
                <a href="{{ route('admin.partnerships.index') }}">Partnerships</a> /
                <a href="{{ route('admin.partnerships.applications.index') }}">Applications</a> /
                Review
            </p>
        </div>
        <span class="badge badge-{{ $application->status }} header-badge">{{ $application->status_label }}</span>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="detail-grid">
        <div class="card-panel">
            <h3><i class="fa-solid fa-building"></i> Institution</h3>
            <dl class="detail-list">
                <dt>Name</dt><dd>{{ $application->institution_name }}</dd>
                <dt>Type</dt><dd>{{ $application->institution_type ? ucfirst(str_replace('_', ' ', $application->institution_type)) : '—' }}</dd>
                <dt>Country</dt><dd>{{ $application->country ?? '—' }}</dd>
                <dt>City</dt><dd>{{ $application->city ?? '—' }}</dd>
                <dt>Website</dt>
                <dd>
                    @if($application->website_url)
                        <a href="{{ $application->website_url }}" target="_blank" rel="noopener noreferrer">
                            {{ $application->website_url }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:0.7rem;"></i>
                        </a>
                    @else — @endif
                </dd>
            </dl>
        </div>
        <div class="card-panel">
            <h3><i class="fa-solid fa-user"></i> Contact Person</h3>
            <dl class="detail-list">
                <dt>Name</dt><dd>{{ $application->contact_person_name }}</dd>
                <dt>Role</dt><dd>{{ $application->contact_role ?? '—' }}</dd>
                <dt>Email</dt>
                <dd>
                    <a href="mailto:{{ $application->contact_email }}">{{ $application->contact_email }}</a>
                </dd>
                <dt>Phone</dt><dd>{{ $application->contact_phone ?? '—' }}</dd>
                <dt>Submitted</dt><dd>{{ $application->created_at->format('F j, Y g:i A') }}</dd>
                @if($application->reviewed_at)
                    <dt>Last reviewed</dt><dd>{{ $application->reviewed_at->format('F j, Y g:i A') }}</dd>
                @endif
            </dl>
        </div>
    </div>

    @if($application->collaboration_interests)
        <div class="card-panel" style="margin-bottom:1.25rem;">
            <h3><i class="fa-solid fa-handshake"></i> Collaboration Interests</h3>
            <p class="text-block">{{ $application->collaboration_interests }}</p>
        </div>
    @endif

    @if($application->message)
        <div class="card-panel" style="margin-bottom:1.25rem;">
            <h3><i class="fa-solid fa-message"></i> Additional Message</h3>
            <p class="text-block">{{ $application->message }}</p>
        </div>
    @endif

    @if($application->admin_feedback)
        <div class="card-panel" style="margin-bottom:1.25rem;background:#f8fafc;">
            <h3><i class="fa-solid fa-comment-dots"></i> Previous Feedback</h3>
            <p class="text-block">{{ $application->admin_feedback }}</p>
        </div>
    @endif

    <div class="card-panel manage-panel">
        <h3><i class="fa-solid fa-sliders"></i> Manage Application</h3>
        <form action="{{ route('admin.partnerships.applications.update-status', $application) }}" method="POST" id="application-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    @foreach(\App\Models\PartnershipApplication::STATUSES as $key => $label)
                        <option value="{{ $key }}" {{ $application->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="admin_feedback">Feedback to applicant</label>
                <textarea name="admin_feedback" id="admin_feedback" class="form-control" rows="5"
                    placeholder="Optional notes, reasons for decline, or next steps to share with the institution…">{{ old('admin_feedback', $application->admin_feedback) }}</textarea>
            </div>
            <div class="action-row">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('status').value='under_review'; document.getElementById('application-form').submit();">
                    <i class="fa-solid fa-clock"></i> Mark Under Review
                </button>
                <button type="button" class="btn btn-success"
                    onclick="document.getElementById('status').value='approved'; document.getElementById('application-form').submit();">
                    <i class="fa-solid fa-check"></i> Approve
                </button>
                <button type="button" class="btn btn-danger"
                    onclick="if(confirm('Decline this application?')){ document.getElementById('status').value='declined'; document.getElementById('application-form').submit(); }">
                    <i class="fa-solid fa-xmark"></i> Decline
                </button>
                <button type="submit" class="btn btn-secondary">
                    <i class="fa-solid fa-floppy-disk"></i> Save changes
                </button>
            </div>
        </form>

        <form action="{{ route('admin.partnerships.applications.destroy', $application) }}" method="POST"
            style="margin-top:1.25rem;padding-top:1.25rem;border-top:1px solid #f1f5f9;"
            onsubmit="return confirm('Permanently delete this application?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fa-solid fa-trash"></i> Delete application
            </button>
        </form>
    </div>

    <a href="{{ route('admin.partnerships.applications.index') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Back to applications
    </a>
</div>

@include('admin.partnerships.partials.crud-styles')
@endsection
