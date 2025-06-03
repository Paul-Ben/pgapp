<?php

namespace App\Http\Controllers;

use App\Mail\RefereeNotificationMail;
use App\Models\Applicant;
use App\Models\ApplicantInstitutionDetail;
use App\Models\ApplicantsReferee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PgApplicationController extends Controller
{
    public function index($appno)
    {
        $applicant = Applicant::where('appno', $appno)->first();
        // dd($applicant);
        if (!$applicant) {
            return view('pg.applicant_notfound', ['appno' => $appno])
                ->with('error', 'Applicant not found. Please check your application number.');
        }
        if ($applicant->status == 'Completed') {
            return view('pg.applicationsubmitted', compact('applicant'))
                ->with('success', 'Application already completed.');
        }

        return view("pg.index", ['applicant' => $applicant]);
    }

    /**
     * Update the applicant's information.
     */
    public function update(Request $request, $appno)
    {
        $applicant = Applicant::where('appno', $appno)->first();
        // dd($applicant);
        if ($applicant->status == 'Completed') {
            return view('pg.applicationsubmitted', compact('applicant'))
                ->with('success', 'Application already completed.');
        }
        // Validate the incoming request data
        $validated = $request->validate([
            'application_type' => 'nullable|string|max:50',
            'fullname' => 'nullable|string|max:75',
            'email_address' => 'nullable|email|max:21',
            'sex' => 'nullable|string|max:6',
            'date_of_birth' => 'nullable|date',
            'state_of_origin' => 'nullable|string|max:50',
            'lga' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:50',
            'home_town' => 'nullable|string|max:7',
            'contact_address' => 'nullable|string|max:52',
            'phone_no' => 'nullable|string|max:20',
        ]);

        // Find the applicant by application number
        $applicant = Applicant::where('appno', $appno)->first();

        if ($applicant->status == 'Completed') {
            return view('pg.applicationsubmitted', compact('applicant'))
                ->with('success', 'Application already completed.');
        }
        // Update the applicant's information
        $applicant->update($validated);

        // Redirect back with a success message
        return redirect()->route('institution_details.form', $appno)
            ->with('success', 'Applicant information updated successfully.');
    }

    public function refreeDataForm($appno)
    {
        $applicant = Applicant::where('appno', $appno)->first();
        $count = ApplicantsReferee::where('applicants_id', $appno)->count();
        if ($count < 1 || $count == 1) {
            return view("pg.referee_data", ['applicant' => $applicant, 'count' => $count]);
        }
        return redirect()->route('presubmission', $appno);
    }
    public function store(Request $request)
    {
        $applicant_id = $request->applicants_id;
        $applicant = Applicant::where('appno', $applicant_id)->first();

        if ($applicant->status == 'Completed') {
            return view('pg.applicationsubmitted', compact('applicant'))
                ->with('success', 'Application already completed.');
        }

        $validated = $request->validate([
            'applicants_id' => 'required|string|max:14',
            'fullname' => 'required|string|max:75',
            'phone_no' => 'required|string|max:11',
            'email_address' => 'required|email|max:100',
            'rank' => 'required|string|max:45',

        ]);

        ApplicantsReferee::create($validated);


        $count = ApplicantsReferee::where('applicants_id', $applicant_id)->count();
        if ($count == 1) {
            $applicant->update([
                'refereers_needed' => 1,
            ]);
        }
        if ($count == 2) {
            $applicant->update([
                'refereers_needed' => 0,
                'ref_completion_status' => 1,
            ]);
        }

        if ($count < 2) {
            return redirect()->back()->with([
                'success' => 'Referee information submitted successfully.',
                'success' => 'Please add another referee with a different email.',
            ]);
        }
        // update the Applicant table to and 
        $applicant->update([
            'date_completed' => now(),
            'status' => 'Completed',
        ]);
        $credentials = DB::table('applicants')
            ->where('appno', $applicant_id)
            ->select('credentials', 'passport')
            ->first();
        $institutionDetails = DB::table('applicant_institution_details')
            ->where('applicants_id', $applicant_id)
            ->get();
        $referees = DB::table('applicantsReferees')
            ->where('applicants_id', $applicant_id)
            ->get();
        return view('pg.presubmission', compact('applicant', 'institutionDetails', 'referees', 'credentials'));

        // return view('pg.report');
    }

    public function get_institute_details($appno)
    {
        $applicant_detail = ApplicantInstitutionDetail::where('applicants_id', $appno)->first();
        return view('pg.institution_details', ['appplicant_detail' => $applicant_detail, 'appno' => $appno]);
    }

    public function store_institution_details(Request $request)
    {
        $validated = $request->validate([
            'applicants_id' => 'required|string|max:14',
            'institutions.*.institution_name' => 'required|string|max:255',
            'institutions.*.certificate_awarded' => 'required|string|max:100',
            'institutions.*.field_of_study' => 'required|string|max:100',
            'institutions.*.date_started' => 'required|date',
            'institutions.*.date_ended' => 'required|date|after_or_equal:institutions.*.date_started',
        ]);

        // Loop through the institutions and save each one
        foreach ($request->institutions as $institution) {
            ApplicantInstitutionDetail::create([
                'applicants_id' => $request->applicants_id,
                'institution_name' => $institution['institution_name'],
                'certificate_awarded' => $institution['certificate_awarded'],
                'field_of_study' => $institution['field_of_study'],
                'date_started' => $institution['date_started'],
                'date_ended' => $institution['date_ended'],
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('institution_details.edit', $request->applicants_id)
            ->with('success', 'Institution details saved successfully.');
    }

    /**
     * Show the edit view with existing institution details.
     */
    public function edit($applicants_id)
    {
        // Fetch all institution details for the given applicant
        $institutionDetails = ApplicantInstitutionDetail::where('applicants_id', $applicants_id)->get();

        return view('pg.edit_institution_details', compact('institutionDetails', 'applicants_id'));
    }

    public function updateInstitutionDetails(Request $request, $applicants_id)
    {
        $validated = $request->validate([
            'institutions.*.institution_name' => 'required|string|max:255',
            'institutions.*.certificate_awarded' => 'required|string|max:100',
            'institutions.*.field_of_study' => 'required|string|max:100',
            'institutions.*.date_started' => 'required|date',
            'institutions.*.date_ended' => 'required|date|after_or_equal:institutions.*.date_started',
        ]);

        // Delete existing records for the applicant
        ApplicantInstitutionDetail::where('applicants_id', $applicants_id)->delete();

        // Save updated records
        foreach ($request->institutions as $institution) {
            ApplicantInstitutionDetail::create([
                'applicants_id' => $applicants_id,
                'institution_name' => $institution['institution_name'],
                'certificate_awarded' => $institution['certificate_awarded'],
                'field_of_study' => $institution['field_of_study'],
                'date_started' => $institution['date_started'],
                'date_ended' => $institution['date_ended'],
            ]);
        }

        return redirect()->route('documents.upload', $applicants_id)
            ->with('success', 'Institution details updated successfully.');
    }

    public function show_upload_form($applicants_id)
    {
        $credentials = DB::table('applicants')
            ->where('appno', $applicants_id)
            ->select('credentials', 'passport')
            ->first();

        // dd($credentials);
        return view('pg.applicant_uploads', compact('applicants_id', 'credentials'));
    }


    public function store_credential_passport(Request $request)
    {
        $request->validate([
            'applicants_id' => 'required|exists:applicants,appno',
            'credentials' => 'required|file|mimes:pdf|max:2048', // 2MB
            'passport' => 'required|file|image|max:300', // 300KB
        ]);

        $applicantId = $request->input('applicants_id');


        $credentialsUrl = null;
        $passportUrl = null;

        // Handle credentials PDF
        if ($request->hasFile('credentials')) {
            $credentialsFile = $request->file('credentials');
            $credentialsName = $applicantId . '.pdf';
            $credentialsFile->storeAs('credentials', $credentialsName, 'public');
            $credentialsUrl = Storage::url('credentials/' . $credentialsName);
        }

        // Handle passport image
        if ($request->hasFile('passport')) {
            $passportFile = $request->file('passport');
            $passportExt = $passportFile->getClientOriginalExtension();
            $passportName = $applicantId . '.' . $passportExt;
            $passportFile->storeAs('passports', $passportName, 'public');
            $passportUrl = Storage::url('passports/' . $passportName);
        }
        // Update the applicants table
        DB::table('applicants')
            ->where('appno', $applicantId)
            ->update([
                'credentials' => $credentialsUrl,
                'passport' => $passportUrl,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Files uploaded and applicant updated successfully.');
    }

    public function view_report($applicants_id)
    {
        $applicant = DB::table('applicants')
            ->where('appno', $applicants_id)
            ->first();

        $institutionDetails = DB::table('applicant_institution_details')
            ->where('applicants_id', $applicants_id)
            ->get();

        $referees = DB::table('applicantsreferees')
            ->where('applicants_id', $applicants_id)
            ->get();

        return view('pg.report', compact('applicant', 'institutionDetails', 'referees'));
    }

    public function presubmission($applicant_id)
    {
        $refereesmail = DB::table('applicantsreferees')
            ->where('applicants_id', $applicant_id)
            ->get('mail_sent');
        // Check if all referees have been notified
        // $allRefereesNotified = $refereesmail->every(function ($referee) {
        //     return $referee->mail_sent == 1;
        // });
        // if ($refereesmail) {
        //     return view('pg.applicationsubmitted', ['applicant_id' => $applicant_id])
        //         ->with('success', 'Application already completed.');
        // }


        $applicant = DB::table('applicants')
            ->where('appno', $applicant_id)
            ->first();

        $institutionDetails = DB::table('applicant_institution_details')
            ->where('applicants_id', $applicant_id)
            ->get();

        $referees = DB::table('applicantsreferees')
            ->where('applicants_id', $applicant_id)
            ->get();

        return view('pg.presubmission', compact('applicant', 'institutionDetails', 'referees'));
    }
    // public function updatep(Request $request, $applicant_id)
    // {
    //     $validated = $request->validate([
    //         'status' => 'required|string|max:50',
    //     ]);

    //     // Update the applicant's status
    //     DB::table('applicants')
    //         ->where('appno', $applicant_id)
    //         ->update($validated);

    //     return redirect()->route('report.view', $applicant_id)
    //         ->with('success', 'Application status updated successfully.');
    // }


    public function updatePresubmission(Request $request, $appno)
    {
        $referees = ApplicantsReferee::where('applicants_id', $appno)->get();
        $refereesmail = ApplicantsReferee::where('applicants_id', $appno)->get('mail_sent');
        // Check if all referees have been notified
        $allRefereesNotified = $refereesmail->every(function ($referee) {
            return $referee->mail_sent == 1;
        });
        $applicant = Applicant::where('appno', $appno)->first();
        if ($allRefereesNotified) {
            return view('pg.applicationsubmitted', ['applicant' => $applicant])
                ->with('success', 'Application already completed.');
        }
        DB::beginTransaction();

        try {
            // Find the applicant
            $applicant = Applicant::where('appno', $appno)->firstOrFail();

            // Update passport photo if uploaded
            if ($request->hasFile('passport')) {
                if (!empty($applicant->passport)) {
                    // Remove the storage URL prefix to get the relative path
                    $oldPath = str_replace('/storage/', '', $applicant->passport);
                    Storage::disk('public')->delete($oldPath);
                }
                $passportFile = $request->file('passport');
                $passportExt = $passportFile->getClientOriginalExtension();
                $passportName = $appno . '.' . $passportExt;
                $passportFile->storeAs('passports', $passportName, 'public');
                $passportUrl = Storage::url('passports/' . $passportName);
            }



            // Update applicant personal info
            $applicant->fullname = $request->input('fullname');
            $applicant->sex = $request->input('sex');
            $applicant->date_of_birth = $request->input('date_of_birth');
            $applicant->phone_no = $request->input('phone_no');
            $applicant->email_address = $request->input('email_address');
            $applicant->country = $request->input('country');
            $applicant->state_of_origin = $request->input('state_of_origin');
            $applicant->lga = $request->input('lga');
            $applicant->contact_address = $request->input('contact_address');
            $applicant->passport = $passportUrl ?? $applicant->passport;
            $applicant->save();

            // Update institutions
            ApplicantInstitutionDetail::where('applicants_id', $appno)->delete();
            if ($request->has('institutions')) {
                foreach ($request->input('institutions') as $institution) {
                    ApplicantInstitutionDetail::create([
                        'applicants_id' => $appno,
                        'institution_name' => $institution['institution_name'] ?? '',
                        'field_of_study' => $institution['field_of_study'] ?? '',
                        'date_started' => $institution['date_started'] ?? null,
                        'date_ended' => $institution['date_ended'] ?? null,
                        'certificate_awarded' => $institution['certificate_awarded'] ?? '',
                    ]);
                }
            }

            // Update referees
            ApplicantsReferee::where('applicants_id', $appno)->delete();
            if ($request->has('referees')) {
                foreach ($request->input('referees') as $referee) {
                    ApplicantsReferee::create([
                        'applicants_id' => $appno,
                        'fullname' => $referee['fullname'] ?? '',
                        'email_address' => $referee['email_address'] ?? '',
                        'phone_no' => $referee['phone_no'] ?? '',
                        'rank' => $referee['rank'] ?? '',
                    ]);
                }
            }

            DB::commit();

            $referees = ApplicantsReferee::where('applicants_id', $appno)->get();

            foreach ($referees as $referee) {

                if (!empty($referee->email_address)) {
                    Mail::to($referee->email_address)->send(new RefereeNotificationMail($referee, $applicant));
                }
                ApplicantsReferee::where('applicants_id', $appno)
                    ->where('id', $referee->id)
                    ->update(['mail_sent' => 1]);
            }

            return redirect()->route('report.view', $appno)
                ->with('success', 'Application status updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to update application: ' . $e->getMessage()]);
        }
    }

    public function refereeSubmission(ApplicantsReferee $referee)
    {
        $referee = ApplicantsReferee::findOrFail($referee->id);

        $applicant = Applicant::where('appno', $referee->applicants_id)->first();

        return view('pg.referee_submission', compact('applicant', 'referee'));
    }
    public function storeRefereeSubmission(Request $request, $applicants_id)
    {
    
        $validated = $request->validate([
            'applicants_id' => 'required|string|max:14',
            'note' => 'required|string|max:500',
            'recommendation_status' => 'required|string|max:50',
        ]);
        $applicant = Applicant::findOrFail($applicants_id);
        // Update the referee submission
        ApplicantsReferee::where('applicants_id', $applicants_id)->where('id', $request->referee_id)->update([
            'note' => $validated['note'],
            'recommendation_status' => $validated['recommendation_status'],
            'date_commented' => now(),
        ]);

        // Update the applicant's status to Completed
        Applicant::where('appno', $applicants_id)->update([
            'status' => 'Completed',
            'date_completed' => now(),
        ]);

        return view('pg.thankyou', ['applicant' => $applicant])
            ->with('success', 'Referee submission updated successfully.');
    }
}
