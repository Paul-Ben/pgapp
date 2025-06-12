<?php

namespace App\Http\Controllers;

use App\Mail\RefereeNotificationMail;
use App\Models\Applicant;
use App\Models\ApplicantInstitutionDetail;
use App\Models\ApplicantsReferee;
use App\Models\Faculty;
use App\Models\Programme;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PgApplicationController extends Controller
{
    /**
     * Show the verification page for applicants.
     *
     * @return \Illuminate\View\View
     */
    public function verify()
    {
        return view('pg.verify');
    }

    /**
     * Show the application index page for a specific applicant.
     *
     * @param string $appno
     * @return \Illuminate\View\View
     */

    public function index($appno)
    {
        $applicant = Applicant::where('appno', $appno)->first();
        if (!$applicant) {
            return view('pg.applicant_notfound', ['appno' => $appno])
                ->with('error', 'Applicant not found. Please check your application number.');
        }
        if (in_array($applicant->status, ['Completed', 'Pending Review'])) {
            return view('pg.applicationsubmitted', compact('applicant'))
                ->with('success', 'Application already completed.');
        }

        $programmes = Programme::select('id', 'name', 'code')->get();

        return view("pg.index", [
            'applicant' => $applicant,
            'programmes' => $programmes,

        ]);
    }

    public function showByName(Request $request)
    {
        $programmeName = $request->query('name');
        $programme = Programme::where('name', $programmeName)->with('department.faculty')->first();
        if (!$programme) {
            return response()->json(['error' => 'Programme not found'], 404);
        }
        return response()->json($programme);
    }

    /**
     * Update the applicant's information.
     */
    public function update(Request $request, $appno)
    {
        $applicant = Applicant::where('appno', $appno)->first();

        if ($applicant->status == 'Completed') {
            return view('pg.applicationsubmitted', compact('applicant'))
                ->with('success', 'Application already completed.');
        }
        // Validate the incoming request data
        $validated = $request->validate([
            'qualification' => 'nullable|string|max:50',
            'first_choice' => 'nullable|string|max:50',
            'fullname' => 'nullable|string|max:75',
            'email_address' => 'nullable|email|max:50',
            'sex' => 'nullable|string|max:6',
            'date_of_birth' => 'nullable|date',
            'state_of_origin' => 'nullable|string|max:50',
            'lga' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:50',
            'home_town' => 'nullable|string|max:7',
            'contact_address' => 'nullable|string|max:52',
            'phone_no' => 'nullable|string|max:20',
            'faculty' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:50',
            'sessions' => 'nullable|string|max:50',
            'first_choice' => 'nullable|string|max:50',

        ]);


        // Update the applicant's information
        $applicant->update($validated);
        $applicant->update([
            'date_initiated' => now(),
            'refereers_needed' => 2, // Reset referees needed count
            'status' => 'In Progress', // Set status to In Progress
            'updated_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->route('institution_details.form', $appno)
            ->with('success', 'Applicant information updated successfully.');
    }

    /**
     * Show the referee data form for an applicant.
     */
    public function refreeDataForm($appno)
    {
        $applicant = Applicant::where('appno', $appno)->first();
        if (!$applicant) {
            return view('pg.applicant_notfound', ['appno' => $appno])
                ->with('error', 'Applicant not found. Please check your application number.');
        }
        $count = ApplicantsReferee::where('applicants_id', $appno)->count();
        if ($count < 1 || $count == 1) {
            return view("pg.referee_data", ['applicant' => $applicant, 'count' => $count]);
        }
        return redirect()->route('presubmission', $appno);
    }

    /**
     * Store the referee information for an applicant.
     */
    public function store(Request $request)
    {
        $applicant_id = $request->applicants_id;
        $applicant = Applicant::where('appno', $applicant_id)->first();

        if ($applicant->status == 'Pending Review' || $applicant->status == 'Completed') {
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

        // ApplicantsReferee::create($validated);
        DB::table('applicantsreferees')->insert($validated);


        $count = ApplicantsReferee::where('applicants_id', $applicant_id)->count();
        if ($count == 1) {
            $applicant->update([
                'refereers_needed' => 1,
            ]);
        }
        if ($count == 2) {
            $applicant->update([
                'refereers_needed' => 0,
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
            'status' => 'Pending Review',
        ]);
        DB::commit();
        return redirect()->route('presubmission', $applicant_id)
            ->with('success', 'Referee information submitted successfully. Please review your application before final submission.');
    }

    /**
     * Show the institution details form for an applicant.
     */
    public function get_institute_details($appno)
    {
        $applicant = Applicant::where('appno', $appno)->first();
        if (!$applicant) {
            return view('pg.applicant_notfound', ['appno' => $appno])
                ->with('error', 'Applicant not found. Please check your application number.');
        }
        if ($applicant->status == 'Completed' || $applicant->status == 'Pending Review') {
            return view('pg.applicationsubmitted', compact('applicant'))
                ->with('success', 'Application already completed.');
        }
        $applicant_detail = ApplicantInstitutionDetail::where('applicants_id', $appno)->first();
        return view('pg.institution_details', ['appplicant_detail' => $applicant_detail, 'appno' => $appno]);
    }

    /**
     * Store the institution details for an applicant.
     */
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
        $institutions = collect($request->institutions)->map(function ($institution) use ($request) {
            return [
                'applicants_id' => $request->applicants_id,
                'institution_name' => $institution['institution_name'],
                'certificate_awarded' => $institution['certificate_awarded'],
                'field_of_study' => $institution['field_of_study'],
                'date_started' => $institution['date_started'],
                'date_ended' => $institution['date_ended'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();
        // Batch insert
        ApplicantInstitutionDetail::insert($institutions);
        return redirect()->route('institution_details.edit', $request->applicants_id)
            ->with('success', 'Institution details saved successfully.');
    }

    /**
     * Show the edit view with existing institution details.
     */
    public function edit($applicants_id)
    {
        $applicant = Applicant::where('appno', $applicants_id)->first();
        if (!$applicant) {
            return view('pg.applicant_notfound', ['appno' => $applicants_id])
                ->with('error', 'Applicant not found. Please check your application number.');
        }
        if ($applicant->status == 'Completed' || $applicant->status == 'Pending Review') {
            return view('pg.applicationsubmitted', compact('applicant'))
                ->with('success', 'Application already completed.');
        }
        // Fetch all institution details for the given applicant
        $institutionDetails = ApplicantInstitutionDetail::where('applicants_id', $applicants_id)->get();

        return view('pg.edit_institution_details', compact('institutionDetails', 'applicants_id'));
    }

    /**
     * Update the institution details for an applicant.
     */
    public function updateInstitutionDetails(Request $request, $applicants_id)
    {
        $validated = $request->validate([
            'institutions.*.institution_name' => 'required|string|max:255',
            'institutions.*.certificate_awarded' => 'required|string|max:100',
            'institutions.*.field_of_study' => 'required|string|max:100',
            'institutions.*.date_started' => 'required|date',
            'institutions.*.date_ended' => 'required|date|after_or_equal:institutions.*.date_started',
        ]);
        // Use transaction for delete and insert
        DB::transaction(function () use ($applicants_id, $request) {
            ApplicantInstitutionDetail::where('applicants_id', $applicants_id)->delete();
            $institutions = collect($request->institutions)->map(function ($institution) use ($applicants_id) {
                return [
                    'applicants_id' => $applicants_id,
                    'institution_name' => $institution['institution_name'],
                    'certificate_awarded' => $institution['certificate_awarded'],
                    'field_of_study' => $institution['field_of_study'],
                    'date_started' => $institution['date_started'],
                    'date_ended' => $institution['date_ended'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();
            ApplicantInstitutionDetail::insert($institutions);
        });
        return redirect()->route('documents.upload', $applicants_id)
            ->with('success', 'Institution details updated successfully.');
    }

    /**
     * Show the upload form for credentials and passport.
     */

    public function show_upload_form($applicants_id)
    {
        $applicant = Applicant::where('appno', $applicants_id)->first();
        if (!$applicant) {
            return view('pg.applicant_notfound', ['appno' => $applicants_id])
                ->with('error', 'Applicant not found. Please check your application number.');
        }
        if ($applicant->status == 'Completed' || $applicant->status == 'Pending Review') {
            return view('pg.applicationsubmitted', compact('applicant'))
                ->with('success', 'Application already completed.');
        }
        $credentials = DB::table('applicants')
            ->where('appno', $applicants_id)
            ->select('credentials', 'passport')
            ->first();

        return view('pg.applicant_uploads', compact('applicants_id', 'credentials'));
    }

    /**
     * Store the uploaded credentials and passport for an applicant.
     */
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
            return redirect()->route('referees.form', $applicantId)->with('success', 'Files uploaded  successfully.');
        // return redirect()->back()->with('success', 'Files uploaded and applicant updated successfully.');
    }

    /**
     *      View the report for a specific applicant at the end of the application process.
     */
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

        $applicant = DB::table('applicants')
            ->where('appno', $applicant_id)
            ->first();

        $institutionDetails = DB::table('applicant_institution_details')
            ->where('applicants_id', $applicant_id)
            ->get();

        $referees = DB::table('applicantsreferees')
            ->where('applicants_id', $applicant_id)
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

        return view('pg.presubmission', compact('applicant', 'institutionDetails', 'referees', 'refereesmail', 'programmes', 'faculties', 'departments'))
            ->with('applicant_id', $applicant_id);
    }


    /* 
* Pre-submission view for applicants to review their application before Final submission
*/
    // public function updatePresubmission(Request $request, $appno)
    // {
    //     $referees = ApplicantsReferee::where('applicants_id', $appno)->get();
    //     $refereesmail = $referees->pluck('mail_sent');
    //     $allRefereesNotified = $refereesmail->every(fn($mail) => $mail == 1);
    //     $applicant = Applicant::where('appno', $appno)->first();
    //     if ($allRefereesNotified) {
    //         return view('pg.applicationsubmitted', ['applicant' => $applicant])
    //             ->with('success', 'Application already completed.');
    //     }
    //     DB::beginTransaction();
    //     try {
    //         $applicant = Applicant::where('appno', $appno)->firstOrFail();
    //         if ($request->hasFile('passport')) {
    //             if (!empty($applicant->passport)) {
    //                 $oldPath = str_replace('/storage/', '', $applicant->passport);
    //                 Storage::disk('public')->delete($oldPath);
    //             }
    //             $passportFile = $request->file('passport');
    //             $passportExt = $passportFile->getClientOriginalExtension();
    //             $passportName = $appno . '.' . $passportExt;
    //             $passportFile->storeAs('passports', $passportName, 'public');
    //             $passportUrl = Storage::url('passports/' . $passportName);
    //         }
    //         $applicant->fill([
                // 'fullname' => $request->input('fullname'),
                // 'sex' => $request->input('sex'),
                // 'date_of_birth' => $request->input('date_of_birth'),
                // 'phone_no' => $request->input('phone_no'),
                // 'email_address' => $request->input('email_address'),
                // 'country' => $request->input('country'),
                // 'state_of_origin' => $request->input('state_of_origin'),
                // 'lga' => $request->input('lga'),
                // 'contact_address' => $request->input('contact_address'),
                // 'passport' => $passportUrl ?? $applicant->passport,
                // 'first_choice' => $request->input('first_choice'),
                // 'qualification' => $request->input('qualification'),
                // 'faculty' => $request->input('faculty'),
                // 'department' => $request->input('department'),
    //         ]);
    //         $applicant->save();
    //         // Batch update institutions
    //         // ApplicantInstitutionDetail::where('applicants_id', $appno)->delete();
    //         if ($request->has('institutions')) {
    //             $institutions = collect($request->input('institutions'))->map(function ($institution) use ($appno) {
    //                 return [
    //                     'applicants_id' => $appno,
    //                     'institution_name' => $institution['institution_name'] ?? '',
    //                     'field_of_study' => $institution['field_of_study'] ?? '',
    //                     'date_started' => $institution['date_started'] ?? null,
    //                     'date_ended' => $institution['date_ended'] ?? null,
    //                     'certificate_awarded' => $institution['certificate_awarded'] ?? '',
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ];
    //             })->toArray();
    //             DB::table('applicant_institution_details')->insert($institutions);
    //         }
    //         // Batch update referees
    //         // ApplicantsReferee::where('applicants_id', $appno)->delete();
    //         if ($request->has('referees')) {
    //             $refereesData = collect($request->input('referees'))->map(function ($referee) use ($appno) {
    //                 return [
    //                     'applicants_id' => $appno,
    //                     'fullname' => $referee['fullname'] ?? '',
    //                     'email_address' => $referee['email_address'] ?? '',
    //                     'phone_no' => $referee['phone_no'] ?? '',
    //                     'rank' => $referee['rank'] ?? '',
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ];
    //             })->toArray();
    //             $applicants_id = $appno;
    //             foreach ($refereesData as $key => $referee) {
    //                 DB::table('applicantsreferees')->insert([
    //                     'applicants_id' => $applicants_id,
    //                     'fullname' => $referee['fullname'],
    //                     'email_address' => $referee['email_address'],
    //                     'phone_no' => $referee['phone_no'],
    //                     'rank' => $referee['rank'],
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ]);
    //             }
    //         }
    //         $referees = ApplicantsReferee::where('applicants_id', $appno)->get();
    //         foreach ($referees as $referee) {
    //             if (!empty($referee->email_address)) {
    //                 try {
    //                     Mail::to($referee->email_address)->send(new RefereeNotificationMail($referee, $applicant));
    //                 } catch (\Exception $e) {
    //                     Log::error('Failed to send email to referee: ' . $e->getMessage());
    //                 }
    //             }
    //             $referee->update(['mail_sent' => 1]);
    //         }
    //         DB::commit();
    //         return redirect()->route('report.view', $appno)
    //             ->with('success', 'Application status updated successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->withErrors(['error' => 'Failed to update application: ' . $e->getMessage()]);
    //     }
    // }
    public function updatePresubmission(Request $request, $appno)
    {
        $referees = ApplicantsReferee::where('applicants_id', $appno)->get();
        $refereesmail = $referees->pluck('mail_sent');
        $allRefereesNotified = $refereesmail->every(fn($mail) => $mail == 1);

        if ($allRefereesNotified) {
            $applicant = Applicant::where('appno', $appno)->first();
            return view('pg.applicationsubmitted', ['applicant' => $applicant])
                ->with('success', 'Application already completed.');
        }

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

            // Send emails
            $referees = ApplicantsReferee::where('applicants_id', $appno)->get();
            foreach ($referees as $referee) {
                if (!empty($referee->email_address)) {
                    try {
                        Mail::to($referee->email_address)->send(new RefereeNotificationMail($referee, $applicant));
                        $referee->update(['mail_sent' => 1]);
                        Log::info('Email sent to referee: ' . $referee->email_address);
                    } catch (\Exception $e) {
                        Log::error('Failed to send email to referee: ' . $e->getMessage());
                    }
                }
            }

            DB::commit();
            return redirect()->route('report.view', $appno)
                ->with('success', 'Application status updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to update application: ' . $e->getMessage()]);
        }
    }
    /**
     * Show the referee submission form for a specific referee.
     */
    public function refereeSubmission(ApplicantsReferee $referee)
    {
        $referee = ApplicantsReferee::findOrFail($referee->id);

        $applicant = Applicant::where('appno', $referee->applicants_id)->first();

        return view('pg.referee_submission', compact('applicant', 'referee'));
    }

    /*
    * Store the referee's submission.
    */
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
            'responded' => 1, // Mark as responded
        ]);


        // Update the applicant's status to Completed
        Applicant::where('appno', $applicants_id)->update([
            'status' => 'Completed',
            'ref_completion_status' => 1,
            'date_completed' => now(),
        ]);

        return view('pg.thankyou', ['applicant' => $applicant])
            ->with('success', 'Referee submission updated successfully.');
    }

    /**
     * Verify the applicant's application number and retrieve their data from the external portal.
     */
    public function verifyApplicant(Request $request)
    {
        $validated = $request->validate([
            'matno' => 'required|string|size:12|regex:/^S\d{11}$/'
        ]);

        $existingApplicant = Applicant::where('appno', $validated['matno'])->first();

        if ($existingApplicant) {
            return redirect()->route('application.index', ['appno' => $existingApplicant->appno])
                ->with('success', 'Application data retrieved successfully');
        }


        try {
            // Make the API request with JSON headers
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
                ->timeout(30) // 30 second timeout
                ->post('https://portal.bsum.edu.ng/application/Application', [
                    'matno' => $validated['matno']
                ]);

            // Check if request was successful
            if ($response->successful()) {
                $apiData = $response->json();

                // Validate required fields in response
                if (!isset($apiData['appNo'], $apiData['fullName'], $apiData['sessions'])) {
                    throw new \Exception('Invalid API response format');
                }

                if ($apiData['paymentStatus'] != 1) {
                    // Handle case where payment is not verified
                    return back()->with('error', 'Payment not verified. Please complete your payment before proceeding.');
                }

                // Create or update applicant record
                $applicant = Applicant::updateOrCreate(
                    ['appno' => $apiData['appNo']],
                    [
                        'appno' => $apiData['appNo'],
                        'fullname' => $apiData['fullName'],
                        'sessions' => $apiData['sessions'],
                        'school_id' => $apiData['schoolId'] ?? null,
                        'application_type' => $apiData['applicationType'] ?? null,
                        'is_verified' => $apiData['paymentStatus'] == 1,
                        'refereers_needed' => 2,
                        // 'api_response' => json_encode($apiData) // Store full response if needed
                    ]
                );

                // Return success response
                $appno = $applicant->appno;
                // Redirect to application route with matno parameter
                return redirect()->route('application.index', ['appno' => $appno])
                    ->with('success', 'Application data retrieved successfully');
            } else {
                // Handle API error response
                $statusCode = $response->status();
                $errorMessage = match ($statusCode) {
                    404 => 'Application number not found',
                    401 => 'Unauthorized access to verification service',
                    500 => 'Verification service error',
                    default => 'Failed to verify application'
                };

                Log::error("API Verification Failed - Status: {$statusCode}, Matno: {$validated['matno']}");
                return back()->with('error', 'Failed to retrieve application data. Please check your application number and try again.');
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Connection Error: " . $e->getMessage());
            return back()->with('error', 'Verification service is currently unavailable. Please try again later.');
        } catch (\Exception $e) {
            Log::error("Verification Error: " . $e->getMessage());
            return back()->with('error', 'Verify your application number and try again');
        }
    }
    public function programmeForm($appno)
    {
        $applicant = Applicant::where('appno', $appno)->first();
        if (!$applicant) {
            return redirect()->back()->with('error', 'Applicant not found.');
        }
        return view('pg.choose_program', compact('applicant'));
    }
    public function store_program(Request $request, $appno)
    {
        $request->validate([
            'program' => 'required|string|max:100',
        ]);

        $applicant = Applicant::where('appno', $appno)->first();
        if (!$applicant) {
            return redirect()->back()->with('error', 'Applicant not found.');
        }

        // Update the applicant's program
        $applicant->update(['program' => $request->program]);

        return redirect()->route('institution_details.form', $appno)
            ->with('success', 'Program selected successfully.');
    }
}
