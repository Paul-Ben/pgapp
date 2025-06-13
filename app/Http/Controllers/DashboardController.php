<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantInstitutionDetail;
use App\Models\ApplicantsReferee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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

    public function allApplicants()
    {
        $authUser = Auth::user();
        $applicaationcount = $this->applicaationcount;
        $completedApplications = $this->completedApplications;
        $incompleteApplications = $this->incompleteApplications;
        $applicants = Applicant::with('ApplicantInstitutionDetails')
            ->with('ApplicantsReferees')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('admin.total_applications', compact('authUser', 'applicants', 'applicaationcount', 'completedApplications', 'incompleteApplications'));
    }

    public function editApplicant($appno)
    {
        $authUser = Auth::user();
        $refereesmail = DB::table('applicantsreferees')
            ->where('applicants_id', $appno)
            ->get('mail_sent');

        $applicant = DB::table('applicants')
            ->where('appno', $appno)
            ->first();

        $institutionDetails = DB::table('applicant_institution_details')
            ->where('applicants_id', $appno)
            ->get();

        $referees = DB::table('applicantsreferees')
            ->where('applicants_id', $appno)
            ->get();

        $programmes = DB::table('programmes')
            ->select('name', 'code')
            ->get();
        $faculties = DB::table('faculties')
            ->select('name', 'code')
            ->get();
        $departments = DB::table('departments')
            ->select('name', 'code')
            ->get();
        return view('admin.edit_application', compact('authUser', 'applicant', 'institutionDetails', 'referees', 'refereesmail', 'programmes', 'faculties', 'departments'));
    }

    public function updateApplicant(Request $request, $appno)
    {
        $referees = ApplicantsReferee::where('applicants_id', $appno)->get();



        DB::beginTransaction();
        try {
            $applicant = Applicant::where('appno', $appno)->firstOrFail();
            $passportUrl = $applicant->passport; // Initialize with current value

            if ($request->hasFile('passport')) {
                if (!empty($applicant->passport)) {
                    $oldPath = str_replace('/storage/', '', $applicant->passport);
                    Storage::disk('public')->delete($oldPath);
                }
                $passportFile = $request->file('passport');
                $passportExt = $passportFile->getClientOriginalExtension();
                $passportName = $appno . '.' . $passportExt;
                $passportFile->storeAs('passports', $passportName, 'public');
                $passportUrl = Storage::url('passports/' . $passportName);
            }

            $applicant->update([
                'fullname' => $request->input('fullname'),
                'sex' => $request->input('sex'),
                'date_of_birth' => $request->input('date_of_birth'),
                'phone_no' => $request->input('phone_no'),
                'email_address' => $request->input('email_address'),
                'country' => $request->input('country'),
                'state_of_origin' => $request->input('state_of_origin'),
                'lga' => $request->input('lga'),
                'contact_address' => $request->input('contact_address'),
                'passport' => $passportUrl ?? $applicant->passport,
                'first_choice' => $request->input('first_choice'),
                'qualification' => $request->input('qualification'),
                'faculty' => $request->input('faculty'),
                'department' => $request->input('department'),
            ]);

            // Handle institutions
            if ($request->has('institutions')) {
                ApplicantInstitutionDetail::where('applicants_id', $appno)->delete();
                $institutions = collect($request->input('institutions'))->map(function ($institution) use ($appno) {
                    return array_merge($institution, [
                        'applicants_id' => $appno,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                })->toArray();

                DB::table('applicant_institution_details')->insert($institutions);
            }

            // Handle referees
            if ($request->has('referees')) {
                ApplicantsReferee::where('applicants_id', $appno)->delete();
                $refereesData = collect($request->input('referees'))->map(function ($referee) use ($appno) {
                    return array_merge($referee, [
                        'applicants_id' => $appno,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                })->toArray();

                DB::table('applicantsreferees')->insert($refereesData);
            }

            DB::commit();
            return redirect()->route('report.view', $appno)
                ->with('success', 'Application status updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to update application: ' . $e->getMessage()]);
        }
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
