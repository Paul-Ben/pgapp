<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    public function index()
    {
        return view('complaints.index', [
            'issueTypes' => [
                'payment' => 'Payment Issue',
                'registration' => 'Registration Issue',
                'biodata' => 'Bio data Issue',
                'course_change' => 'Change of Course Issue',
                'login' => 'Login Issue',
                'others' => 'Other Issues'
            ]
        ]);
    }

    public function create(Request $request)
    {
        $issueType = $request->query('type');
        if (!$issueType) {
            return redirect()->route('complaints.index');
        }

        return view('complaints.create', [
            'issueType' => $issueType
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'issue_type' => 'required|string',
            'matric_number' => 'required|string',
            'user_name' => 'required_unless:issue_type,registration,login|string|nullable',
            'payment_reference' => 'required_if:issue_type,payment|string|nullable',
            'payment_item' => 'required_if:issue_type,payment|string|nullable',
            'amount_paid' => 'required_if:issue_type,payment|numeric|nullable',
            'description' => 'required_if:issue_type,others|string|nullable',
        ]);

        $complaint = new Complaint($validated);
        $complaint->ticket_number = 'TKT-' . strtoupper(Str::random(10));
        $complaint->save();

        return redirect()->route('complaints.success', $complaint);
    }
    public function success(Complaint $complaint)
    {
        return view('complaints.success', [
            'complaint' => $complaint
        ]);
    }

    public function showCheckStatus()
    {
        return view('complaints.check-status');
    }

    public function checkStatus(Request $request)
    {
        $validated = $request->validate([
            'ticket_number' => 'required|string'
        ]);

        $complaint = Complaint::where('ticket_number', $validated['ticket_number'])->first();

        if (!$complaint) {
            return back()->with('error', 'Ticket number not found. Please check and try again.');
        }

        return view('complaints.check-status', [
            'complaint' => $complaint
        ]);
    }

    public function dashboard()
    {
        return view('complaints.dashboard', [
            'complaints' => Complaint::latest()->paginate(10)
        ]);
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved'
        ]);

        $complaint->update($validated);

        return back()->with('success', 'Complaint status updated successfully.');
    }
    public function show(Complaint $complaint)
    {
        return view('complaints.show', [
            'complaint'=> $complaint
            ]);
    }
}
