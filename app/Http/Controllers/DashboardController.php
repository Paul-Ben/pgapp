<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    protected $applicaationcount;
    protected $completedApplications;
    protected $incompleteApplications;
    public function __construct()
    {
        $this->middleware('auth');
        $this->applicaationcount = Applicant::count();
        $this->completedApplications = Applicant::where('status', 'completed')->count();
        $this->incompleteApplications = Applicant::where('status', 'incomplete')->count();
    }
    public function index()
    {
        $authUser = Auth::user();
        $applicaationcount = $this->applicaationcount;
        $completedApplications = $this->completedApplications;
        $incompleteApplications = $this->incompleteApplications;
        $applicants = Applicant::with('ApplicantInstitutionDetails')
            ->with('ApplicantsReferees')
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();
        return view('dashboard', compact('authUser', 'applicants', 'applicaationcount', 'completedApplications', 'incompleteApplications'));
    }

    public function showApplication($applicant)
    {
        $applicant = Applicant::with('ApplicantInstitutionDetails')
            ->with('ApplicantsReferees')
            ->findOrFail($applicant);
        return view('admin.report', compact('applicant'));
    }

    public function showCompletedApplications()
    {
        $applicaationcount = $this->applicaationcount;
        $completedApplications = $this->completedApplications;
        $incompleteApplications = $this->incompleteApplications;
        $applicants = Applicant::with('ApplicantInstitutionDetails')
            ->with('ApplicantsReferees')
            ->where('ref_completion_status', true)
            ->orderBy('updated_at', 'desc')
            ->get();
        
        return view('admin.completed_applications', compact('applicants', 'applicaationcount', 'completedApplications', 'incompleteApplications'));
    }

    // public function downloadCompletedApplications()
    // {
    //     $completed = \App\Models\Applicant::where('status', 'completed')->get();

    //     $csvHeader = ['Application No', 'Full Name', 'Email', 'Phone', 'Gender', 'Nationality', 'State', 'LGA', 'Application Date'];
    //     $filename = 'completed_applications_' . now()->format('Ymd_His') . '.csv';

    //     $handle = fopen('php://temp', 'r+');
    //     fputcsv($handle, $csvHeader);

    //     foreach ($completed as $applicant) {
    //         fputcsv($handle, [
    //             $applicant->appno,
    //             $applicant->fullname,
    //             $applicant->email_address,
    //             $applicant->phone_no,
    //             $applicant->sex,
    //             $applicant->country,
    //             $applicant->state_of_origin,
    //             $applicant->lga,
    //             $applicant->updated_at,
    //         ]);
    //     }

    //     rewind($handle);
    //     $csv = stream_get_contents($handle);
    //     fclose($handle);

    //     return Response::make($csv, 200, [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => "attachment; filename=\"$filename\"",
    //     ]);
    // }

    // public function downloadCompletedApplications()
    // {
    //     $completed = \App\Models\Applicant::with(['ApplicantInstitutionDetails', 'ApplicantsReferees'])
    //         ->where('status', 'completed')
    //         ->get();

    //     $csvHeader = [
    //         'Application No',
    //         'Full Name',
    //         'Email',
    //         'Phone',
    //         'Gender',
    //         'Nationality',
    //         'State',
    //         'LGA',
    //         'Application Date',
    //         'Institutions',
    //         'Referees'
    //     ];
    //     $filename = 'completed_applications_' . now()->format('Ymd_His') . '.csv';

    //     $handle = fopen('php://temp', 'r+');
    //     fputcsv($handle, $csvHeader);

    //     foreach ($completed as $applicant) {
    //         // Flatten institution details
    //         $institutions = $applicant->ApplicantInstitutionDetails->map(function ($inst) {
    //             return "{$inst->institution_name} ({$inst->certificate_awarded}, {$inst->field_of_study}, {$inst->date_started} - {$inst->date_ended})";
    //         })->implode(' | ');

    //         // Flatten referee details
    //         $referees = $applicant->ApplicantsReferees->map(function ($ref) {
    //             return "{$ref->fullname} ({$ref->email_address}, {$ref->phone_no}, {$ref->rank})";
    //         })->implode(' | ');

    //         fputcsv($handle, [
    //             $applicant->appno,
    //             $applicant->fullname,
    //             $applicant->email_address,
    //             $applicant->phone_no,
    //             $applicant->sex,
    //             $applicant->country,
    //             $applicant->state_of_origin,
    //             $applicant->lga,
    //             $applicant->updated_at,
    //             $institutions,
    //             $referees,
    //         ]);
    //     }

    //     rewind($handle);
    //     $csv = stream_get_contents($handle);
    //     fclose($handle);

    //     return Response::make($csv, 200, [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => "attachment; filename=\"$filename\"",
    //     ]);
    // }

    public function downloadCompletedApplications()
    {
        $completed = \App\Models\Applicant::with(['ApplicantInstitutionDetails', 'ApplicantsReferees'])
            ->where('status', 'completed')
            ->get();

        $csvHeader = [
            'Sr No',
            'Application No',
            'Full Name',
            'Email',
            'Phone',
            'Gender',
            'Nationality',
            'State',
            'LGA',
            'Application Date',
            'Institutions',
            'Referees'
        ];
        $filename = 'completed_applications_' . now()->format('Ymd_His') . '.csv';

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);
        $counter = 1;
        foreach ($completed as $applicant) {
            // Flatten institution details
            $institutions = $applicant->ApplicantInstitutionDetails->map(function ($inst) {
                return "{$inst->institution_name} ({$inst->certificate_awarded}, {$inst->field_of_study}, {$inst->date_started} - {$inst->date_ended})";
            })->implode(' | ');

            // Flatten referee details: only name and recommendation status
            $referees = $applicant->ApplicantsReferees->map(function ($ref) {
                $recommendation = ($ref->recommendation_status == 1) ? 'Recommended' : 'Not Recommended';
                return "{$ref->fullname} ({$recommendation})";
            })->implode(' | ');

            fputcsv($handle, [
                $counter++, // Add serial number
                $applicant->appno,
                $applicant->fullname,
                $applicant->email_address,
                $applicant->phone_no,
                $applicant->sex,
                $applicant->country,
                $applicant->state_of_origin,
                $applicant->lga,
                $applicant->updated_at,
                $institutions,
                $referees,
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
