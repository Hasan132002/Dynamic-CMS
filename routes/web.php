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
});

Route::middleware(['page.status'])->group(function () {

Route::get('/', [HomeController::class, 'homeV1']);
Route::get('/home', [HomeController::class, 'homeV1']);
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

});




