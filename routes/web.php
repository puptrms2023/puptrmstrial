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
Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'redirectUser'])->name('home');
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware(['auth', 'is_verify_email']);

Route::prefix('admin')->middleware('auth', 'verified', 'isAdmin')->group(function () {

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    //Users
    Route::controller(App\Http\Controllers\Admin\User\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{id}', 'edit');
        Route::put('/update-users/{id}', 'update');
        Route::post('/delete-users', 'destroy');
        Route::delete('/bulk-delete-user', 'deleteAll');
    });
    //Users
    Route::controller(App\Http\Controllers\Admin\PermissionController::class)->group(function () {
        Route::get('/permissions', 'index');
        Route::get('/permissions/create', 'create');
        Route::post('/permissions', 'store');
        Route::post('/delete-permission/{id}', 'destroy');
    });
    //Student
    Route::controller(App\Http\Controllers\Admin\Student\StudentController::class)->group(function () {
        Route::get('/students', 'index');
        Route::get('/students/{id}', 'edit');
        Route::get('/students/view/{id}', 'show');
        Route::put('/update-student/{id}', 'update');
        Route::post('/delete-student', 'destroy');
        Route::delete('/bulk-delete-student', 'deleteAll');
    });
    //Roles
    Route::controller(App\Http\Controllers\Admin\Role\RoleController::class)->group(function () {
        Route::get('/roles', 'index');
        Route::get('/roles/create', 'create');
        Route::post('/roles', 'store');
        Route::get('/roles/{id}', 'edit');
        Route::put('/update-role/{id}', 'update');
        Route::post('/delete-role', 'destroy');
    });
    //Achievers Award Applicants
    Route::controller(App\Http\Controllers\Admin\Applicant\StudentApplicantsController::class)->group(function () {
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
        Route::delete('achievers-award/{course_code}/bulk-delete-form', 'deleteAll');
        Route::delete('achievers-award/bulk-delete-form', 'deleteAll');
    });
    Route::controller(App\Http\Controllers\Admin\ArchiveController::class)->group(function () {
        Route::get('/archive/achievers-award/{course_code}', 'archiveAA');
        Route::get('/archive-all/achievers-award', 'allarchiveAA');
        Route::get('achievers-award/restore/one/{id}',  'restore')->name('achievers.restore');
        Route::get('/archive/achievers-award/restore_all/{course_code}', 'restore_all')->name('achievers.restore_all');

        Route::get('/archive/deans-list-award/{course_code}', 'archiveDL');
        Route::get('/archive-all/deans-list-award', 'allarchiveDL');
        Route::get('deans-list-award/restore/one/{id}',  'restore')->name('deans.restore');
        Route::get('/archive/deans-list-award/restore_all/{course_code}', 'restore_all')->name('deans.restore_all');

        Route::get('/archive/presidents-list-award/{course_code}', 'archivePL');
        Route::get('/archive-all/presidents-list-award', 'allarchivePL');
        Route::get('presidents-list-award/restore/one/{id}',  'restore')->name('presidents.restore');
        Route::get('/archive/presidents-list-award/restore_all/{course_code}', 'restore_all')->name('presidents.restore_all');

        Route::get('/archive/academic-excellence-award/{course_code}', 'archiveAE');
        Route::get('/archive-all/academic-excellence-award', 'allarchiveAE');
        Route::get('academic-excellence-award/restore/one/{id}',  'restoreAE')->name('excellence.restore');
        Route::get('/archive/academic-excellence-award/restore_all/{course_code}', 'restore_allAE')->name('excellence.restore_all');

        Route::get('/archive/non-academic-award/{nonacad_id}', 'archiveNA');
        Route::get('/archive-all/non-academic-award', 'allarchiveNA');
        Route::get('non-academic-award/restore/one/{id}',  'restoreNA')->name('nonacad.restore');
        Route::get('/archive/non-academic-award/restore_all/{nonacad_id}', 'restore_allNA')->name('nonacad.restore_all');
    });
    //DL Applicants
    Route::controller(App\Http\Controllers\Admin\Applicant\DLApplicantsController::class)->group(function () {
        Route::get('/deans-list-award', 'index');
        Route::get('/deans-list-award/overall', 'overallList');
        Route::get('/deans-list-award/{course_code}/{year_level}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/deans-list-award/{course_code}/view-all-students-pdf', 'openPdfAll');
        Route::get('/deans-list-award/{course_code}/{year_level}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/deans-list-award/{course_code}', 'achieversView');
        Route::get('/deans-list-award/{course_code}/approve/{id}', 'approved');
        Route::get('/deans-list-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/deans-list-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/deans-list-award/{course_code}/update-status/{id}', 'update');
        Route::post('/deans-list-award/{course_code}/delete-form', 'destroy');
        Route::post('/deans-list-award/delete-form', 'destroy');
        Route::delete('/deans-list-award/{course_code}/bulk-delete-form', 'deleteAll');
        Route::delete('/deans-list-award/bulk-delete-form', 'deleteAll');
    });
    //PL Applicants
    Route::controller(App\Http\Controllers\Admin\Applicant\PLApplicantsController::class)->group(function () {
        Route::get('/presidents-list-award', 'index');
        Route::get('/presidents-list-award/overall', 'overallList');
        Route::get('/presidents-list-award/{course_code}/{year_level}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/presidents-list-award/{course_code}/view-all-students-pdf', 'openPdfAll');
        Route::get('/presidents-list-award/{course_code}/{year_level}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/presidents-list-award/{course_code}', 'achieversView');
        Route::get('/presidents-list-award/{course_code}/approve/{id}', 'approved');
        Route::get('/presidents-list-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/presidents-list-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/presidents-list-award/{course_code}/update-status/{id}', 'update');
        Route::post('/presidents-list-award/{course_code}/delete-form', 'destroy');
        Route::post('/presidents-list-award/delete-form', 'destroy');
        Route::delete('/presidents-list-award/{course_code}/bulk-delete-form', 'deleteAll');
        Route::delete('/presidents-list-award/bulk-delete-form', 'deleteAll');
    });
    //Academic Excellence Applicants
    Route::controller(App\Http\Controllers\Admin\Applicant\AEApplicantsController::class)->group(function () {
        Route::get('/academic-excellence-award', 'index');
        Route::get('/academic-excellence-award/overall', 'overallList');
        Route::get('/academic-excellence-award/{course_code}/{year_level}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/academic-excellence-award/{course_code}/view-all-students-pdf', 'openPdfAll');
        Route::get('/academic-excellence-award/{course_code}/{year_level}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/academic-excellence-award/{course_code}', 'achieversView');
        Route::get('/academic-excellence-award/{course_code}/approve/{id}', 'approved');
        Route::get('/academic-excellence-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/academic-excellence-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/academic-excellence-award/{course_code}/update-status/{id}', 'update');
        Route::post('/academic-excellence-award/{course_code}/delete-form', 'destroy');
        Route::post('/academic-excellence-award/delete-form', 'destroy');
        Route::delete('/academic-excellence-award/{course_code}/bulk-delete-form', 'deleteAll');
        Route::delete('/academic-excellence-award/bulk-delete-form', 'deleteAll');
    });
    //Non Academic Applicants
    Route::controller(App\Http\Controllers\Admin\Applicant\NAApplicantsController::class)->group(function () {
        Route::get('/non-academic-award', 'index');
        Route::get('/non-academic-award/all', 'overallList');
        Route::get('/non-academic-award/{nonacad_code}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/non-academic-award/{nonacad_code}/view-all-students-pdf', 'openPdfAll');
        Route::get('/non-academic-award/{nonacad_code}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/non-academic-award/{id}', 'view');
        Route::get('/non-academic-award/{nonacad_id}/{id}', 'details');
        Route::post('/non-academic-award/{nonacad_id}/delete-form', 'destroy');
        Route::get('/non-academic-award/{nonacad_id}/approve/{id}', 'approved');
        Route::get('/non-academic-award/{nonacad_id}/reject/{id}', 'rejected');
        Route::post('/non-academic-award/delete-form', 'destroy');
        Route::put('/non-academic-award/{nonacad_id}/update-status/{id}', 'update');
        Route::delete('/non-academic-award/bulk-delete-form', 'deleteAll');
    });
    //Activity Log
    Route::controller(App\Http\Controllers\Admin\ActivityLog\ActivityLogController::class)->group(function () {
        Route::get('/user-activity-log', 'index');
        Route::post('/delete-log', 'destroy');
        Route::delete('/bulk-delete-log', 'deleteAll');
    });
    //Import CSV
    Route::controller(App\Http\Controllers\Admin\CSV\ImportController::class)->group(function () {
        Route::get('/import-csv', 'index');
        Route::post('/import-csv/import-parse', 'parseImport');
        Route::post('/import-csv/import-process', 'processImport');
        Route::get('/parse-data', 'showParsed');
        Route::post('/delete-csv', 'destroy');
        Route::post('/delete-sis', 'destroySIS');
        Route::delete('/bulk-delete-data', 'deleteAll');
    });
    //Achievers Award Send Certificate
    Route::controller(App\Http\Controllers\Admin\Certificate\AACertificateController::class)->group(function () {
        Route::get('/send-awardees-certificates/achievers-award', 'index');
        Route::get('/send-awardees-certificates/achievers-award/{course_code}', 'view');
        Route::post('/send-awardees-certificates/achievers-award/{course_code}/send', 'sendEmail');
        Route::get('/send-awardees-certificates/achievers-award/{course_code}/{id}', 'showCertificate');
    });
    //DL Send Certificate
    Route::controller(App\Http\Controllers\Admin\Certificate\DLCertificateController::class)->group(function () {
        Route::get('/send-awardees-certificates/deans-list-award', 'index');
        Route::get('/send-awardees-certificates/deans-list-award/{course_code}', 'view');
        Route::post('/send-awardees-certificates/deans-list-award/{course_code}/send', 'sendEmail');
        Route::get('/send-awardees-certificates/deans-list-award/{course_code}/{id}', 'showCertificate');
    });
    //PL Send Certificate
    Route::controller(App\Http\Controllers\Admin\Certificate\PLCertificateController::class)->group(function () {
        Route::get('/send-awardees-certificates/presidents-list-award', 'index');
        Route::get('/send-awardees-certificates/presidents-list-award/{course_code}', 'view');
        Route::post('/send-awardees-certificates/presidents-list-award/{course_code}/send', 'sendEmail');
        Route::get('/send-awardees-certificates/presidents-list-award/{course_code}/{id}', 'showCertificate');
    });
    //Academic Excellence Send Certificate
    Route::controller(App\Http\Controllers\Admin\Certificate\AECertificateController::class)->group(function () {
        Route::get('/send-awardees-certificates/academic-excellence-award', 'index');
        Route::get('/send-awardees-certificates/academic-excellence-award/{course_code}', 'view');
        Route::post('/send-awardees-certificates/academic-excellence-award/{course_code}/send', 'sendEmail');
        Route::get('/send-awardees-certificates/academic-excellence-award/{course_code}/{id}', 'showCertificate');
    });
    //Non Academic Award Certificate
    Route::controller(App\Http\Controllers\Admin\Certificate\NACertificateController::class)->group(function () {
        Route::get('/send-awardees-certificates/non-academic-award', 'index');
        Route::get('/send-awardees-certificates/non-academic-award/{nonacad_id}', 'show');
        Route::post('/send-awardees-certificates/non-academic-award/{nonacad_id}/send', 'sendEmail');
        Route::get('/send-awardees-certificates/non-academic-award/{nonacad_id}/{id}', 'showCertificate');
    });
    //Gsllery
    Route::controller(App\Http\Controllers\Admin\Gallery\GalleryController::class)->group(function () {
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
    Route::controller(App\Http\Controllers\Admin\Calendar\FullCalendarController::class)->group(function () {
        Route::get('/calendar-events', 'index');
        Route::get('/calendar-events/calendar', 'calendar');
        Route::get('/calendar-events/create', 'create');
        Route::post('/calendar-events', 'store');
        Route::get('/calendar-events/{id}', 'edit');
        Route::put('/calendar-events/update/{id}', 'update');
        Route::post('/calendar-events/delete-event', 'destroy');
        Route::delete('/calendar-events/bulk-delete', 'deleteAll');
    });
    //Profile
    Route::controller(App\Http\Controllers\Admin\Profile\ProfileController::class)->group(function () {
        Route::get('/profile', 'index');
        Route::put('/update-profile/{id}', 'store');
    });
    //Password
    Route::controller(App\Http\Controllers\Admin\Password\ChangePassController::class)->group(function () {
        Route::get('/change-password', 'index');
        Route::post('/update-password', 'store');
    });

    //course M
    Route::controller(App\Http\Controllers\Admin\Maintenance\CourseController::class)->group(function () {
        Route::get('/maintenance/courses', 'index');
        Route::get('/maintenance/courses/create', 'create');
        Route::post('/maintenance/courses', 'store');
        Route::get('/maintenance/courses/{id}', 'edit');
        Route::put('/maintenance/courses/{id}', 'update');
        Route::post('/maintenance/delete-course', 'destroy');
        Route::delete('/maintenance/courses/bulk-delete', 'deleteAll');
    });
    //about M
    Route::controller(App\Http\Controllers\Admin\Maintenance\AboutController::class)->group(function () {
        Route::get('/maintenance/about', 'index');
        Route::get('/maintenance/about/preview', 'show');
        Route::put('/maintenance/about/{id}', 'update');
        Route::post('/maintenance/about/upload', 'upload')->name('ckeditor.upload');
    });
    // form m
    Route::controller(App\Http\Controllers\Admin\Maintenance\FormController::class)->group(function () {
        Route::get('/maintenance/form', 'index');
        Route::get('/maintenance/form/{id}', 'edit');
        Route::post('/maintenance/delete-reqs-form', 'destroy');
        Route::put('/maintenance/update-form/{id}', 'update');
    });
    //signatures
    Route::controller(App\Http\Controllers\Admin\Maintenance\SignatureController::class)->group(function () {
        Route::get('/maintenance/signatures', 'index');
        Route::get('/maintenance/signatures/create', 'create');
        Route::post('/maintenance/signature-store', 'store');
        Route::get('/maintenance/signatures/{id}', 'edit');
        Route::put('/maintenance/signatures/{id}', 'update');
        Route::get('/maintenance/signatures-cert/status/update', 'changeStatusCertificate');
        Route::get('/maintenance/signatures-report/status/update', 'changeStatusReports');
        Route::post('/maintenance/delete-signature', 'destroy');
    });
    //Recognition Records
    Route::controller(App\Http\Controllers\Admin\Records\RecordsController::class)->group(function () {
        Route::get('/records', 'index');
        Route::get('/records/view/{id}', 'show');
        Route::get('/records/create', 'create');
        Route::post('/records/media', 'storeMedia');
        Route::post('/records-store', 'store');
        Route::get('/records/{id}', 'edit');
        Route::put('/records-update/{id}', 'update');
        Route::post('/delete-records', 'destroy');
        Route::delete('/records/bulk-delete', 'deleteAll');
    });
    //Settings
    Route::controller(App\Http\Controllers\Admin\SystemSetting\SettingController::class)->group(function () {
        Route::get('/manage-settings', 'index');
        Route::put('/update-settings/{id}', 'update');
    });

    //Admin Notif
    Route::controller(App\Http\Controllers\Admin\Notification\NotificationController::class)->group(function () {
        Route::get('/deans-listers/{id}', 'showDL');
        Route::get('/presidents-listers/{id}', 'showPL');
        Route::get('/achiever-awardees/{id}', 'showAA');
        Route::get('/academic-excellence-awardees/{id}', 'showAE');
        Route::get('/non-academic-awardees/{id}', 'showNA');
        Route::get('/preview', 'markAsRead');
        Route::get('/all-notifications', 'index');
        Route::post('/delete-notification', 'destroy');
        Route::delete('/bulk-delete-notifications', 'destroyAll');
    });
});
Route::prefix('user')->middleware('auth', 'verified', 'isUser')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index']);

    Route::controller(App\Http\Controllers\User\Form\AcademicAwardController::class)->group(function () {
        Route::get('/application-form', 'index');
        Route::post('/application-form', 'store');
    });
    Route::controller(App\Http\Controllers\User\Form\AEAwardApplicationController::class)->group(function () {
        Route::get('/application-form-ae', 'index');
        Route::post('/application-form-ae', 'store');
    });
    Route::controller(App\Http\Controllers\User\Form\NonAcademicAwardController::class)->group(function () {
        Route::get('/non-academic-form', 'index');
        Route::post('/non-academic-form', 'store');
    });
    Route::controller(App\Http\Controllers\User\Status\ApplicationStatusController::class)->group(function () {
        Route::get('/application-status/academic-award', 'aaAward');
        Route::get('/application-status/academic-excellence', 'aeAward');
        Route::get('/application-status/non-academic-award', 'naAward');
    });
    Route::controller(App\Http\Controllers\User\Notification\NotificationController::class)->group(function () {
        Route::get('/preview/academic-award/{id}', 'showAA');
        Route::get('/preview/academic-excellence/{id}', 'showAE');
        Route::get('/preview/non-academic-award/{id}', 'showNA');
        Route::get('/preview', 'markAsRead');
        Route::get('/all-notifications', 'index');
        Route::post('/delete-notification', 'destroy');
        Route::delete('/bulk-delete-notifications', 'destroyAll');
    });
    Route::controller(App\Http\Controllers\User\Calendar\FullCalendarController::class)->group(function () {
        Route::get('/calendar', 'index');
        Route::get('/calendar/{id}', 'show');
    });
    Route::get('/gallery', [App\Http\Controllers\User\Gallery\GalleryController::class, 'index']);
    Route::get('/about', [App\Http\Controllers\User\About\AboutController::class, 'index']);
    Route::controller(App\Http\Controllers\User\Profile\ProfileController::class)->group(function () {
        Route::get('/profile', 'index');
        Route::put('/update-profile/{id}', 'store');
    });
    Route::controller(App\Http\Controllers\User\Password\ChangePassController::class)->group(function () {
        Route::get('/change-password', 'index');
        Route::post('/update-password', 'store');
    });
    Route::controller(App\Http\Controllers\User\Qrcode\QredirectController::class)->group(function () {
        Route::get('/check-qr/{id}', 'redirect');
    });
});
