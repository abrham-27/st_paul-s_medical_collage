@extends('admin.layouts.app')

@section('title', 'Manage ' . ucfirst($type) . ' Project')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>
                        @if($type === 'irb')
                            ⚖️ Function of IRB
                        @elseif($type === 'idream')
                            🔬 iDream Lab
                        @else
                            📊 HDSS
                        @endif
                    </h2>
                    <p class="text-muted">Manage all content sections for this project</p>
                </div>
                <a href="{{ route('admin.research.projects-v2.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Projects
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab">
                <i class="fas fa-info-circle"></i> Basic Info
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="functions-tab" data-bs-toggle="tab" data-bs-target="#functions" type="button" role="tab">
                <i class="fas fa-cogs"></i> Functions
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="workflow-tab" data-bs-toggle="tab" data-bs-target="#workflow" type="button" role="tab">
                <i class="fas fa-tasks"></i> Workflow
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="resources-tab" data-bs-toggle="tab" data-bs-target="#resources" type="button" role="tab">
                <i class="fas fa-file-download"></i> Resources
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="statistics-tab" data-bs-toggle="tab" data-bs-target="#statistics" type="button" role="tab">
                <i class="fas fa-chart-bar"></i> Statistics
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="team-tab" data-bs-toggle="tab" data-bs-target="#team" type="button" role="tab">
                <i class="fas fa-users"></i> Team
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab">
                <i class="fas fa-question-circle"></i> FAQ
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="projectTabsContent">
        <!-- Basic Info Tab -->
        <div class="tab-pane fade show active" id="basic" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Project Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.research.projects-v2.basic-info.update', $type) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Project Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $project->subtitle }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="overview" class="form-label">Overview Content</label>
                            <textarea class="form-control" id="overview" name="overview" rows="8">{{ $project->overview }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="hero_image" class="form-label">Hero Image</label>
                            <input type="file" class="form-control" id="hero_image" name="hero_image" accept="image/*">
                            @if($project->hero_image)
                                <small class="text-muted">Current: {{ basename($project->hero_image) }}</small>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Contact Email</label>
                                    <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ $project->contact_email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact_phone" class="form-label">Contact Phone</label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ $project->contact_phone }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="contact_address" class="form-label">Contact Address</label>
                            <textarea class="form-control" id="contact_address" name="contact_address" rows="3">{{ $project->contact_address }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="office_hours" class="form-label">Office Hours</label>
                            <input type="text" class="form-control" id="office_hours" name="office_hours" value="{{ $project->office_hours }}" placeholder="e.g., Monday - Friday: 8:00 AM - 5:00 PM">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Basic Info
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Functions Tab -->
        <div class="tab-pane fade" id="functions" role="tabpanel">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Key Functions & Services</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addFunctionModal">
                        <i class="fas fa-plus"></i> Add Function
                    </button>
                </div>
                <div class="card-body">
                    @if($project->functions && $project->functions->count() > 0)
                        <div class="row">
                            @foreach($project->functions as $function)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <span style="font-size: 1.5rem;">{{ $function->icon ?? '🔧' }}</span>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="editFunction({{ $function->id }})">Edit</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteFunction({{ $function->id }})">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <h6>{{ $function->title }}</h6>
                                            <p class="text-muted small">{{ Str::limit($function->description, 100) }}</p>
                                            @if($function->features && count($function->features) > 0)
                                                <small class="text-info">{{ count($function->features) }} features</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-cogs fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No functions added yet. Click "Add Function" to get started.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Workflow Tab -->
        <div class="tab-pane fade" id="workflow" role="tabpanel">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Process Workflow</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addWorkflowModal">
                        <i class="fas fa-plus"></i> Add Step
                    </button>
                </div>
                <div class="card-body">
                    @if($project->workflows && $project->workflows->count() > 0)
                        <div class="timeline">
                            @foreach($project->workflows->sortBy('step_number') as $workflow)
                                <div class="timeline-item mb-4">
                                    <div class="d-flex">
                                        <div class="timeline-marker me-3">
                                            <span class="badge bg-primary rounded-pill">{{ $workflow->step_number }}</span>
                                        </div>
                                        <div class="timeline-content flex-grow-1">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-2">{{ $workflow->icon ?? '📋' }}</span>
                                                            <h6 class="mb-0">{{ $workflow->title }}</h6>
                                                        </div>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                Actions
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#" onclick="editWorkflow({{ $workflow->id }})">Edit</a></li>
                                                                <li><a class="dropdown-item text-danger" href="#" onclick="deleteWorkflow({{ $workflow->id }})">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <p class="text-muted small mb-2">{{ Str::limit($workflow->description, 150) }}</p>
                                                    @if($workflow->estimated_time)
                                                        <small class="text-info"><i class="fas fa-clock"></i> {{ $workflow->estimated_time }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No workflow steps added yet. Click "Add Step" to get started.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Resources Tab -->
        <div class="tab-pane fade" id="resources" role="tabpanel">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Resources & Documents</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addResourceModal">
                        <i class="fas fa-plus"></i> Add Resource
                    </button>
                </div>
                <div class="card-body">
                    @if($project->resources && $project->resources->count() > 0)
                        <div class="row">
                            @foreach($project->resources as $resource)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <span style="font-size: 1.5rem;">{{ $resource->icon ?? '📄' }}</span>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="editResource({{ $resource->id }})">Edit</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteResource({{ $resource->id }})">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <h6>{{ $resource->title }}</h6>
                                            @if($resource->description)
                                                <p class="text-muted small">{{ Str::limit($resource->description, 100) }}</p>
                                            @endif
                                            @if($resource->file_size)
                                                <small class="text-info">{{ $resource->file_size }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-file-download fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No resources added yet. Click "Add Resource" to get started.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Statistics Tab -->
        <div class="tab-pane fade" id="statistics" role="tabpanel">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Key Statistics</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStatisticModal">
                        <i class="fas fa-plus"></i> Add Statistic
                    </button>
                </div>
                <div class="card-body">
                    @if($project->statistics && $project->statistics->count() > 0)
                        <div class="row">
                            @foreach($project->statistics as $statistic)
                                <div class="col-md-4 mb-3">
                                    <div class="card border text-center">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-end mb-2">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="editStatistic({{ $statistic->id }})">Edit</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteStatistic({{ $statistic->id }})">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div style="font-size: 2rem; color: {{ $statistic->color ?? '#3b82f6' }};">{{ $statistic->icon ?? '📊' }}</div>
                                            <h4 class="text-primary">{{ $statistic->value }}</h4>
                                            <h6>{{ $statistic->label }}</h6>
                                            @if($statistic->description)
                                                <small class="text-muted">{{ $statistic->description }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No statistics added yet. Click "Add Statistic" to get started.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Team Tab -->
        <div class="tab-pane fade" id="team" role="tabpanel">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Team Members</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTeamMemberModal">
                        <i class="fas fa-plus"></i> Add Member
                    </button>
                </div>
                <div class="card-body">
                    @if($project->teamMembers && $project->teamMembers->count() > 0)
                        <div class="row">
                            @foreach($project->teamMembers as $member)
                                <div class="col-md-4 mb-3">
                                    <div class="card border">
                                        <div class="card-body text-center">
                                            <div class="d-flex justify-content-end mb-2">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="editTeamMember({{ $member->id }})">Edit</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteTeamMember({{ $member->id }})">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @if($member->image)
                                                <img src="{{ asset('storage/' . $member->image) }}" class="rounded-circle mb-2" width="60" height="60" style="object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user text-muted"></i>
                                                </div>
                                            @endif
                                            <h6>{{ $member->name }}</h6>
                                            <p class="text-primary small">{{ $member->role }}</p>
                                            @if($member->email || $member->phone)
                                                <small class="text-muted">
                                                    @if($member->email)
                                                        <i class="fas fa-envelope"></i> {{ $member->email }}<br>
                                                    @endif
                                                    @if($member->phone)
                                                        <i class="fas fa-phone"></i> {{ $member->phone }}
                                                    @endif
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No team members added yet. Click "Add Member" to get started.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- FAQ Tab -->
        <div class="tab-pane fade" id="faq" role="tabpanel">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Frequently Asked Questions</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                        <i class="fas fa-plus"></i> Add FAQ
                    </button>
                </div>
                <div class="card-body">
                    @if($project->faqs && $project->faqs->count() > 0)
                        <div class="accordion" id="faqAccordion">
                            @foreach($project->faqs as $index => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq{{ $faq->id }}">
                                        <button class="accordion-button collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}">
                                            <span>{{ $faq->question }}</span>
                                            <div class="dropdown ms-2" onclick="event.stopPropagation();">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" onclick="editFaq({{ $faq->id }})">Edit</a></li>
                                                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteFaq({{ $faq->id }})">Delete</a></li>
                                                </ul>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No FAQs added yet. Click "Add FAQ" to get started.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Function Modal -->
<div class="modal fade" id="addFunctionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.research.projects-v2.functions.store', $type) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Function</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="function_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="function_title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="function_description" class="form-label">Description</label>
                        <textarea class="form-control" id="function_description" name="description" rows="4" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="function_icon" class="form-label">Icon (Emoji)</label>
                                <input type="text" class="form-control" id="function_icon" name="icon" placeholder="🔧">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="function_order" class="form-label">Order</label>
                                <input type="number" class="form-control" id="function_order" name="order_index" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Features (one per line)</label>
                        <textarea class="form-control" name="features_text" rows="4" placeholder="Feature 1&#10;Feature 2&#10;Feature 3"></textarea>
                        <small class="text-muted">Enter each feature on a new line</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Function</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Add this to handle features text conversion
document.querySelector('form').addEventListener('submit', function(e) {
    const featuresText = document.querySelector('textarea[name="features_text"]').value;
    if (featuresText) {
        const features = featuresText.split('\n').filter(f => f.trim());
        // Create hidden input for features array
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'features';
        hiddenInput.value = JSON.stringify(features);
        this.appendChild(hiddenInput);
    }
});

// Placeholder functions for edit/delete actions
function editFunction(id) { alert('Edit function ' + id + ' - Feature coming soon'); }
function deleteFunction(id) { if(confirm('Delete this function?')) { /* implement delete */ } }
function editWorkflow(id) { alert('Edit workflow ' + id + ' - Feature coming soon'); }
function deleteWorkflow(id) { if(confirm('Delete this workflow step?')) { /* implement delete */ } }
function editResource(id) { alert('Edit resource ' + id + ' - Feature coming soon'); }
function deleteResource(id) { if(confirm('Delete this resource?')) { /* implement delete */ } }
function editStatistic(id) { alert('Edit statistic ' + id + ' - Feature coming soon'); }
function deleteStatistic(id) { if(confirm('Delete this statistic?')) { /* implement delete */ } }
function editTeamMember(id) { alert('Edit team member ' + id + ' - Feature coming soon'); }
function deleteTeamMember(id) { if(confirm('Delete this team member?')) { /* implement delete */ } }
function editFaq(id) { alert('Edit FAQ ' + id + ' - Feature coming soon'); }
function deleteFaq(id) { if(confirm('Delete this FAQ?')) { /* implement delete */ } }
</script>
@endsection