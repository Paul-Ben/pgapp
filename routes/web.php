<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PgApplicationController;

// Route::get('/', function () {
//     return view('auth.login');
// });
// Verification and application routes
Route::get('/', [PgApplicationController::class, 'verify'])->name('applicant.verify');
Route::get('/programme-info/{code}', [PgApplicationController::class, 'getProgrammeInfo']);
Route::post('/applicant/verify', [PgApplicationController::class, 'verifyApplicant'])->name('applicant.verify.submit');
Route::get('/applicant/{appno}', [PgApplicationController::class,'index'])->name('application.index');
Route::get('/programme', [PgApplicationController::class, 'showByName']);
Route::put('/applicant/{appno}', [PgApplicationController::class,'update'])->name('application.update');
Route::get('/referees/{appno}', [PgApplicationController::class, 'refreeDataForm'])->name('referees.form');
Route::post('/referees', [PgApplicationController::class, 'store'])->name('referees.store');
Route::get('/referee-report/{referee}', [PgApplicationController::class, 'refereeSubmission'])->name('referee.submissionForm');
Route::put('/referee-report/{applicants_id}', [PgApplicationController::class, 'storeRefereeSubmission'])->name('referee.submission.store');
Route::get('/applicant/{appno}/programme', [PgApplicationController::class, 'programmeForm'])->name('programme.form');
Route::post('/applicant/programme', [PgApplicationController::class, 'storeProgramme'])->name('programme.store');

Route::get('/institution-details/{appno}', [PgApplicationController::class, 'get_institute_details'])->name('institution_details.form');
Route::post('/institution-details', [PgApplicationController::class, 'store_institution_details'])->name('institution_details.store');
Route::get('/institution-details/{applicants_id}/edit', [PgApplicationController::class, 'edit'])->name('institution_details.edit');
Route::put('/institution-details/{applicants_id}', [PgApplicationController::class, 'updateInstitutionDetails'])->name('institution_details.update');
Route::get('/applicants-uploads/{applicants_id}', [PgApplicationController::class, 'show_upload_form'])->name('documents.upload');
Route::put('/applicant-uploads/{applicants_id}', [PgApplicationController::class, 'store_credential_passport'])->name('document.upload');
Route::get('/applicant-report/{applicant_id}', [PgApplicationController::class, 'view_report'])->name('report.view');

Route::get('/pre_submission/{applicant_id}',   [PgApplicationController::class, 'presubmission'])->name('presubmission');
Route::put('/pre_submission/{applicant_id}/submit', [PgApplicationController::class, 'updatePresubmission'])->name('presubmission.update');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/dashboard/all/applicants', [DashboardController::class,'allApplicants'])->name('all.applicants');
    Route::get('/dashboard/applicants/{appno}', [DashboardController::class,'editApplicant'])->name('applicant.edit');
    Route::put('/dashboard/applicants/{appno}', [DashboardController::class,'updateApplicant'])->name('applicant.update');
    Route::get('/dashboard/applicant/{appno}', [DashboardController::class,'showApplication'])->name('applicant.show');
    Route::get('/dashboard/completed_applications', [DashboardController::class,'showCompletedApplications'])->name('completed.applications');
    Route::get('/dashboard/incomplete_applications', [DashboardController::class,'showIncompleteApplications'])->name('incomplete.applications');
    Route::get('/admin/completed-applications/download', [DashboardController::class, 'downloadCompletedApplications'])->name('completed.applications.download');
});

require __DIR__.'/auth.php';
