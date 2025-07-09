<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PgApplicationController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\SupportController;

// Route::get('/', function () {
//     return view('auth.login');
// });
// Verification and application routes
Route::get('/', [PgApplicationController::class, 'verify'])->name('applicant.verify');
Route::get('/programme-info/{code}', [PgApplicationController::class, 'getProgrammeInfo']);
Route::post('/applicant/verify', [PgApplicationController::class, 'verifyApplicant'])->name('applicant.verify.submit');
Route::get('/applicant/{appno}', [PgApplicationController::class,'index'])->name('application.index');
// Route::get('/programme', [PgApplicationController::class, 'showByName']);
Route::get('/programme-details', [PgApplicationController::class, 'getProgrammeDetails'])->name('programme.details');
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

// Complaint routes
Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
Route::get('/complaints/{complaint}/success', [ComplaintController::class, 'success'])->name('complaints.success');

// Ticket status check routes
Route::get('/check-status', [ComplaintController::class, 'showCheckStatus'])->name('complaints.show-status');
Route::post('/check-status', [ComplaintController::class, 'checkStatus'])->name('complaints.check-status');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:PG Admin'])->group(function () {
   
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/dashboard/all/applicants', [DashboardController::class,'allApplicants'])->name('all.applicants');
    Route::get('/dashboard/applicants/{appno}', [DashboardController::class,'editApplicant'])->name('applicant.edit');
    Route::put('/dashboard/applicants/{appno}', [DashboardController::class,'updateApplicant'])->name('applicant.update');
    Route::get('/dashboard/applicant/{appno}', [DashboardController::class,'showApplication'])->name('applicant.show');
    Route::get('/dashboard/completed_applications', [DashboardController::class,'showCompletedApplications'])->name('completed.applications');
    Route::get('/dashboard/incomplete_applications', [DashboardController::class,'showIncompleteApplications'])->name('incomplete.applications');
    Route::get('/admin/completed-applications/download', [DashboardController::class, 'downloadCompletedApplications'])->name('completed.applications.download');
    Route::get('/dashboard/applicant/report/{appno}', [DashboardController::class, 'showReport'])->name('report_view');

    // Faculty routes
    Route::get('/dashboard/faculties', [ DashboardController::class, 'getFaculties'])->name('faculties');
    Route::get('/dashboard/faculties/add', [DashboardController::class, 'addFacultyForm'])->name('faculty.add');
    Route::post('/dashboard/faculties', [ DashboardController::class, 'storeFaculty'])->name('faculty.store');
    Route::get('/dashboard/faculties/{faculty_id}', [ DashboardController::class, 'editFaculty'])->name('faculty.edit');
    Route::put('/dashboard/faculties/{faculty}', [ DashboardController::class, 'updateFaculty'])->name('faculty.update');
    Route::delete('/dashboard/faculties/{faculty}', [DashboardController::class, 'deleteFaculty'])->name('faculty.delete');

    // Department routes
    Route::get('/dashboard/departments', [ DashboardController::class, 'getDepartments'])->name('departments');
    Route::get('/dashboard/departments/add', [DashboardController::class, 'addDepartmentForm'])->name('department.add');
    Route::post('/dashboard/departments/store', [ DashboardController::class, 'storeDepartment'])->name('department.store');
    Route::get('/dashboard/departments/{department_id}', [ DashboardController::class, 'editDepartment'])->name('department.edit');
    Route::put('/dashboard/departments/{department}', [ DashboardController::class, 'updateDepartment'])->name('department.update');
    Route::delete('/dashboard/departments/{department}', [DashboardController::class, 'deleteDepartment'])->name('department.delete');
    Route::get('/dashboard/faculties/{faculty_id}/add-programme', [ DashboardController::class, 'addProgrammeForm'])->name('programme.add');

    // Programme routes
    Route::get('/dashboard/programmes', [ DashboardController::class, 'getProgrammes'])->name('programmes');
    Route::get('/dashboard/programmes/add', [DashboardController::class, 'addProgrammeForm'])->name('programme.add');
    Route::post('/dashboard/programmes', [ DashboardController::class, 'storeProgramme'])->name('programme.store');
    Route::get('/dashboard/programmes/{programme_id}', [ DashboardController::class, 'editProgramme'])->name('programme.edit');
    Route::put('/dashboard/programmes/{programme}', [ DashboardController::class, 'updateProgramme'])->name('programme.update');
    Route::delete('/dashboard/programmes/{programme}', [DashboardController::class, 'deleteProgramme'])->name('programme.delete');
});

// Superadmin dashboard routes
Route::middleware(['auth', 'role:Superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperadminController::class,'dashboard'])->name('superadmin.dashboard');
     Route::get('/superadmin/dashboard', [SuperadminController::class, 'index'])->name('superadmin.dashboard');
        Route::post('/superadmin/users', [SuperadminController::class, 'store'])->name('superadmin.users.store');
        Route::put('/superadmin/users/{user}', [SuperadminController::class, 'update'])->name('superadmin.users.update');
        Route::delete('/superadmin/users/{user}', [SuperadminController::class, 'destroy'])->name('superadmin.users.destroy');
});

// Support admin dashboard routes
Route::middleware(['auth', 'role:Support Admin'])->group(function () {
    Route::get('/support/dashboard', [SupportController::class,'dashboard'])->name('support.dashboard');
    Route::patch('/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus'])
        ->name('complaints.update-status');
    Route::get('complaint/{complaint}/show', [ComplaintController::class,'show'])->name('show.complaint');
});

require __DIR__.'/auth.php';
