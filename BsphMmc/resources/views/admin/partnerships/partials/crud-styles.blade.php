<style>
.admin-content {
    background: #fff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.75rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.content-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.35rem;
    line-height: 1.2;
}

.breadcrumb {
    color: #64748b;
    font-size: 0.9rem;
    margin: 0;
}

.breadcrumb a {
    color: #2563eb;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.alert-success {
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
    padding: 0.875rem 1rem;
    border-radius: 8px;
    margin-bottom: 1.25rem;
    font-size: 0.9rem;
}

/* Filter tabs */
.filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1.25rem;
    padding: 0.5rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
}

.filter-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    background: transparent;
    color: #475569;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: background 0.15s, color 0.15s;
}

.filter-pill:hover {
    background: #e2e8f0;
    color: #1e293b;
}

.filter-pill.active {
    background: #2563eb;
    color: #fff;
    box-shadow: 0 1px 2px rgba(37, 99, 235, 0.3);
}

.filter-pill .count {
    font-size: 0.75rem;
    opacity: 0.85;
}

/* Search */
.search-toolbar {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.search-toolbar input[type="text"] {
    flex: 1;
    min-width: 200px;
    padding: 0.65rem 1rem;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 0.9rem;
    background: #fff;
}

.search-toolbar input[type="text"]:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

/* Table */
.table-container {
    overflow-x: auto;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    margin-bottom: 1.5rem;
}

.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.table thead {
    background: #f1f5f9;
}

.table th {
    padding: 0.875rem 1rem;
    text-align: left;
    font-weight: 600;
    color: #334155;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    border-bottom: 2px solid #e2e8f0;
    white-space: nowrap;
}

.table td {
    padding: 1rem;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
    vertical-align: middle;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.table tbody tr:hover {
    background: #f8fafc;
}

.table .cell-primary {
    font-weight: 600;
    color: #1e293b;
}

.table .cell-sub {
    display: block;
    font-size: 0.8rem;
    color: #64748b;
    margin-top: 0.2rem;
    font-weight: 400;
}

.table .actions {
    white-space: nowrap;
}

/* Badges */
.badge {
    display: inline-block;
    padding: 0.3rem 0.65rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: capitalize;
}

.badge-pending { background: #fef3c7; color: #92400e; }
.badge-under_review { background: #dbeafe; color: #1e40af; }
.badge-approved { background: #d1fae5; color: #065f46; }
.badge-declined { background: #fee2e2; color: #991b1b; }

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
    padding: 0.55rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: background 0.15s, transform 0.1s;
    font-size: 0.875rem;
    font-family: inherit;
    line-height: 1.2;
}

.btn:hover { transform: translateY(-1px); }
.btn:active { transform: translateY(0); }

.btn-primary { background: #2563eb; color: #fff; }
.btn-primary:hover { background: #1d4ed8; }

.btn-secondary {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
}

.btn-secondary:hover { background: #e2e8f0; }

.btn-info { background: #0ea5e9; color: #fff; }
.btn-info:hover { background: #0284c7; }

.btn-success { background: #059669; color: #fff; }
.btn-success:hover { background: #047857; }

.btn-danger { background: #dc2626; color: #fff; }
.btn-danger:hover { background: #b91c1c; }

.btn-sm {
    padding: 0.4rem 0.75rem;
    font-size: 0.8rem;
}

.btn-outline {
    background: #fff;
    color: #2563eb;
    border: 1px solid #2563eb;
}

.btn-outline:hover {
    background: #eff6ff;
}

/* Pagination (Bootstrap 5) */
.pagination-wrap {
    display: flex;
    justify-content: center;
    margin-top: 0.5rem;
}

.pagination-wrap .pagination {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination-wrap .page-link {
    padding: 0.45rem 0.85rem;
    border-radius: 6px;
    font-size: 0.875rem;
    text-decoration: none;
    border: 1px solid #e2e8f0;
    color: #475569;
    background: #fff;
    display: block;
}

.pagination-wrap .page-link:hover {
    background: #f1f5f9;
    color: #1e293b;
}

.pagination-wrap .page-item.active .page-link {
    background: #2563eb;
    color: #fff;
    border-color: #2563eb;
}

.pagination-wrap .page-item.disabled .page-link {
    color: #94a3b8;
    background: #f8fafc;
    cursor: not-allowed;
}

.text-center { text-align: center; }
.text-muted { color: #64748b; }

.empty-state {
    padding: 3rem 1rem;
    text-align: center;
    color: #64748b;
}

.empty-state i {
    font-size: 2.5rem;
    color: #cbd5e1;
    margin-bottom: 0.75rem;
}

/* Detail / show page */
.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
    margin-bottom: 1.25rem;
}

.card-panel {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 1.25rem 1.5rem;
}

.card-panel h3 {
    margin: 0 0 1rem;
    font-size: 1rem;
    font-weight: 700;
    color: #1e293b;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f1f5f9;
}

.card-panel h3 i {
    margin-right: 0.4rem;
    color: #2563eb;
}

.detail-list {
    display: grid;
    grid-template-columns: 130px 1fr;
    gap: 0.65rem 1rem;
    margin: 0;
}

.detail-list dt {
    font-weight: 600;
    color: #64748b;
    margin: 0;
    font-size: 0.85rem;
}

.detail-list dd {
    margin: 0;
    color: #1e293b;
    font-size: 0.9rem;
    word-break: break-word;
}

.detail-list dd a {
    color: #2563eb;
}

.text-block {
    white-space: pre-wrap;
    line-height: 1.6;
    color: #334155;
    margin: 0;
    font-size: 0.9rem;
}

.manage-panel {
    margin-top: 0.5rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #334155;
    font-size: 0.875rem;
    margin-bottom: 0.4rem;
}

.form-control {
    width: 100%;
    padding: 0.65rem 0.85rem;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 0.9rem;
    font-family: inherit;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.action-row {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    padding-top: 0.5rem;
    border-top: 1px solid #f1f5f9;
    margin-top: 0.5rem;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    margin-top: 1.5rem;
    color: #2563eb;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
}

.back-link:hover {
    text-decoration: underline;
}

.header-badge {
    align-self: center;
}

@media (max-width: 768px) {
    .admin-content { padding: 1.25rem; }
    .detail-grid { grid-template-columns: 1fr; }
    .detail-list { grid-template-columns: 1fr; }
    .detail-list dt { margin-bottom: -0.35rem; }
}
</style>
