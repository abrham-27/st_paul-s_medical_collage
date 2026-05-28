# 🚀 Research Projects - Quick Start Guide

## 📋 Prerequisites

Before starting, ensure you have:
- Laravel 9+ environment running
- Node.js 16+ and npm installed
- MySQL/PostgreSQL database configured
- PHP 8.0+ with required extensions

## ⚡ 5-Minute Deployment

### Step 1: Backend Setup (2 minutes)

```bash
# Navigate to Laravel backend
cd BsphMmc

# Run the new migration
php artisan migrate

# Seed sample data
php artisan db:seed --class=ResearchProjectsSeeder

# Clear cache (optional but recommended)
php artisan config:clear
php artisan route:clear
```

### Step 2: Frontend Build (2 minutes)

```bash
# Navigate to React frontend
cd ../sphMmc

# Install dependencies (if not already done)
npm install

# Build for production
npm run build

# Or run in development mode
npm run dev
```

### Step 3: Verification (1 minute)

```bash
# Test API endpoints
curl http://localhost:8000/api/research/projects/irb
curl http://localhost:8000/api/research/projects/idream  
curl http://localhost:8000/api/research/projects/hdss
```

## 🔧 Detailed Implementation Steps

### Database Migration

The migration creates 6 new tables:

```bash
php artisan migrate
```

**Tables Created:**
- `research_project_team_members` - Staff and committee members
- `research_project_faqs` - Frequently asked questions
- `research_project_resources` - Documents and downloadable files
- `research_project_statistics` - Key metrics and counters
- `research_project_workflow_steps` - Process timelines
- `research_project_functions` - Services and key functions

### Data Seeding

```bash
php artisan db:seed --class=ResearchProjectsSeeder
```

**Sample Data Includes:**
- Complete IRB project with legal framework, structure, and training info
- iDream Lab with research focus areas and innovation details
- HDSS with surveillance activities and data collection info
- Team members for each project
- FAQ sections with common questions
- Resources and downloadable documents
- Statistics and key metrics
- Workflow steps and processes

### Frontend Components

The new component structure:

```
src/research/
├── Projects.tsx                    # Main container (refactored)
├── ResearchProjectsHero.tsx        # Hero section
├── ResearchProjectsOverview.tsx    # Overview content
├── ResearchProjectsFunctions.tsx   # Services/functions
├── ResearchProjectsTimeline.tsx    # Workflow timeline
├── ResearchProjectsResources.tsx   # Documents/resources
├── ResearchProjectsStatistics.tsx  # Metrics/counters
├── ResearchProjectsTeam.tsx        # Team members
├── ResearchProjectsFAQ.tsx         # FAQ accordion
├── ResearchProjectsContact.tsx     # Contact information
└── ResearchProjectsShared.css      # Shared styling
```

## 🌐 API Endpoints Overview

### Public Endpoints (No Authentication Required)

#### Get IRB Project
```bash
GET /api/research/projects/irb
```
**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "project_type": "irb",
    "title": "Institutional Review Board",
    "content": "<p>IRB overview content...</p>",
    "image": "research-projects/irb-hero.jpg",
    "team_members": [...],
    "faqs": [...],
    "resources": [...],
    "statistics": [...],
    "workflow_steps": [...],
    "functions": [...]
  }
}
```

#### Get iDream Lab Project
```bash
GET /api/research/projects/idream
```

#### Get HDSS Project  
```bash
GET /api/research/projects/hdss
```

#### Get All Projects
```bash
GET /api/research/projects/all
```

### Admin Endpoints (Authentication Required)

#### Update Project Content
```bash
POST /api/research/projects/{type}
Content-Type: application/json

{
  "title": "Updated Title",
  "content": "<p>Updated content...</p>",
  "image": "new-image.jpg"
}
```

#### Add Team Member
```bash
POST /api/research/projects/{type}/team-members
Content-Type: application/json

{
  "name": "Dr. John Smith",
  "role": "Committee Chair", 
  "bio": "Expert in medical ethics...",
  "image": "team/john-smith.jpg",
  "email": "john.smith@sphmmc.edu.et",
  "order_index": 1
}
```

#### Add FAQ
```bash
POST /api/research/projects/{type}/faqs
Content-Type: application/json

{
  "question": "How long does review take?",
  "answer": "Typically 2-4 weeks for initial review...",
  "order_index": 1
}
```

#### Add Resource
```bash
POST /api/research/projects/{type}/resources
Content-Type: application/json

{
  "title": "IRB Application Form",
  "description": "Complete this form to submit...",
  "file_path": "documents/irb-application.pdf",
  "file_type": "pdf",
  "file_size": "245KB",
  "order_index": 1
}
```

#### Add Statistic
```bash
POST /api/research/projects/{type}/statistics
Content-Type: application/json

{
  "label": "Protocols Reviewed",
  "value": "150+",
  "description": "Research protocols reviewed this year",
  "icon": "📋",
  "order_index": 1
}
```

#### Add Workflow Step
```bash
POST /api/research/projects/{type}/workflow-steps
Content-Type: application/json

{
  "title": "Submit Application",
  "description": "Complete and submit IRB application form",
  "step_number": 1,
  "icon": "📝",
  "estimated_time": "1-2 days"
}
```

#### Add Function
```bash
POST /api/research/projects/{type}/functions
Content-Type: application/json

{
  "title": "Protocol Review",
  "description": "Comprehensive review of research protocols",
  "icon": "🔍",
  "features": ["Ethical assessment", "Risk evaluation", "Compliance check"],
  "order_index": 1
}
```

## 🧪 Testing the Implementation

### 1. Backend API Testing

```bash
# Test all endpoints
curl -X GET http://localhost:8000/api/research/projects/irb | jq
curl -X GET http://localhost:8000/api/research/projects/idream | jq  
curl -X GET http://localhost:8000/api/research/projects/hdss | jq
curl -X GET http://localhost:8000/api/research/projects/all | jq
```

### 2. Frontend Testing

1. Navigate to `http://localhost:3000/research/projects`
2. Verify all 3 tabs (IRB, iDream Lab, HDSS) load correctly
3. Check each of the 9 sections renders properly:
   - Hero section with title and description
   - Overview with rich content
   - Functions/services cards
   - Timeline/workflow steps
   - Resources/documents list
   - Statistics with animated counters
   - Team member profiles
   - FAQ accordion
   - Contact information

### 3. Responsive Testing

Test on different screen sizes:
- **Mobile** (320px-768px): Single column layout
- **Tablet** (768px-1024px): Two column layout  
- **Desktop** (1024px+): Multi-column layout

### 4. Data Validation

Verify sample data is loaded:

```bash
# Check database tables
php artisan tinker

# In tinker console:
App\Models\ResearchProject::count()
App\Models\ResearchProjectTeamMember::count()
App\Models\ResearchProjectFAQ::count()
App\Models\ResearchProjectResource::count()
App\Models\ResearchProjectStatistic::count()
App\Models\ResearchProjectWorkflowStep::count()
App\Models\ResearchProjectFunction::count()
```

## 🔧 Troubleshooting

### Migration Issues

**Problem**: Migration fails with foreign key constraint error
```bash
# Solution: Run migrations in order
php artisan migrate:rollback
php artisan migrate
```

**Problem**: Table already exists error
```bash
# Solution: Check migration status
php artisan migrate:status
php artisan migrate --force
```

### API Issues

**Problem**: 404 Not Found on API endpoints
```bash
# Solution: Clear route cache
php artisan route:clear
php artisan route:cache
```

**Problem**: CORS errors in frontend
```bash
# Solution: Check CORS configuration
# Verify config/cors.php allows your frontend domain
```

### Frontend Issues

**Problem**: Components not rendering
```bash
# Solution: Check browser console for errors
# Verify API endpoints are responding
# Check network tab for failed requests
```

**Problem**: Styling issues
```bash
# Solution: Verify CSS files are loaded
# Check for conflicting styles
# Clear browser cache
```

### Data Issues

**Problem**: No data showing in frontend
```bash
# Solution: Verify seeder ran successfully
php artisan db:seed --class=ResearchProjectsSeeder --force

# Check API responses
curl http://localhost:8000/api/research/projects/irb
```

**Problem**: Images not loading
```bash
# Solution: Check storage link
php artisan storage:link

# Verify image paths in database
# Check file permissions
```

## 📊 Data Management Examples

### Adding Custom Content

```php
// Add custom IRB team member
$irb = ResearchProject::where('project_type', 'irb')->first();
$irb->teamMembers()->create([
    'name' => 'Dr. Sarah Johnson',
    'role' => 'Ethics Specialist',
    'bio' => 'Specializes in research ethics and compliance',
    'email' => 'sarah.johnson@sphmmc.edu.et',
    'order_index' => 10
]);

// Add custom FAQ
$irb->faqs()->create([
    'question' => 'What documents are required?',
    'answer' => 'You need to submit the research protocol, informed consent forms, and investigator qualifications.',
    'order_index' => 10
]);
```

### Updating Existing Content

```php
// Update project title and content
$irb = ResearchProject::where('project_type', 'irb')->first();
$irb->update([
    'title' => 'Updated IRB Title',
    'content' => '<p>Updated IRB content with <strong>rich formatting</strong></p>'
]);

// Update team member
$member = ResearchProjectTeamMember::find(1);
$member->update([
    'role' => 'Senior Ethics Advisor',
    'bio' => 'Updated biography with new achievements'
]);
```

## 🎯 Performance Optimization

### Backend Optimization

```php
// Enable query caching in ResearchProjectsController
public function irb()
{
    $irb = Cache::remember('research_project_irb', 3600, function () {
        return ResearchProject::with([
            'teamMembers',
            'faqs', 
            'resources',
            'statistics',
            'workflowSteps',
            'functions'
        ])->where('project_type', 'irb')->first();
    });
    
    return response()->json(['success' => true, 'data' => $irb]);
}
```

### Frontend Optimization

```typescript
// Implement lazy loading for images
const LazyImage = ({ src, alt, className }) => {
  const [loaded, setLoaded] = useState(false);
  
  return (
    <img
      src={src}
      alt={alt}
      className={className}
      loading="lazy"
      onLoad={() => setLoaded(true)}
      style={{ opacity: loaded ? 1 : 0.5 }}
    />
  );
};
```

## 🔒 Security Considerations

### API Security

```php
// Add rate limiting to routes
Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/research/projects/{type}', [ResearchProjectsController::class, 'show']);
});

// Add authentication to admin routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/research/projects/{type}', [ResearchProjectsController::class, 'update']);
});
```

### Input Validation

```php
// Add validation rules
public function update(Request $request, $type)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|string|max:500'
    ]);
    
    // Process update...
}
```

## 📈 Monitoring & Analytics

### Performance Monitoring

```php
// Add logging to track API usage
Log::info('Research project accessed', [
    'type' => $type,
    'user_agent' => $request->userAgent(),
    'ip' => $request->ip()
]);
```

### Error Tracking

```php
// Add error handling
try {
    $project = ResearchProject::getByType($type);
} catch (Exception $e) {
    Log::error('Failed to fetch research project', [
        'type' => $type,
        'error' => $e->getMessage()
    ]);
    
    return response()->json([
        'success' => false,
        'message' => 'Unable to fetch project data'
    ], 500);
}
```

## ✅ Deployment Checklist

Before going live:

- [ ] Database migration completed successfully
- [ ] Sample data seeded (or custom data added)
- [ ] All API endpoints responding correctly
- [ ] Frontend builds without errors
- [ ] All 9 sections render properly
- [ ] Responsive design tested on multiple devices
- [ ] Images and media files accessible
- [ ] Error handling working correctly
- [ ] Performance optimizations applied
- [ ] Security measures implemented
- [ ] Backup of existing data created
- [ ] Documentation reviewed and updated

## 🎊 Success!

If all steps completed successfully, you now have:

✅ **Modern Medical Design** - Professional institutional appearance  
✅ **9-Section Layout** - Comprehensive content structure  
✅ **Dynamic Content** - All data from backend APIs  
✅ **Responsive Design** - Works on all devices  
✅ **Rich Content Support** - HTML, images, documents  
✅ **Team Management** - Staff profiles and roles  
✅ **Resource Management** - Downloadable documents  
✅ **FAQ System** - Expandable Q&A sections  
✅ **Statistics Display** - Animated counters  
✅ **Contact Information** - Complete office details  

## 📞 Next Steps

1. **Customize Content** - Add your specific research project data
2. **Configure Admin Access** - Set up authentication for content management
3. **Monitor Performance** - Track usage and optimize as needed
4. **Extend Features** - Add new sections or functionality as required

---

**Status**: ✅ DEPLOYED & READY  
**Support**: Reference IMPLEMENTATION_SUMMARY.md for technical details  
**API Docs**: See API_REFERENCE.md for complete endpoint documentation