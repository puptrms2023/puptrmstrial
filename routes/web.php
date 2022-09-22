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
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{id}', 'edit');
        Route::put('/update-users/{id}', 'update');
        Route::post('/delete-users', 'destroy');
    });
    Route::controller(App\Http\Controllers\Admin\StudentController::class)->group(function () {
        Route::get('/students', 'index');
        Route::get('/students/{id}', 'edit');
        Route::get('/students/view/{id}', 'show');
        Route::put('/update-student/{id}', 'update');
        Route::post('/delete-student', 'destroy');
    });
    Route::controller(App\Http\Controllers\Admin\StudentApplicantsController::class)->group(function () {
        Route::get('/achievers-award', 'index');
        Route::get('/achievers-award/{course_code}', 'achieversView');
        Route::get('/achievers-award/{course_code}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/achievers-award/{course_code}/view-all-students-pdf', 'openPdfAll');
        Route::get('/achievers-award/{course_code}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/achievers-award/{course_code}/approve/{id}', 'approved');
        Route::get('/achievers-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/achievers-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/achievers-award/{course_code}/update-status/{id}', 'update');
    });
    Route::controller(App\Http\Controllers\Admin\DLApplicantsController::class)->group(function () {
        Route::get('/deans-list-award', 'index');
        Route::get('/deans-list-award/{course_code}/{year_level}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/deans-list-award/{course_code}/view-approved-students-pdf', 'openPdfAll');
        Route::get('/deans-list-award/{course_code}/{year_level}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/deans-list-award/{course_code}', 'achieversView');
        Route::get('/deans-list-award/{course_code}/approve/{id}', 'approved');
        Route::get('/deans-list-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/deans-list-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/deans-list-award/{course_code}/update-status/{id}', 'update');
    });
    Route::controller(App\Http\Controllers\Admin\PLApplicantsController::class)->group(function () {
        Route::get('/presidents-list-award', 'index');
        Route::get('/presidents-list-award/{course_code}/{year_level}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/presidents-list-award/{course_code}/view-approved-students-pdf', 'openPdfAll');
        Route::get('/presidents-list-award/{course_code}/{year_level}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/presidents-list-award/{course_code}', 'achieversView');
        Route::get('/presidents-list-award/{course_code}/approve/{id}', 'approved');
        Route::get('/presidents-list-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/presidents-list-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/presidents-list-award/{course_code}/update-status/{id}', 'update');
    });
    Route::controller(App\Http\Controllers\Admin\AEApplicantsController::class)->group(function () {
        Route::get('/academic-excellence-award', 'index');
        Route::get('/academic-excellence-award/{course_code}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/academic-excellence-award/{course_code}/view-all-students-pdf', 'openPdfAll');
        Route::get('/academic-excellence-award/{course_code}/view-rejected-students-pdf', 'openPdfRejected');
        Route::get('/academic-excellence-award/{course_code}', 'achieversView');
        Route::get('/academic-excellence-award/{course_code}/approve/{id}', 'approved');
        Route::get('/academic-excellence-award/{course_code}/reject/{id}', 'rejected');
        // Route::get('/academic-excellence-award/{course_code}/{id}', 'studentApplicationView');
        // Route::put('/presidents-list-award/{course_code}/update-status/{id}', 'update');
    });
    Route::controller(App\Http\Controllers\Admin\UserManagementController::class)->group(function () {
        Route::get('/usermanagement', 'index');
    });
    Route::controller(App\Http\Controllers\Admin\ActivityLogController::class)->group(function () {
        Route::get('/user-activity-log', 'index');
    });
    Route::controller(App\Http\Controllers\Admin\ImportController::class)->group(function () {
        Route::get('/import-csv', 'index');
        Route::post('/import-csv/import-parse', 'parseImport');
        Route::post('/import-csv/import-process', 'processImport');
        Route::post('/delete-csv', 'destroy');
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

    Route::controller(App\Http\Controllers\User\ApplicationStatusController::class)->group(function () {
        Route::get('/application-status/academic-award', 'aaAward');
        Route::get('/application-status/academic-excellence', 'aeAward');
    });
});
