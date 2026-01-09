<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventdetailsController;
use App\Http\Controllers\InstructorRegistrationController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\StudentsRegistrationController;
use App\Http\Controllers\TeamDetailsController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UpcomingeEventController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\faqController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\BasePageController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\AcademicCourseController;
use App\Http\Controllers\AdmissionsController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\CreditTransferController;
use App\Http\Controllers\ScholarshipsController;
use App\Http\Controllers\FinancialAidController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageManagerController;
use App\Http\Controllers\Admin\FooterManagerController;
use App\Http\Controllers\Admin\MenuBuilderController;
use App\Http\Controllers\Admin\ContentManagerController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\LogoManagerController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\PageBuilderController;
use App\Http\Controllers\CustomPageController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\Admin\GlobalThemeController;


Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/appearance', [GlobalThemeController::class, 'index'])->name('admin.appearance');
    Route::post('/appearance', [GlobalThemeController::class, 'update'])->name('admin.appearance.update');
    Route::get('/page-manager', [PageManagerController::class, 'index']);
    Route::post('/page-manager/save', [PageManagerController::class, 'save']);
    Route::get('/page-manager/get-menu', [PageManagerController::class, 'getMenu']);
    Route::post('/page-manager/save-menu', [PageManagerController::class, 'saveMenu']);

    Route::get('/footer-manager', [FooterManagerController::class, 'index']);
    Route::get('/footer-manager/get-menus', [FooterManagerController::class, 'getMenus']);
    Route::post('/footer-manager/save-menus', [FooterManagerController::class, 'saveMenus']);

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/settings', [SettingsController::class, 'update']);

    // SEO
    Route::get('/seo', [SeoController::class, 'index'])->name('admin.seo');
    Route::post('/seo', [SeoController::class, 'update']);

    // Logo Manager
    Route::get('/logo-manager', [LogoManagerController::class, 'index'])->name('admin.logo-manager');
    Route::post('/logo-manager', [LogoManagerController::class, 'update']);
    Route::get('/logo-manager/media', [LogoManagerController::class, 'getMedia']);
    Route::post('/logo-manager/upload', [LogoManagerController::class, 'upload']);

    // Media Library
    Route::get('/media-library', [MediaLibraryController::class, 'index'])->name('admin.media-library');
    Route::get('/media-library/json', [MediaLibraryController::class, 'getJson'])->name('admin.media-library.json');
    Route::post('/media-library/upload', [MediaLibraryController::class, 'upload']);
    Route::post('/media-library/delete', [MediaLibraryController::class, 'delete']);

    // Debug route to check database values
    Route::get('/page-manager/debug', function() {
        $pages = DB::table('global_pages')
            ->select('id', 'title', 'in_menu', 'is_active', 'updated_at')
            ->orderBy('id')
            ->limit(10)
            ->get();
        return response()->json($pages);
    });
    Route::get('/menu-builder', [MenuBuilderController::class, 'index']);
    Route::post('/menu-builder/save', [MenuBuilderController::class, 'save']);
    Route::get('/content-manager', [ContentManagerController::class, 'index'])->name('admin.content-manager');
    Route::post('/content-manager/update-visibility', [ContentManagerController::class, 'updateSectionVisibility']);

    // Theme Manager Routes
    Route::get('/theme-manager', [ThemeController::class, 'index'])->name('admin.themes');
    Route::get('/theme-manager/create', [ThemeController::class, 'create'])->name('admin.themes.create');
    Route::post('/theme-manager', [ThemeController::class, 'store'])->name('admin.themes.store');
    Route::get('/theme-manager/edit/{slug}', [ThemeController::class, 'edit'])->name('admin.themes.edit');
    Route::post('/theme-manager/update/{slug}', [ThemeController::class, 'update'])->name('admin.themes.update');
    Route::post('/theme-manager/activate/{slug}', [ThemeController::class, 'activate'])->name('admin.themes.activate');
    Route::post('/theme-manager/assets/{slug}', [ThemeController::class, 'updateAssets'])->name('admin.themes.assets');
    Route::delete('/theme-manager/{slug}', [ThemeController::class, 'destroy'])->name('admin.themes.destroy');
    Route::get('/theme-manager/preview/{slug}', [ThemeController::class, 'preview'])->name('admin.themes.preview');

    // Activity Log Routes
    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('admin.activity-log');
    Route::get('/activity-log/{id}', [ActivityLogController::class, 'show'])->name('admin.activity-log.show');
    Route::post('/activity-log/{id}/revert', [ActivityLogController::class, 'revert'])->name('admin.activity-log.revert');
    Route::post('/activity-log/revert-last', [ActivityLogController::class, 'revertLast'])->name('admin.activity-log.revert-last');
    Route::post('/activity-log/cleanup', [ActivityLogController::class, 'cleanup'])->name('admin.activity-log.cleanup');

    // Cache Clear Route
    Route::post('/cache/clear', [ActivityLogController::class, 'clearCache'])->name('admin.cache.clear');

    // Page Builder Routes
    Route::get('/page-builder', [PageBuilderController::class, 'index'])->name('admin.page-builder.index');
    Route::get('/page-builder/create', [PageBuilderController::class, 'create'])->name('admin.page-builder.create');
    Route::post('/page-builder', [PageBuilderController::class, 'store'])->name('admin.page-builder.store');

    // Page Builder Section Routes (must come BEFORE {slug} catch-all routes)
    Route::post('/page-builder/{slug}/sections/add', [PageBuilderController::class, 'addSection'])
        ->name('admin.page-builder.sections.add')
        ->where('slug', '[a-z0-9\-]+');
    Route::post('/page-builder/{slug}/sections/reorder', [PageBuilderController::class, 'reorderSections'])
        ->name('admin.page-builder.sections.reorder')
        ->where('slug', '[a-z0-9\-]+');
    Route::post('/page-builder/{slug}/sections', [PageBuilderController::class, 'saveSections'])
        ->name('admin.page-builder.sections.save')
        ->where('slug', '[a-z0-9\-]+');
    Route::match(['put', 'patch', 'post'], '/page-builder/{slug}/sections/{sectionId}', [PageBuilderController::class, 'updateSection'])
        ->name('admin.page-builder.sections.update')
        ->where(['slug' => '[a-z0-9\-]+', 'sectionId' => '[a-z0-9\-]+']);
    Route::delete('/page-builder/{slug}/sections/{sectionId}', [PageBuilderController::class, 'deleteSection'])
        ->name('admin.page-builder.sections.delete')
        ->where(['slug' => '[a-z0-9\-]+', 'sectionId' => '[a-z0-9\-]+']);
    Route::get('/page-builder/{slug}/sections/{sectionId}/editor', [PageBuilderController::class, 'getSectionEditor'])
        ->name('admin.page-builder.sections.editor')
        ->where(['slug' => '[a-z0-9\-]+', 'sectionId' => '[a-z0-9\-]+']);

    // Page Builder Page Routes (after section routes)
    // Use where() constraint to ensure slug doesn't contain slashes
    Route::get('/page-builder/{slug}/edit', [PageBuilderController::class, 'edit'])
        ->name('admin.page-builder.edit')
        ->where('slug', '[a-z0-9\-]+');
    Route::post('/page-builder/{slug}/duplicate', [PageBuilderController::class, 'duplicate'])
        ->name('admin.page-builder.duplicate')
        ->where('slug', '[a-z0-9\-]+');
    Route::match(['put', 'patch'], '/page-builder/{slug}', [PageBuilderController::class, 'update'])
        ->name('admin.page-builder.update')
        ->where('slug', '[a-z0-9\-]+');
    Route::delete('/page-builder/{slug}', [PageBuilderController::class, 'destroy'])
        ->name('admin.page-builder.destroy')
        ->where('slug', '[a-z0-9\-]+');
});

Route::middleware(['page.status'])->group(function () {

// Dynamic home - uses active theme's home_version
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

// Direct version routes (for preview/testing)
Route::get('/home-v1', [HomeController::class, 'homeV1']);
Route::get('/home-v2', [HomeController::class, 'homeV2']);
Route::get('/home-v3', [HomeController::class, 'homeV3']);
Route::get('/home-v4', [HomeController::class, 'homeV4']);
Route::get('/home-v5', [HomeController::class, 'homeV5']);
Route::get('/home-v6', [HomeController::class, 'homeV6']);
Route::get('/home-v7', [HomeController::class, 'homeV7']);
Route::get('/home-v8', [HomeController::class, 'homeV8']);

// about
Route::get('/about', [AboutController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);

Route::get('courses-grid-view', [CoursesController::class, 'grid']);
Route::get('courses-grid-with-sidebar', [CoursesController::class, 'gridWithSidebar']);
Route::get('courses-list-view', [CoursesController::class, 'list']);
Route::get('course-details', [CoursesController::class, 'details']);

// blog routes
Route::get('/blog', [BlogsController::class, 'blogs']);
Route::get('/blog-with-sidebar', [BlogsController::class, 'blogWithSidebar']);
Route::get('/blog-details', [BlogsController::class, 'details']);


// events
Route::get('/event', [UpcomingeEventController::class, 'index']);
Route::get('/event-details', [EventdetailsController::class, 'index']);

// team
Route::get('/team-members', [TeamMemberController::class, 'index']);
Route::get('/team-member-details', [TeamDetailsController::class, 'index']);

// Registration
Route::get('/students-registrations', [StudentsRegistrationController::class, 'index']);
Route::get('/instructor-registrations', [InstructorRegistrationController::class, 'index']);

//  Auth
Route::get('/signup', [SignUpController::class, 'index']);
Route::get('/signin', [SignInController::class, 'index']);

// FAQ
Route::get('/faqs', [faqController::class, 'index']);

//  Cart & Checkout
Route::get('/cart', [CartController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);

//  Error Page
Route::get('/error', [ErrorController::class, 'index']);


Route::get('/department', [DepartmentController::class, 'index']);

// Degree Routes (dynamic: department/degree-type/slug)
Route::get('/department/{degreeType}/{slug}', [DegreeController::class, 'show'])->name('degree.show');

// Academic Course Routes (dynamic: academic-course/slug)
Route::get('/academic-course/{slug}', [AcademicCourseController::class, 'show'])->name('academic-course.show');

// Admission Pages
Route::get('/admissions', [AdmissionsController::class, 'index'])->name('admissions');
Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation');
Route::get('/credit-transfer', [CreditTransferController::class, 'index'])->name('credit-transfer');
Route::get('/scholarships', [ScholarshipsController::class, 'index'])->name('scholarships');
Route::get('/financial-aid', [FinancialAidController::class, 'index'])->name('financial-aid');

// Custom Pages (Page Builder) - MUST be last to avoid conflicts with other routes
Route::get('/{slug}', [CustomPageController::class, 'show'])->name('custom-page.show')->where('slug', '[a-z0-9\-]+');

});




