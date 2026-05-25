<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatestPostController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HealthTipsApiController;
use App\Http\Controllers\SpecializedCentersApiController;
use App\Http\Controllers\GalleryApiController;
use App\Http\Controllers\AcademicStaffApiController;
use App\Http\Controllers\AcademicProjectApiController;
use App\Http\Controllers\AcademicPageApiController;
use App\Http\Controllers\AcademicResearchController;
use App\Http\Controllers\AcademicResearchPublicationApiController;
use App\Http\Controllers\DepartmentsApiController;
use App\Http\Controllers\OfficeApiController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ResearchProjectsController;
use App\Http\Controllers\MedicineDepartmentApiController;
use App\Http\Controllers\NursingDepartmentApiController;
use App\Http\Controllers\HomeHeroApiController;
use App\Http\Controllers\MedicinePartnershipApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Specific routes must come before the resource route to avoid conflicts
Route::get('/latest-posts/latest-news', [LatestPostController::class, 'getLatestNews']);
Route::get('/latest-posts/latest-announcements', [LatestPostController::class, 'getLatestAnnouncements']);
Route::get('/latest-posts/upcoming-events', [LatestPostController::class, 'getUpcomingEvents']);
Route::get('/latest-posts/past-events', [LatestPostController::class, 'getPastEvents']);
Route::get('/latest-posts/type/{type}', [LatestPostController::class, 'getByType']);

// Resource route (must come after specific routes)
Route::apiResource('latest-posts', LatestPostController::class);

Route::get('/home-hero-slides', [HomeHeroApiController::class, 'index']);
Route::get('/statistics', [StatisticController::class, 'index']);

// About section public API
Route::get('/about', [AboutController::class, 'aboutPage']);
Route::get('/leaders', [AboutController::class, 'leaders']);
Route::get('/mission-vision-values', [AboutController::class, 'missionVisionValues']);

// Health Tips public API
Route::get('/health-categories', [HealthTipsApiController::class, 'categories']);

// Specialized Centers public API
Route::get('/specialized-centers', [SpecializedCentersApiController::class, 'index']);

// Gallery public API
Route::get('/gallery', [GalleryApiController::class, 'index']);

// Academic Staffs public API
Route::get('/academic-staffs/{school}', [AcademicStaffApiController::class, 'bySchool']);
Route::get('/academic-staffs/{school}/{slug}', [AcademicStaffApiController::class, 'show']);

// Academic Pages (CMS) public API
Route::get('/academic-pages/{school}/{page}', [AcademicPageApiController::class, 'show']);

// Research Publications public API
Route::get('/academics/{school}/research-publications', [AcademicResearchPublicationApiController::class, 'index']);
Route::get('/academics/{school}/research-publications/{slug}', [AcademicResearchPublicationApiController::class, 'show']);

// Combined Academic Research public API
Route::get('/academics/academic-research', [AcademicResearchController::class, 'index']);
Route::get('/academics/academic-research/{slug}', [AcademicResearchController::class, 'show']);

// Academic Projects public API
Route::get('/academic-projects', [AcademicProjectApiController::class, 'index']);
Route::get('/academic-projects/{slug}', [AcademicProjectApiController::class, 'show']);

// Medicine Partnerships public API
Route::get('/medicine/partnerships', [MedicinePartnershipApiController::class, 'index']);
Route::get('/medicine/partnerships/{slug}', [MedicinePartnershipApiController::class, 'show']);

// Medicine Departments public API
Route::get('/medicine/departments', [MedicineDepartmentApiController::class, 'index']);
Route::get('/medicine/sub-departments/slug/{slug}', [MedicineDepartmentApiController::class, 'showSubDepartmentBySlug']);
Route::get('/medicine/sub-departments/{id}/academic-units', [MedicineDepartmentApiController::class, 'academicUnitsForSubDepartment']);
Route::get('/medicine/sub-departments/{id}', [MedicineDepartmentApiController::class, 'showSubDepartment']);
Route::get('/medicine/departments/{slug}', [MedicineDepartmentApiController::class, 'show']);

// Nursing Departments public API
Route::get('/nursing/departments', [NursingDepartmentApiController::class, 'index']);
Route::get('/nursing/departments/{slug}', [NursingDepartmentApiController::class, 'show']);

// Academic Departments dropdown API for admin staff forms
Route::get('/academics/{school}/departments', [DepartmentsApiController::class, 'index']);

// Office public API
Route::get('/offices/{office}/page',     [OfficeApiController::class, 'page']);
Route::get('/offices/{office}/gallery',  [OfficeApiController::class, 'gallery']);
Route::get('/offices/{office}/services', [OfficeApiController::class, 'services']);
Route::get('/offices/{office}/projects', [OfficeApiController::class, 'projects']);
Route::get('/offices/{office}/projects/{slug}', [OfficeApiController::class, 'project']);
Route::get('/offices/{office}/process', [OfficeApiController::class, 'process']);
Route::get('/offices/{office}/contact',  [OfficeApiController::class, 'contact']);

// Research API routes
Route::get('/research/background', [ResearchController::class, 'background']);
Route::get('/research/mission', [ResearchController::class, 'mission']);
Route::get('/research/vision', [ResearchController::class, 'vision']);
Route::get('/research/goals', [ResearchController::class, 'goals']);

// Research Projects API routes
Route::get('/research/projects/irb', [ResearchProjectsController::class, 'irb']);
Route::get('/research/projects/idream', [ResearchProjectsController::class, 'idream']);
Route::get('/research/projects/hdss', [ResearchProjectsController::class, 'hdss']);
Route::get('/research/projects/all', [ResearchProjectsController::class, 'all']);
