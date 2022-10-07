<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'redirectUser'])->name('home');

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    //Users
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{id}', 'edit');
        Route::put('/update-users/{id}', 'update');
        Route::post('/delete-users', 'destroy');
    });
    //Users
    Route::controller(App\Http\Controllers\Admin\PermissionController::class)->group(function () {
        Route::get('/permissions', 'index');
        Route::get('/permissions/create', 'create');
        Route::post('/permissions', 'store');
        Route::post('/delete-permission/{id}', 'destroy');
    });
    //Student
    Route::controller(App\Http\Controllers\Admin\StudentController::class)->group(function () {
        Route::get('/students', 'index');
        Route::get('/students/{id}', 'edit');
        Route::get('/students/view/{id}', 'show');
        Route::put('/update-student/{id}', 'update');
        Route::post('/delete-student', 'destroy');
    });
    //Roles
    Route::controller(App\Http\Controllers\Admin\RoleController::class)->group(function () {
        Route::get('/roles', 'index');
        Route::get('/roles/create', 'create');
        Route::post('/roles', 'store');
        Route::get('/roles/{id}', 'edit');
        Route::put('/update-role/{id}', 'update');
        Route::post('/delete-role', 'destroy');
    });
    //Achievers Award Applicants
    Route::controller(App\Http\Controllers\Admin\StudentApplicantsController::class)->group(function () {
        Route::get('/achievers-award', 'index');
        Route::get('/achievers-award/overall', 'overallList');
        Route::get('/achievers-award/{course_code}', 'achieversView');
        Route::get('/achievers-award/{course_code}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/achievers-award/{course_code}/view-all-students-pdf', 'openPdfAll');
        Route::get('/achievers-award/{course_code}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/achievers-award/{course_code}/approve/{id}', 'approved');
        Route::get('/achievers-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/achievers-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/achievers-award/{course_code}/update-status/{id}', 'update');
        Route::post('achievers-award/{course_code}/delete-form', 'destroy');
        Route::post('achievers-award/delete-form', 'destroy');
    });
    //DL Applicants
    Route::controller(App\Http\Controllers\Admin\DLApplicantsController::class)->group(function () {
        Route::get('/deans-list-award', 'index');
        Route::get('/deans-list-award/overall', 'overallList');
        Route::get('/deans-list-award/{course_code}/{year_level}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/deans-list-award/{course_code}/view-approved-students-pdf', 'openPdfAll');
        Route::get('/deans-list-award/{course_code}/{year_level}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/deans-list-award/{course_code}', 'achieversView');
        Route::get('/deans-list-award/{course_code}/approve/{id}', 'approved');
        Route::get('/deans-list-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/deans-list-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/deans-list-award/{course_code}/update-status/{id}', 'update');
        Route::post('/deans-list-award/{course_code}/delete-form', 'destroy');
        Route::post('/deans-list-award/delete-form', 'destroy');
    });
    //PL Applicants
    Route::controller(App\Http\Controllers\Admin\PLApplicantsController::class)->group(function () {
        Route::get('/presidents-list-award', 'index');
        Route::get('/presidents-list-award/overall', 'overallList');
        Route::get('/presidents-list-award/{course_code}/{year_level}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/presidents-list-award/{course_code}/view-approved-students-pdf', 'openPdfAll');
        Route::get('/presidents-list-award/{course_code}/{year_level}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/presidents-list-award/{course_code}', 'achieversView');
        Route::get('/presidents-list-award/{course_code}/approve/{id}', 'approved');
        Route::get('/presidents-list-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/presidents-list-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/presidents-list-award/{course_code}/update-status/{id}', 'update');
        Route::post('/presidents-list-award/{course_code}/delete-form', 'destroy');
        Route::post('/presidents-list-award/delete-form', 'destroy');
    });
    //Academic Excellence Applicants
    Route::controller(App\Http\Controllers\Admin\AEApplicantsController::class)->group(function () {
        Route::get('/academic-excellence-award', 'index');
        Route::get('/academic-excellence-award/overall', 'overallList');
        Route::get('/academic-excellence-award/{course_code}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/academic-excellence-award/{course_code}/view-all-students-pdf', 'openPdfAll');
        Route::get('/academic-excellence-award/{course_code}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/academic-excellence-award/{course_code}', 'achieversView');
        Route::get('/academic-excellence-award/{course_code}/approve/{id}', 'approved');
        Route::get('/academic-excellence-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/academic-excellence-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/academic-excellence-award/{course_code}/update-status/{id}', 'update');
        Route::post('/academic-excellence-award/{course_code}/delete-form', 'destroy');
        Route::post('/academic-excellence-award/delete-form', 'destroy');
    });

    Route::controller(App\Http\Controllers\Admin\NAApplicantsController::class)->group(function () {
        Route::get('/non-academic-award/leadership-award', 'leadership');
        Route::get('/non-academic-award/leadership-award/{id}', 'showLeadership');
        Route::post('/non-academic-award/leadership-award/delete-form', 'destroyLeadership');

        Route::get('/non-academic-award/athlete-of-the-year', 'athlete');
        Route::get('/non-academic-award/athlete-of-the-year/{id}', 'showAthlete');
        Route::post('/non-academic-award/athlete-of-the-year/delete-form', 'destroyAthlete');

        Route::get('/non-academic-award/outstanding-organization-award', 'outstanding');
        Route::get('/non-academic-award/outstanding-organization-award/{id}', 'showOutstanding');
        Route::post('/non-academic-award/outstanding-organization-award/delete-form', 'destroyOutstanding');

        Route::get('/non-academic-award/best-thesis-award', 'thesis');
        Route::get('/non-academic-award/best-thesis-award/{id}', 'showThesis');
        Route::post('/non-academic-award/best-thesis-award/delete-form', 'destroyThesis');

        Route::get('/non-academic-award/graduating-organization-presidents', 'presidents');
        Route::get('/non-academic-award/graduating-organization-presidents/{id}', 'showPresidents');
        Route::post('/non-academic-award/graduating-organization-presidents/delete-form', 'destroyPresidents');

        Route::get('/non-academic-award/graduating-sa', 'sa');
        Route::get('/non-academic-award/graduating-sa/{id}', 'showSa');
        Route::post('/non-academic-award/graduating-sa/delete-form', 'destroySa');

        Route::get('/non-academic-award/outside-competition', 'competition');
        Route::get('/non-academic-award/outside-competition/{id}', 'showcompetition');
        Route::post('/non-academic-award/outside-competition/delete-form', 'destroyCompetition');

        Route::get('/non-academic-award/pupt-dance-troupe', 'dance');
        Route::get('/non-academic-award/pupt-dance-troupe/{id}', 'showDance');
        Route::post('/non-academic-award/pupt-dance-troupe/delete-form', 'destroyDance');

        Route::get('/non-academic-award/pupt-choral-troupe', 'choral');
        Route::get('/non-academic-award/pupt-choral-troupe/{id}', 'showChoral');
        Route::post('/non-academic-award/pupt-choral-troupe/delete-form', 'destroyChoral');
    });
    Route::controller(App\Http\Controllers\Admin\UserManagementController::class)->group(function () {
        Route::get('/usermanagement', 'index');
    });
    //Activity Log
    Route::controller(App\Http\Controllers\Admin\ActivityLogController::class)->group(function () {
        Route::get('/user-activity-log', 'index');
    });
    //Import CSV
    Route::controller(App\Http\Controllers\Admin\ImportController::class)->group(function () {
        Route::get('/import-csv', 'index');
        Route::post('/import-csv/import-parse', 'parseImport');
        Route::post('/import-csv/import-process', 'processImport');
        Route::post('/delete-csv', 'destroy');
    });
    //Achievers Award Send Certificate
    Route::controller(App\Http\Controllers\Admin\AACertificateController::class)->group(function () {
        Route::get('/send-awardees-certificates/achievers-award', 'index');
        Route::get('/send-awardees-certificates/achievers-award/{course_code}', 'view');
        Route::post('/send-awardees-certificates/achievers-award/{course_code}/send', 'sendEmail');
        Route::get('/send-awardees-certificates/achievers-award/{course_code}/{id}', 'showCertificate');
    });
    //DL Send Certificate
    Route::controller(App\Http\Controllers\Admin\DLCertificateController::class)->group(function () {
        Route::get('/send-awardees-certificates/deans-list-award', 'index');
        Route::get('/send-awardees-certificates/deans-list-award/{course_code}', 'view');
        Route::post('/send-awardees-certificates/deans-list-award/{course_code}/send', 'sendEmail');
        Route::get('/send-awardees-certificates/deans-list-award/{course_code}/{id}', 'showCertificate');
    });
    //PL Send Certificate
    Route::controller(App\Http\Controllers\Admin\PLCertificateController::class)->group(function () {
        Route::get('/send-awardees-certificates/presidents-list-award', 'index');
        Route::get('/send-awardees-certificates/presidents-list-award/{course_code}', 'view');
        Route::post('/send-awardees-certificates/presidents-list-award/{course_code}/send', 'sendEmail');
        Route::get('/send-awardees-certificates/presidents-list-award/{course_code}/{id}', 'showCertificate');
    });
    //Academic Excellence Send Certificate
    Route::controller(App\Http\Controllers\Admin\AECertificateController::class)->group(function () {
        Route::get('/send-awardees-certificates/academic-excellence-award', 'index');
        Route::get('/send-awardees-certificates/academic-excellence-award/{course_code}', 'view');
        Route::post('/send-awardees-certificates/academic-excellence-award/{course_code}/send', 'sendEmail');
        Route::get('/send-awardees-certificates/academic-excellence-award/{course_code}/{id}', 'showCertificate');
    });
    //Gsllery
    Route::controller(App\Http\Controllers\Admin\GalleryController::class)->group(function () {
        Route::get('/galleries', 'index');
        Route::get('/galleries/create', 'create');
        Route::post('/galleries', 'store');
        Route::get('/galleries/show/{id}', 'show');
        Route::get('/galleries/edit/{id}', 'edit');
        Route::post('/galleries/update/{id}', 'update');
        Route::post('/galleries/delete', 'destroy');

        //photo route
        Route::get('galleries/photos/create/{id}', 'photoCreate');
        Route::post('galleries/photos/store', 'photoStore');
        Route::get('galleries/photos/show/{id}', 'photoShow');
        Route::get('galleries/photos/edit/{id}', 'photoEdit');
        Route::post('galleries/photos/update/{id}', 'photoUpdate');
        Route::post('galleries/photos/delete', 'photoDelete');
    });
    //fullcalendar
    Route::controller(App\Http\Controllers\Admin\FullCalendarController::class)->group(function () {
        Route::get('/calendar', 'index');
        Route::post('/calendar-event', 'crud');
    });
});
Route::prefix('user')->middleware('auth', 'isUser')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index']);

    Route::controller(App\Http\Controllers\User\AcademicAwardController::class)->group(function () {
        Route::get('/application-form', 'index');
        Route::post('/application-form', 'store');
    });
    Route::controller(App\Http\Controllers\User\AEAwardApplicationController::class)->group(function () {
        Route::get('/application-form-ae', 'index');
        Route::post('/application-form-ae', 'store');
    });
    Route::controller(App\Http\Controllers\User\NonAcademicAwardController::class)->group(function () {
        Route::get('/non-academic-form', 'index');
        Route::post('/non-academic-form', 'store');
    });

    Route::controller(App\Http\Controllers\User\ApplicationStatusController::class)->group(function () {
        Route::get('/application-status/academic-award', 'aaAward');
        Route::get('/application-status/academic-excellence', 'aeAward');
    });
});
