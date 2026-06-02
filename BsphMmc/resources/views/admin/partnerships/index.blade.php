@extends('admin.layouts.app')

@section('title', 'Partnerships')
@section('page-title', 'Partnerships Management')

@section('content')
<div class="admin-dashboard">
    <div class="dashboard-header">
        <div>
            <h1>Partnerships Management</h1>
            <p class="text-muted">Manage institutional partnerships and collaborations</p>
        </div>
    </div>

    <div class="admin-grid">
        <!-- Overview Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🤝</div>
                <div class="stat-content">
                    <h3>{{ $partnerCount ?? 0 }}</h3>
                    <p>Total Partners</p>
                </div>
                <a href="{{ route('admin.partnerships.partners.index') }}" class="stat-link">View All →</a>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🌍</div>
                <div class="stat-content">
                    <h3>{{ $externalPartnerCount ?? 0 }}</h3>
                    <p>International Partners</p>
                </div>
                <a href="{{ route('admin.partnerships.partners.index', ['filter' => 'external']) }}" class="stat-link">View All →</a>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-content">
                    <h3>{{ $statisticsCount ?? 0 }}</h3>
                    <p>Statistics Cards</p>
                </div>
                <a href="{{ route('admin.partnerships.statistics.index') }}" class="stat-link">View All →</a>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📄</div>
                <div class="stat-content">
                    <h3>{{ $documentsCount ?? 0 }}</h3>
                    <p>Documents</p>
                </div>
                <a href="{{ route('admin.partnerships.documents.index') }}" class="stat-link">View All →</a>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <div class="stat-content">
                    <h3>{{ $applicationsCount ?? 0 }}</h3>
                    <p>Applications @if(($pendingApplicationsCount ?? 0) > 0)<span style="color:#2563eb;">({{ $pendingApplicationsCount }} pending)</span>@endif</p>
                </div>
                <a href="{{ route('admin.partnerships.applications.index') }}" class="stat-link">Review →</a>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="admin-section">
            <h2>Management Sections</h2>
            <div class="nav-grid">
                <div class="nav-card">
                    <div class="nav-icon">⚙️</div>
                    <h3>Overview</h3>
                    <p>Manage page title, banner, and introduction content</p>
                    <a href="{{ route('admin.partnerships.overview-edit') }}" class="btn btn-primary">Configure →</a>
                </div>

                <div class="nav-card">
                    <div class="nav-icon">🏢</div>
                    <h3>Partners</h3>
                    <p>Add, edit, and organize partner institutions</p>
                    <a href="{{ route('admin.partnerships.partners.index') }}" class="btn btn-primary">Manage →</a>
                </div>

                <div class="nav-card">
                    <div class="nav-icon">⭐</div>
                    <h3>Featured Partners</h3>
                    <p>Select and order featured partners for carousel</p>
                    <a href="{{ route('admin.partnerships.featured-partners.index') }}" class="btn btn-primary">Manage →</a>
                </div>

                <div class="nav-card">
                    <div class="nav-icon">📈</div>
                    <h3>Statistics</h3>
                    <p>Manage partnership statistics and metrics</p>
                    <a href="{{ route('admin.partnerships.statistics.index') }}" class="btn btn-primary">Manage →</a>
                </div>

                <div class="nav-card">
                    <div class="nav-icon">🎯</div>
                    <h3>Partnership Areas</h3>
                    <p>Define collaboration areas and focus domains</p>
                    <a href="{{ route('admin.partnerships.areas.index') }}" class="btn btn-primary">Manage →</a>
                </div>

                <div class="nav-card">
                    <div class="nav-icon">🏆</div>
                    <h3>Success Stories</h3>
                    <p>Showcase achievements and collaborations</p>
                    <a href="{{ route('admin.partnerships.success-stories.index') }}" class="btn btn-primary">Manage →</a>
                </div>

                <div class="nav-card">
                    <div class="nav-icon">📑</div>
                    <h3>Documents</h3>
                    <p>Upload MoUs, agreements, and reports</p>
                    <a href="{{ route('admin.partnerships.documents.index') }}" class="btn btn-primary">Manage →</a>
                </div>

                <div class="nav-card">
                    <div class="nav-icon">📞</div>
                    <h3>Contact Info</h3>
                    <p>Update office address and contact details</p>
                    <a href="{{ route('admin.partnerships.contact.edit') }}" class="btn btn-primary">Edit →</a>
                </div>

                <div class="nav-card">
                    <div class="nav-icon">📋</div>
                    <h3>Applications</h3>
                    <p>Review partnership requests from institutions
                        @if(($pendingApplicationsCount ?? 0) > 0)
                            <strong style="color:#2563eb;">({{ $pendingApplicationsCount }} pending)</strong>
                        @endif
                    </p>
                    <a href="{{ route('admin.partnerships.applications.index') }}" class="btn btn-primary">Review →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-dashboard {
    padding: 2rem;
    background: #f8f9fa;
    min-height: 100vh;
}

.dashboard-header {
    margin-bottom: 3rem;
}

.dashboard-header h1 {
    font-size: 2.5rem;
    color: #2D2020;
    margin-bottom: 0.5rem;
}

.dashboard-header .text-muted {
    color: #6B7280;
    font-size: 1.1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border-left: 4px solid #2563eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-icon {
    font-size: 2.5rem;
    margin-right: 1rem;
}

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #2563eb;
    margin: 0;
}

.stat-content p {
    color: #6B7280;
    margin: 0.5rem 0 0;
}

.admin-section {
    background: white;
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
}

.admin-section h2 {
    font-size: 1.8rem;
    color: #2D2020;
    margin-bottom: 2rem;
    margin-top: 0;
}

.nav-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.nav-card {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 10px;
    border: 2px solid #e2e8f0;
    transition: all 0.3s ease;
    text-align: center;
}

.nav-card:hover {
    border-color: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.1);
}

.nav-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.nav-card h3 {
    font-size: 1.3rem;
    color: #2D2020;
    margin-bottom: 0.75rem;
}

.nav-card p {
    color: #6B7280;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.btn {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #2563eb;
    color: white;
}

.btn-primary:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}

.text-muted {
    color: #6B7280;
}

@media (max-width: 768px) {
    .admin-dashboard {
        padding: 1rem;
    }

    .dashboard-header h1 {
        font-size: 1.8rem;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .nav-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
