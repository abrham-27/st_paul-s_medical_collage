{{-- Roles and Responsibility Index Dashboard --}}
@extends('admin.layouts.app')

@section('content')
<div class="admin-page admin-research-page">
    <div class="page-header">
        <h1 class="page-title">Roles & Responsibility</h1>
        <p class="page-subtitle">Manage all content sections</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="sections-grid">
        <div class="section-card">
            <h3>Hero Section</h3>
            <p>Title, subtitle, banner image, CTA</p>
            <a href="{{ route('admin.research.roles-responsibility.hero.edit') }}" class="btn btn-primary btn-sm">Edit</a>
        </div>

        <div class="section-card">
            <h3>Overview</h3>
            <p>Rich text content</p>
            <a href="{{ route('admin.research.roles-responsibility.overview.edit') }}" class="btn btn-primary btn-sm">Edit</a>
        </div>

        <div class="section-card">
            <h3>Categories</h3>
            <p>Manage responsibility categories</p>
            <a href="{{ route('admin.research.roles-responsibility.categories.index') }}" class="btn btn-primary btn-sm">Manage</a>
        </div>

        <div class="section-card">
            <h3>Processes</h3>
            <p>Workflow steps</p>
            <a href="{{ route('admin.research.roles-responsibility.processes.index') }}" class="btn btn-primary btn-sm">Manage</a>
        </div>

        <div class="section-card">
            <h3>Policies</h3>
            <p>Documents & guidelines</p>
            <a href="{{ route('admin.research.roles-responsibility.policies.index') }}" class="btn btn-primary btn-sm">Manage</a>
        </div>

        <div class="section-card">
            <h3>FAQs</h3>
            <p>Questions & answers</p>
            <a href="{{ route('admin.research.roles-responsibility.faqs.index') }}" class="btn btn-primary btn-sm">Manage</a>
        </div>

        <div class="section-card">
            <h3>Statistics</h3>
            <p>Highlight cards</p>
            <a href="{{ route('admin.research.roles-responsibility.statistics.index') }}" class="btn btn-primary btn-sm">Manage</a>
        </div>

        <div class="section-card">
            <h3>Contact</h3>
            <p>Office information</p>
            <a href="{{ route('admin.research.roles-responsibility.contact.edit') }}" class="btn btn-primary btn-sm">Edit</a>
        </div>
    </div>
</div>

<style>
.sections-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}
.section-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.section-card h3 {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
    color: #0a1628;
}
.section-card p {
    margin: 0 0 1rem 0;
    color: #666;
    font-size: 0.9rem;
}
.btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #0066cc;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    font-weight: 600;
}
.btn:hover {
    background: #0052a3;
}
.page-title {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 700;
}
.page-subtitle {
    margin: 0.5rem 0 0 0;
    color: #666;
}
</style>
@endsection
