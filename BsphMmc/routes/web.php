<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\AcademicController as AdminAcademicController;
use App\Http\Controllers\Admin\StatisticController as AdminStatisticController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\MissionVisionController;
use App\Http\Controllers\Admin\HealthTipsController;
use App\Http\Controllers\Admin\SpecializedCenterController;
use App\Http\Controllers\Admin\AcademicStaffController;
use App\Http\Controllers\Admin\NursingCmsController;
use App\Http\Controllers\Admin\PublicHealthCmsController;
use App\Http\Controllers\Admin\MedicineCmsController;
use App\Http\Controllers\Admin\AcademicsSchoolController;
use App\Http\Controllers\Admin\AcademicProjectController;
use App\Http\Controllers\Admin\IctCmsController;
use App\Http\Controllers\Admin\RegistrarCmsController;
use App\Http\Controllers\Admin\EditorUploadController;
use App\Http\Controllers\Admin\ResearchController as AdminResearchController;
use App\Http\Controllers\Admin\ResearchProjectsController as AdminResearchProjectsController;
use App\Http\Controllers\Admin\ResearchRolesResponsibilityAdminController;
use App\Http\Controllers\Admin\SchoolResearchPublicationController;
use App\Http\Controllers\Admin\HomeHeroController;
use App\Http\Controllers\Admin\HomeFeaturedController;
use App\Http\Controllers\Admin\PartnershipsCmsController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PartnershipStatisticController;
use App\Http\Controllers\Admin\PartnershipAreaController;
use App\Http\Controllers\Admin\SuccessStoryController;
use App\Http\Controllers\Admin\PartnershipDocumentController;
use App\Http\Controllers\Admin\PartnershipContactController;
use Illuminate\Support\Facades\Route;

// ─── Setup Route (for database table creation) ──────────────────────────────────
Route::get('/setup-tables', function () {
    try {
        require base_path('../setup_role_responsibility_tables.php');
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
})->name('setup.tables');

// ─── Public Routes ───────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ─── Admin Auth (guest/unauthenticated) ──────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// ─── Admin Protected Routes ──────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Redirect /admin to dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Academics — school dashboards
    Route::get('academics/{school}', [AcademicsSchoolController::class, 'show'])->name('academics.school');

    // Posts
    Route::resource('posts', AdminPostController::class)
        ->except(['show'])
        ->parameters(['posts' => 'post:id']);

    // Gallery
    Route::get('gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::post('gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::post('gallery/reorder', [AdminGalleryController::class, 'reorder'])->name('gallery.reorder');
    Route::put('gallery/{gallery}', [AdminGalleryController::class, 'update'])->name('gallery.update');
    Route::delete('gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

    // Home Content Management
    Route::prefix('content/home-content')->name('home-content.')->group(function () {
        // Hero Section (now multiple slides like featured)
        Route::get('hero', [HomeHeroController::class, 'index'])->name('hero.index');
        Route::get('hero/create', [HomeHeroController::class, 'create'])->name('hero.create');
        Route::post('hero', [HomeHeroController::class, 'store'])->name('hero.store');
        Route::get('hero/{hero}/edit', [HomeHeroController::class, 'edit'])->name('hero.edit');
        Route::put('hero/{hero}', [HomeHeroController::class, 'update'])->name('hero.update');
        Route::delete('hero/{hero}', [HomeHeroController::class, 'destroy'])->name('hero.destroy');
        Route::post('hero/reorder', [HomeHeroController::class, 'reorder'])->name('hero.reorder');

        // Featured Section
        Route::get('featured', [HomeFeaturedController::class, 'index'])->name('featured.index');
        Route::get('featured/create', [HomeFeaturedController::class, 'create'])->name('featured.create');
        Route::post('featured', [HomeFeaturedController::class, 'store'])->name('featured.store');
        Route::get('featured/{featured}/edit', [HomeFeaturedController::class, 'edit'])->name('featured.edit');
        Route::put('featured/{featured}', [HomeFeaturedController::class, 'update'])->name('featured.update');
        Route::delete('featured/{featured}', [HomeFeaturedController::class, 'destroy'])->name('featured.destroy');
        Route::post('featured/reorder', [HomeFeaturedController::class, 'reorder'])->name('featured.reorder');
    });

    // Academics
    Route::resource('academics', AdminAcademicController::class)->except(['show']);

    // Statistics
    Route::get('statistics', [AdminStatisticController::class, 'index'])->name('statistics.index');
    Route::post('statistics', [AdminStatisticController::class, 'store'])->name('statistics.store');
    Route::put('statistics/{statistic}', [AdminStatisticController::class, 'update'])->name('statistics.update');
    Route::delete('statistics/{statistic}', [AdminStatisticController::class, 'destroy'])->name('statistics.destroy');

    // Profile
    Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');

    // About Us (single CMS record)
    Route::post('editor/upload', [EditorUploadController::class, 'upload'])->name('editor.upload');

    Route::get('about-us', [AboutPageController::class, 'edit'])->name('about.edit');
    Route::put('about-us', [AboutPageController::class, 'update'])->name('about.update');

    // Leaders
    Route::resource('leaders', LeaderController::class)->except(['show']);

    // Mission / Vision / Values
    Route::get('mission-vision', [MissionVisionController::class, 'index'])->name('mission-vision.index');
    Route::put('mission-vision/mission', [MissionVisionController::class, 'updateMission'])->name('mission-vision.mission');
    Route::put('mission-vision/vision', [MissionVisionController::class, 'updateVision'])->name('mission-vision.vision');
    Route::post('mission-vision/values', [MissionVisionController::class, 'storeValue'])->name('mission-vision.values.store');
    Route::put('mission-vision/values/{value}', [MissionVisionController::class, 'updateValue'])->name('mission-vision.values.update');
    Route::delete('mission-vision/values/{value}', [MissionVisionController::class, 'destroyValue'])->name('mission-vision.values.destroy');

    // Health Tips — Categories
    Route::get('health-tips', [HealthTipsController::class, 'index'])->name('health-tips.index');
    Route::post('health-tips/categories', [HealthTipsController::class, 'storeCategory'])->name('health-tips.categories.store');
    Route::put('health-tips/categories/{category}', [HealthTipsController::class, 'updateCategory'])->name('health-tips.categories.update');
    Route::delete('health-tips/categories/{category}', [HealthTipsController::class, 'destroyCategory'])->name('health-tips.categories.destroy');
    // Health Tips — Diseases
    Route::get('health-tips/categories/{category}/diseases', [HealthTipsController::class, 'diseases'])->name('health-tips.diseases');
    Route::post('health-tips/categories/{category}/diseases', [HealthTipsController::class, 'storeDisease'])->name('health-tips.diseases.store');
    Route::put('health-tips/categories/{category}/diseases/{disease}', [HealthTipsController::class, 'updateDisease'])->name('health-tips.diseases.update');
    Route::delete('health-tips/categories/{category}/diseases/{disease}', [HealthTipsController::class, 'destroyDisease'])->name('health-tips.diseases.destroy');

    // Specialized Centers
    Route::get('specialized-centers', [SpecializedCenterController::class, 'index'])->name('specialized-centers.index');
    Route::post('specialized-centers', [SpecializedCenterController::class, 'store'])->name('specialized-centers.store');
    Route::put('specialized-centers/{specializedCenter}', [SpecializedCenterController::class, 'update'])->name('specialized-centers.update');
    Route::delete('specialized-centers/{specializedCenter}', [SpecializedCenterController::class, 'destroy'])->name('specialized-centers.destroy');

    // Academic Staffs
    Route::resource('academic-staffs', AcademicStaffController::class)->except(['show']);

    // Academic Projects
    Route::resource('academic-projects', AcademicProjectController::class)->except(['show']);

    // Research Publications CMS for schools
    Route::prefix('academics/{school}/research-publications')->name('academics.research-publications.')->group(function () {
        Route::get('/', [SchoolResearchPublicationController::class, 'index'])->name('index');
        Route::get('create', [SchoolResearchPublicationController::class, 'create'])->name('create');
        Route::post('/', [SchoolResearchPublicationController::class, 'store'])->name('store');
        Route::get('{publication}/edit', [SchoolResearchPublicationController::class, 'edit'])->name('edit');
        Route::put('{publication}', [SchoolResearchPublicationController::class, 'update'])->name('update');
        Route::delete('{publication}', [SchoolResearchPublicationController::class, 'destroy'])->name('destroy');
    });

    // All Offices Management (unified interface)
    Route::prefix('all-offices')->name('all-offices.')->group(function () {
        Route::get('about', [\App\Http\Controllers\Admin\AllOfficesController::class, 'about'])->name('about');
        Route::put('about', [\App\Http\Controllers\Admin\AllOfficesController::class, 'updateAbout'])->name('about.update');
        Route::get('services', [\App\Http\Controllers\Admin\AllOfficesController::class, 'services'])->name('services');
        Route::post('services', [\App\Http\Controllers\Admin\AllOfficesController::class, 'storeService'])->name('services.store');
        Route::put('services/{officeService}', [\App\Http\Controllers\Admin\AllOfficesController::class, 'updateService'])->name('services.update');
        Route::delete('services/{officeService}', [\App\Http\Controllers\Admin\AllOfficesController::class, 'destroyService'])->name('services.destroy');
        Route::get('projects', [\App\Http\Controllers\Admin\AllOfficesController::class, 'projects'])->name('projects');
        Route::get('projects/create', [\App\Http\Controllers\Admin\AllOfficesController::class, 'createProject'])->name('projects.create');
        Route::post('projects', [\App\Http\Controllers\Admin\AllOfficesController::class, 'storeProject'])->name('projects.store');
        Route::get('projects/{officeProject}/edit', [\App\Http\Controllers\Admin\AllOfficesController::class, 'editProject'])->name('projects.edit');
        Route::put('projects/{officeProject}', [\App\Http\Controllers\Admin\AllOfficesController::class, 'updateProject'])->name('projects.update');
        Route::delete('projects/{officeProject}', [\App\Http\Controllers\Admin\AllOfficesController::class, 'destroyProject'])->name('projects.destroy');
        Route::get('contact', [\App\Http\Controllers\Admin\AllOfficesController::class, 'contact'])->name('contact');
        Route::put('contact', [\App\Http\Controllers\Admin\AllOfficesController::class, 'updateContact'])->name('contact.update');
    });

    // Generic Office CMS for all offices
    Route::prefix('offices/{office}')->name('offices.generic.')->group(function () {
        Route::get('about', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'about'])->name('about');
        Route::put('about', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'updateAbout'])->name('about.update');
        Route::get('gallery', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'gallery'])->name('gallery');
        Route::post('gallery', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'storeGallery'])->name('gallery.store');
        Route::delete('gallery/{officeGallery}', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'destroyGallery'])->name('gallery.destroy');
        Route::get('services', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'services'])->name('services');
        Route::post('services', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'storeService'])->name('services.store');
        Route::put('services/{officeService}', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'updateService'])->name('services.update');
        Route::delete('services/{officeService}', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'destroyService'])->name('services.destroy');
        Route::get('projects', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'projects'])->name('projects');
        Route::get('projects/create', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'createProject'])->name('projects.create');
        Route::post('projects', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'storeProject'])->name('projects.store');
        Route::get('projects/{officeProject}/edit', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'editProject'])->name('projects.edit');
        Route::put('projects/{officeProject}', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'updateProject'])->name('projects.update');
        Route::delete('projects/{officeProject}', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'destroyProject'])->name('projects.destroy');
        Route::get('process', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'process'])->name('process');
        Route::post('process', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'storeProcess'])->name('process.store');
        Route::put('process/{officeProcess}', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'updateProcess'])->name('process.update');
        Route::delete('process/{officeProcess}', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'destroyProcess'])->name('process.destroy');
        Route::get('contact', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'contact'])->name('contact');
        Route::put('contact', [\App\Http\Controllers\Admin\GenericOfficeCmsController::class, 'updateContact'])->name('contact.update');
    });

    // ICT Office CMS
    Route::prefix('offices/ict')->name('offices.ict.')->group(function () {
        Route::get('about',              [IctCmsController::class, 'about'])->name('about');
        Route::put('about',              [IctCmsController::class, 'updateAbout'])->name('about.update');
        Route::get('gallery',            [IctCmsController::class, 'gallery'])->name('gallery');
        Route::post('gallery',           [IctCmsController::class, 'storeGallery'])->name('gallery.store');
        Route::delete('gallery/{officeGallery}', [IctCmsController::class, 'destroyGallery'])->name('gallery.destroy');
        Route::get('services',           [IctCmsController::class, 'services'])->name('services');
        Route::post('services',          [IctCmsController::class, 'storeService'])->name('services.store');
        Route::put('services/{officeService}',   [IctCmsController::class, 'updateService'])->name('services.update');
        Route::delete('services/{officeService}',[IctCmsController::class, 'destroyService'])->name('services.destroy');
        Route::get('projects',           [IctCmsController::class, 'projects'])->name('projects');
        Route::get('projects/create',    [IctCmsController::class, 'createProject'])->name('projects.create');
        Route::post('projects',          [IctCmsController::class, 'storeProject'])->name('projects.store');
        Route::get('projects/{officeProject}/edit', [IctCmsController::class, 'editProject'])->name('projects.edit');
        Route::put('projects/{officeProject}',      [IctCmsController::class, 'updateProject'])->name('projects.update');
        Route::delete('projects/{officeProject}',   [IctCmsController::class, 'destroyProject'])->name('projects.destroy');
        Route::get('contact',            [IctCmsController::class, 'contact'])->name('contact');
        Route::put('contact',            [IctCmsController::class, 'updateContact'])->name('contact.update');
    });

    // Registrar Office CMS
    Route::prefix('offices/registrar')->name('offices.registrar.')->group(function () {
        Route::get('about',              [RegistrarCmsController::class, 'about'])->name('about');
        Route::put('about',              [RegistrarCmsController::class, 'updateAbout'])->name('about.update');
        Route::get('services',           [RegistrarCmsController::class, 'services'])->name('services');
        Route::post('services',          [RegistrarCmsController::class, 'storeService'])->name('services.store');
        Route::put('services/{officeService}',   [RegistrarCmsController::class, 'updateService'])->name('services.update');
        Route::delete('services/{officeService}',[RegistrarCmsController::class, 'destroyService'])->name('services.destroy');
        Route::get('process',            [RegistrarCmsController::class, 'process'])->name('process');
        Route::get('process/create',     [RegistrarCmsController::class, 'createProcess'])->name('process.create');
        Route::post('process',           [RegistrarCmsController::class, 'storeProcess'])->name('process.store');
        Route::get('process/{officeProcess}/edit', [RegistrarCmsController::class, 'editProcess'])->name('process.edit');
        Route::put('process/{officeProcess}',      [RegistrarCmsController::class, 'updateProcess'])->name('process.update');
        Route::delete('process/{officeProcess}',   [RegistrarCmsController::class, 'destroyProcess'])->name('process.destroy');
        Route::get('contact',            [RegistrarCmsController::class, 'contact'])->name('contact');
        Route::put('contact',            [RegistrarCmsController::class, 'updateContact'])->name('contact.update');
    });

    // Nursing CMS
    Route::get('academics/nursing/overview', [NursingCmsController::class, 'overview'])->name('nursing.overview');
    Route::put('academics/nursing/overview', [NursingCmsController::class, 'updateOverview'])->name('nursing.overview.update');
    Route::get('academics/nursing/partnership', [NursingCmsController::class, 'partnership'])->name('nursing.partnership');
    Route::put('academics/nursing/partnership', [NursingCmsController::class, 'updatePartnership'])->name('nursing.partnership.update');
    Route::get('academics/nursing/departments', [\App\Http\Controllers\Admin\NursingDepartmentAdminController::class, 'index'])->name('nursing.departments.index');
    Route::get('academics/nursing/departments/landing', [\App\Http\Controllers\Admin\NursingDepartmentAdminController::class, 'landing'])->name('nursing.departments.landing');
    Route::put('academics/nursing/departments/landing', [\App\Http\Controllers\Admin\NursingDepartmentAdminController::class, 'updateLanding'])->name('nursing.departments.landing.update');
    Route::get('academics/nursing/departments/{department}/edit', [\App\Http\Controllers\Admin\NursingDepartmentAdminController::class, 'edit'])->name('nursing.departments.edit');
    Route::put('academics/nursing/departments/{department}', [\App\Http\Controllers\Admin\NursingDepartmentAdminController::class, 'update'])->name('nursing.departments.update');
    Route::resource('academics/nursing/partnerships', \App\Http\Controllers\Admin\NursingPartnershipAdminController::class)
        ->except(['show'])
        ->names('nursing.partnerships')
        ->parameters(['partnerships' => 'partnership']);

    // Public Health CMS
    Route::get('academics/public-health/overview', [PublicHealthCmsController::class, 'overview'])->name('public-health.overview');
    Route::put('academics/public-health/overview', [PublicHealthCmsController::class, 'updateOverview'])->name('public-health.overview.update');
    Route::get('academics/public-health/partnership', [PublicHealthCmsController::class, 'partnership'])->name('public-health.partnership');
    Route::put('academics/public-health/partnership', [PublicHealthCmsController::class, 'updatePartnership'])->name('public-health.partnership.update');
    Route::resource('academics/public-health/partnerships', \App\Http\Controllers\Admin\PublicHealthPartnershipAdminController::class)
        ->except(['show'])
        ->names('public-health.partnerships')
        ->parameters(['partnerships' => 'partnership']);
    Route::get('academics/public-health/departments', [PublicHealthCmsController::class, 'departmentsIndex'])->name('public-health.departments.index');
    Route::get('academics/public-health/departments/{dept}/edit', [PublicHealthCmsController::class, 'departmentEdit'])->name('public-health.departments.edit');
    Route::put('academics/public-health/departments/{dept}', [PublicHealthCmsController::class, 'departmentUpdate'])->name('public-health.departments.update');

    // Medicine CMS
    Route::get('academics/medicine/overview', [MedicineCmsController::class, 'overview'])->name('medicine.overview');
    Route::put('academics/medicine/overview', [MedicineCmsController::class, 'updateOverview'])->name('medicine.overview.update');
    Route::get('academics/medicine/partnership', [\App\Http\Controllers\Admin\MedicinePartnershipAdminController::class, 'index'])->name('medicine.partnership');
    Route::resource('academics/medicine/partnerships', \App\Http\Controllers\Admin\MedicinePartnershipAdminController::class)
        ->except(['index', 'show'])
        ->names('medicine.partnerships')
        ->parameters(['partnerships' => 'partnership']);

    // Medicine Departments Admin
    Route::prefix('academics/medicine')->name('medicine.')->group(function () {
        Route::resource('departments', \App\Http\Controllers\Admin\MedicineDepartmentAdminController::class);
        Route::resource('sub-departments', \App\Http\Controllers\Admin\MedicineSubDepartmentAdminController::class)->parameters([
            'sub-departments' => 'subDepartment'
        ]);
        Route::resource('academic-units', \App\Http\Controllers\Admin\AcademicUnitAdminController::class)->parameters([
            'academic-units' => 'academicUnit'
        ]);
    });

    // Research CMS
    Route::prefix('research')->name('research.')->group(function () {
        Route::get('overview', [AdminResearchController::class, 'overview'])->name('overview');
        Route::get('background', [AdminResearchController::class, 'background'])->name('background');
        Route::post('background', [AdminResearchController::class, 'updateBackground'])->name('background.update');
        Route::get('mission', [AdminResearchController::class, 'mission'])->name('mission');
        Route::post('mission', [AdminResearchController::class, 'updateMission'])->name('mission.update');
        Route::get('vision', [AdminResearchController::class, 'vision'])->name('vision');
        Route::post('vision', [AdminResearchController::class, 'updateVision'])->name('vision.update');
        Route::get('goals', [AdminResearchController::class, 'goals'])->name('goals');
        Route::post('goals', [AdminResearchController::class, 'storeGoal'])->name('goals.store');
        Route::get('goals/{goal}/edit', [AdminResearchController::class, 'editGoal'])->name('goals.edit');
        Route::put('goals/{goal}', [AdminResearchController::class, 'updateGoal'])->name('goals.update');
        Route::delete('goals/{goal}', [AdminResearchController::class, 'destroyGoal'])->name('goals.destroy');

        // Roles and Responsibility Management
        Route::prefix('roles-responsibility')->name('roles-responsibility.')->group(function () {
            Route::get('/', [ResearchRolesResponsibilityAdminController::class, 'index'])->name('index');
            
            // Hero Section
            Route::get('hero/edit', [ResearchRolesResponsibilityAdminController::class, 'editHero'])->name('hero.edit');
            Route::post('hero', [ResearchRolesResponsibilityAdminController::class, 'updateHero'])->name('hero.update');
            
            // Overview Section
            Route::get('overview/edit', [ResearchRolesResponsibilityAdminController::class, 'editOverview'])->name('overview.edit');
            Route::post('overview', [ResearchRolesResponsibilityAdminController::class, 'updateOverview'])->name('overview.update');
            
            // Categories
            Route::get('categories', [ResearchRolesResponsibilityAdminController::class, 'indexCategories'])->name('categories.index');
            Route::get('categories/create', [ResearchRolesResponsibilityAdminController::class, 'createCategory'])->name('categories.create');
            Route::post('categories', [ResearchRolesResponsibilityAdminController::class, 'storeCategory'])->name('categories.store');
            Route::get('categories/{category}/edit', [ResearchRolesResponsibilityAdminController::class, 'editCategory'])->name('categories.edit');
            Route::put('categories/{category}', [ResearchRolesResponsibilityAdminController::class, 'updateCategory'])->name('categories.update');
            Route::delete('categories/{category}', [ResearchRolesResponsibilityAdminController::class, 'destroyCategory'])->name('categories.destroy');
            
            // Processes
            Route::get('processes', [ResearchRolesResponsibilityAdminController::class, 'indexProcesses'])->name('processes.index');
            Route::get('processes/create', [ResearchRolesResponsibilityAdminController::class, 'createProcess'])->name('processes.create');
            Route::post('processes', [ResearchRolesResponsibilityAdminController::class, 'storeProcess'])->name('processes.store');
            Route::get('processes/{process}/edit', [ResearchRolesResponsibilityAdminController::class, 'editProcess'])->name('processes.edit');
            Route::put('processes/{process}', [ResearchRolesResponsibilityAdminController::class, 'updateProcess'])->name('processes.update');
            Route::delete('processes/{process}', [ResearchRolesResponsibilityAdminController::class, 'destroyProcess'])->name('processes.destroy');
            
            // Policies
            Route::get('policies', [ResearchRolesResponsibilityAdminController::class, 'indexPolicies'])->name('policies.index');
            Route::get('policies/create', [ResearchRolesResponsibilityAdminController::class, 'createPolicy'])->name('policies.create');
            Route::post('policies', [ResearchRolesResponsibilityAdminController::class, 'storePolicy'])->name('policies.store');
            Route::get('policies/{policy}/edit', [ResearchRolesResponsibilityAdminController::class, 'editPolicy'])->name('policies.edit');
            Route::put('policies/{policy}', [ResearchRolesResponsibilityAdminController::class, 'updatePolicy'])->name('policies.update');
            Route::delete('policies/{policy}', [ResearchRolesResponsibilityAdminController::class, 'destroyPolicy'])->name('policies.destroy');
            
            // FAQs
            Route::get('faqs', [ResearchRolesResponsibilityAdminController::class, 'indexFaqs'])->name('faqs.index');
            Route::get('faqs/create', [ResearchRolesResponsibilityAdminController::class, 'createFaq'])->name('faqs.create');
            Route::post('faqs', [ResearchRolesResponsibilityAdminController::class, 'storeFaq'])->name('faqs.store');
            Route::get('faqs/{faq}/edit', [ResearchRolesResponsibilityAdminController::class, 'editFaq'])->name('faqs.edit');
            Route::put('faqs/{faq}', [ResearchRolesResponsibilityAdminController::class, 'updateFaq'])->name('faqs.update');
            Route::delete('faqs/{faq}', [ResearchRolesResponsibilityAdminController::class, 'destroyFaq'])->name('faqs.destroy');
            
            // Statistics
            Route::get('statistics', [ResearchRolesResponsibilityAdminController::class, 'indexStatistics'])->name('statistics.index');
            Route::get('statistics/create', [ResearchRolesResponsibilityAdminController::class, 'createStatistic'])->name('statistics.create');
            Route::post('statistics', [ResearchRolesResponsibilityAdminController::class, 'storeStatistic'])->name('statistics.store');
            Route::get('statistics/{statistic}/edit', [ResearchRolesResponsibilityAdminController::class, 'editStatistic'])->name('statistics.edit');
            Route::put('statistics/{statistic}', [ResearchRolesResponsibilityAdminController::class, 'updateStatistic'])->name('statistics.update');
            Route::delete('statistics/{statistic}', [ResearchRolesResponsibilityAdminController::class, 'destroyStatistic'])->name('statistics.destroy');
            
            // Contact
            Route::get('contact/edit', [ResearchRolesResponsibilityAdminController::class, 'editContact'])->name('contact.edit');
            Route::post('contact', [ResearchRolesResponsibilityAdminController::class, 'updateContact'])->name('contact.update');
        });
    });

    // Research Projects CMS
    Route::prefix('research/projects')->name('research.projects.')->group(function () {
        Route::get('/', [AdminResearchProjectsController::class, 'index'])->name('index');
        Route::get('/{type}', [AdminResearchProjectsController::class, 'show'])->name('show');
        Route::post('/{type}/basic-info', [AdminResearchProjectsController::class, 'updateBasicInfo'])->name('basic-info.update');
        Route::post('/{type}/functions', [AdminResearchProjectsController::class, 'addFunction'])->name('functions.store');
        Route::post('/{type}/workflows', [AdminResearchProjectsController::class, 'addWorkflow'])->name('workflows.store');
        Route::post('/{type}/resources', [AdminResearchProjectsController::class, 'addResource'])->name('resources.store');
        Route::post('/{type}/statistics', [AdminResearchProjectsController::class, 'addStatistic'])->name('statistics.store');
        Route::post('/{type}/team-members', [AdminResearchProjectsController::class, 'addTeamMember'])->name('team-members.store');
        Route::post('/{type}/faqs', [AdminResearchProjectsController::class, 'addFaq'])->name('faqs.store');
    });

    // Partnerships Management
    Route::prefix('partnerships')->name('partnerships.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PartnershipsCmsController::class, 'index'])->name('index');
        
        // Overview Management
        Route::get('overview/edit', [\App\Http\Controllers\Admin\PartnershipsCmsController::class, 'editOverview'])->name('overview-edit');
        Route::put('overview', [\App\Http\Controllers\Admin\PartnershipsCmsController::class, 'updateOverview'])->name('overview-update');
        
        // Partners CRUD
        Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class)->except(['show']);
        Route::post('partners/reorder', [\App\Http\Controllers\Admin\PartnerController::class, 'reorder'])->name('partners.reorder');
        
        // Statistics CRUD
        Route::resource('statistics', \App\Http\Controllers\Admin\PartnershipStatisticController::class)->except(['show']);
        Route::post('statistics/reorder', [\App\Http\Controllers\Admin\PartnershipStatisticController::class, 'reorder'])->name('statistics.reorder');
        
        // Partnership Areas CRUD
        Route::resource('areas', \App\Http\Controllers\Admin\PartnershipAreaController::class)->except(['show']);
        Route::post('areas/reorder', [\App\Http\Controllers\Admin\PartnershipAreaController::class, 'reorder'])->name('areas.reorder');
        
        // Success Stories CRUD
        Route::resource('success-stories', \App\Http\Controllers\Admin\SuccessStoryController::class)->except(['show']);
        Route::post('success-stories/reorder', [\App\Http\Controllers\Admin\SuccessStoryController::class, 'reorder'])->name('success-stories.reorder');
        
        // Featured Partners
        Route::get('featured-partners', [\App\Http\Controllers\Admin\FeaturedPartnerController::class, 'index'])->name('featured-partners.index');
        Route::post('featured-partners', [\App\Http\Controllers\Admin\FeaturedPartnerController::class, 'store'])->name('featured-partners.store');
        Route::delete('featured-partners/{id}', [\App\Http\Controllers\Admin\FeaturedPartnerController::class, 'remove'])->name('featured-partners.remove');
        Route::post('featured-partners/reorder', [\App\Http\Controllers\Admin\FeaturedPartnerController::class, 'reorder'])->name('featured-partners.reorder');
        
        // Documents CRUD
        Route::resource('documents', \App\Http\Controllers\Admin\PartnershipDocumentController::class)->except(['show']);
        Route::post('documents/reorder', [\App\Http\Controllers\Admin\PartnershipDocumentController::class, 'reorder'])->name('documents.reorder');
        
        // Contact Information
        Route::get('contact/edit', [\App\Http\Controllers\Admin\PartnershipContactController::class, 'edit'])->name('contact.edit');
        Route::put('contact', [\App\Http\Controllers\Admin\PartnershipContactController::class, 'update'])->name('contact.update');

        // Partnership Applications
        Route::get('applications', [\App\Http\Controllers\Admin\PartnershipApplicationController::class, 'index'])->name('applications.index');
        Route::get('applications/{application}', [\App\Http\Controllers\Admin\PartnershipApplicationController::class, 'show'])->name('applications.show');
        Route::put('applications/{application}/status', [\App\Http\Controllers\Admin\PartnershipApplicationController::class, 'updateStatus'])->name('applications.update-status');
        Route::delete('applications/{application}', [\App\Http\Controllers\Admin\PartnershipApplicationController::class, 'destroy'])->name('applications.destroy');
    });
});
