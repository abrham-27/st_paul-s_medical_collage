@extends('admin.layouts.app')

@section('content')
<div class="admin-content">
    <div class="content-header">
        <div>
            <h1>Featured Partners</h1>
            <p class="breadcrumb"><a href="{{ route('admin.partnerships.index') }}">Partnerships</a> / Featured</p>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="featured-info">
        <p>Select up to 5 partners to feature in the carousel on the Partners page. Drag to reorder.</p>
    </div>

    <form action="{{ route('admin.partnerships.featured-partners.reorder') }}" method="POST" id="reorderForm">
        @csrf
        <div class="featured-list">
            @forelse($featuredPartners as $index => $featured)
                <div class="featured-item" draggable="true">
                    <div class="drag-handle">☰</div>
                    <div class="featured-content">
                        @if($featured->partner->logo_image_url)
                            <img src="{{ $featured->partner->logo_image_url }}" alt="{{ $featured->partner->name }}" class="featured-logo">
                        @else
                            <div class="featured-logo-placeholder">📷</div>
                        @endif
                        <div>
                            <h3>{{ $featured->partner->name }}</h3>
                            <p>{{ Str::limit($featured->partner->short_description, 60) }}</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.partnerships.featured-partners.remove', $featured->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                    <input type="hidden" class="partner-id" name="partners[{{ $index }}]" value="{{ $featured->partner_id }}">
                </div>
            @empty
                <div class="empty-state">
                    <p>No featured partners yet. Add partners to feature them in the carousel.</p>
                </div>
            @endforelse
        </div>

        @if($featuredPartners->count() > 0)
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Order</button>
            </div>
        @endif
    </form>

    <div class="add-featured-section">
        <h2>Add Featured Partner</h2>
        <p>Select a partner to add to the featured carousel (max 5):</p>
        
        @if($availablePartners->count() > 0)
            <div class="partners-select-grid">
                @foreach($availablePartners as $partner)
                    <form action="{{ route('admin.partnerships.featured-partners.store') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                        <button type="submit" class="partner-select-card">
                            @if($partner->logo_image_url)
                                <img src="{{ $partner->logo_image_url }}" alt="{{ $partner->name }}">
                            @else
                                <div class="placeholder">📷</div>
                            @endif
                            <h4>{{ $partner->name }}</h4>
                            <p>{{ $partner->category->name }}</p>
                        </button>
                    </form>
                @endforeach
            </div>
        @else
            <p class="text-muted">All partners are already featured or no partners exist.</p>
        @endif
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

.featured-info {
    background: #e7f3ff;
    border-left: 4px solid #2196F3;
    padding: 1rem;
    border-radius: 6px;
    margin-bottom: 2rem;
}

.featured-list {
    margin-bottom: 2rem;
}

.featured-item {
    background: #f8f9fa;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    cursor: move;
    transition: all 0.2s;
}

.featured-item:hover {
    border-color: #2563eb;
    box-shadow: 0 2px 10px rgba(37, 99, 235, 0.1);
}

.featured-item.drag-over {
    background: #fff3cd;
}

.drag-handle {
    font-size: 1.5rem;
    color: #6B7280;
    cursor: grab;
}

.featured-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex: 1;
    min-width: 0;
}

.featured-logo {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    flex-shrink: 0;
}

.featured-logo-placeholder {
    width: 80px;
    height: 80px;
    background: #e2e8f0;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    flex-shrink: 0;
}

.featured-content h3 {
    font-size: 1.1rem;
    color: #2D2020;
    margin: 0 0 0.5rem;
    word-break: break-word;
}

.featured-content p {
    color: #6B7280;
    font-size: 0.9rem;
    margin: 0;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: #6B7280;
}

.add-featured-section {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 10px;
    margin-top: 2rem;
}

.add-featured-section h2 {
    font-size: 1.5rem;
    color: #2D2020;
    margin-bottom: 1rem;
}

.partners-select-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.5rem;
}

.partner-select-card {
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 1rem;
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
    padding: 1rem;
}

.partner-select-card:hover {
    border-color: #2563eb;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
    transform: translateY(-2px);
}

.partner-select-card img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.partner-select-card .placeholder {
    width: 100%;
    height: 120px;
    background: #e2e8f0;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.partner-select-card h4 {
    font-size: 1rem;
    color: #2D2020;
    margin: 0 0 0.25rem;
}

.partner-select-card p {
    color: #6B7280;
    font-size: 0.85rem;
    margin: 0;
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

.btn-danger {
    background: #dc3545;
    color: white;
}

.btn-sm {
    padding: 0.35rem 0.75rem;
    font-size: 0.8rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.text-muted {
    color: #6B7280;
}

@media (max-width: 768px) {
    .featured-item {
        flex-direction: column;
        text-align: center;
    }

    .featured-content {
        flex-direction: column;
    }

    .partners-select-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const list = document.querySelector('.featured-list');
    let draggedElement = null;

    const items = document.querySelectorAll('.featured-item');
    items.forEach(item => {
        item.addEventListener('dragstart', function() {
            draggedElement = this;
            this.style.opacity = '0.5';
        });

        item.addEventListener('dragend', function() {
            this.style.opacity = '1';
            draggedElement = null;
        });

        item.addEventListener('dragover', function(e) {
            e.preventDefault();
            if (this !== draggedElement) {
                this.classList.add('drag-over');
            }
        });

        item.addEventListener('dragleave', function() {
            this.classList.remove('drag-over');
        });

        item.addEventListener('drop', function(e) {
            e.preventDefault();
            if (this !== draggedElement) {
                this.parentNode.insertBefore(draggedElement, this);
                updatePartnerIds();
            }
            this.classList.remove('drag-over');
        });
    });

    function updatePartnerIds() {
        document.querySelectorAll('.featured-item').forEach((item, index) => {
            const input = item.querySelector('.partner-id');
            if (input) {
                input.name = 'partners[' + index + ']';
            }
        });
    }
});
</script>
@endsection
