<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function dashboard()
    {
        $totalTickets = Complaint::count();
        $pendingTickets = Complaint::where('status', 'in_progress')->count();
        $resolvedTickets = Complaint::where('status', 'Resolved')->count();

          return view('complaints.dashboard', [
            'complaints' => Complaint::where('status', '!=', 'Resolved')->orderByDesc('created_at')->get(),
            'totalTickets' => $totalTickets,
            'pendingTickets' => $pendingTickets,
            'resolvedTickets' => $resolvedTickets,
          ]);
    }
    public function index()
    {
       //
    }
}