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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
    Route::controller(App\Http\Controllers\Admin\StudentApplicantsController::class)->group(function () {
        Route::get('/achievers-award', 'index');
        Route::get('/achievers-award/{course_code}', 'achieversView');
        Route::get('/achievers-award/{course_code}/{year_level}/view-approved-students-pdf', 'openPdfApproved');
        Route::get('/achievers-award/{course_code}/{year_level}/view-rejected-students-pdf', 'openPdfRejected');
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
        Route::get('/presidents-list-award/{course_code}', 'achieversView');
        Route::get('/presidents-list-award/{course_code}/approve/{id}', 'approved');
        Route::get('/presidents-list-award/{course_code}/reject/{id}', 'rejected');
        Route::get('/presidents-list-award/{course_code}/{id}', 'studentApplicationView');
        Route::put('/presidents-list-award/{course_code}/update-status/{id}', 'update');
    });
    Route::controller(App\Http\Controllers\Admin\AEApplicantsController::class)->group(function () {
        Route::get('/academic-excellence-award', 'index');
        // Route::get('/presidents-list-award/{course_code}', 'achieversView');
        // Route::get('/presidents-list-award/{course_code}/approve/{id}', 'approved');
        // Route::get('/presidents-list-award/{course_code}/reject/{id}', 'rejected');
        // Route::get('/presidents-list-award/{course_code}/{id}', 'studentApplicationView');
        // Route::put('/presidents-list-award/{course_code}/update-status/{id}', 'update');
    });
    Route::controller(App\Http\Controllers\Admin\UserManagementController::class)->group(function () {
        Route::get('/usermanagement', 'index');
        // Route::get('/presidents-list-award/{course_code}', 'achieversView');
        // Route::get('/presidents-list-award/{course_code}/approve/{id}', 'approved');
        // Route::get('/presidents-list-award/{course_code}/reject/{id}', 'rejected');
        // Route::get('/presidents-list-award/{course_code}/{id}', 'studentApplicationView');
        // Route::put('/presidents-list-award/{course_code}/update-status/{id}', 'update');
    });
});
Route::prefix('user')->middleware('auth', 'isUser')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index']);

    Route::controller(App\Http\Controllers\User\AwardApplicationController::class)->group(function () {
        Route::get('/application-form', 'index');
        Route::post('/application-form', 'store');
    });
    Route::controller(App\Http\Controllers\User\PlAwardApplicationController::class)->group(function () {
        Route::get('/application-form-pl', 'index');
        Route::post('/application-form-pl', 'store');
    });
    Route::controller(App\Http\Controllers\User\DlAwardApplicationController::class)->group(function () {
        Route::get('/application-form-dl', 'index');
        Route::post('/application-form-dl', 'store');
    });

    Route::controller(App\Http\Controllers\User\ApplicationStatusController::class)->group(function () {
        Route::get('/application-status', 'index');
    });
});
