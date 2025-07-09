@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="mb-3">Ticket #{{ $complaint->id }}</h5>
                    <div class="card-header-right">
                        <span class="badge badge-{{ $complaint->status === 'Open' ? 'warning' : ($complaint->status === 'In Progress' ? 'info' : 'success') }}">
                            {{ $complaint->status }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="mb-2">Applicant Information</h6>
                                <p class="mb-1"><strong>Name:</strong> {{ $complaint->user_name ?? 'NA' }}</p>
                                <p class="mb-1"><strong>Matric/Jamb No:</strong> {{ $complaint->matric_number }}</p>
                                <p class="mb-1"><strong>Payment Reference:</strong> {{ $complaint->payment_reference }}</p>
                                <p class="mb-1"><strong>Ticket Number:</strong> {{ $complaint->ticket_number }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="mb-2">Ticket Details</h6>
                                <p class="mb-1"><strong>Created:</strong> {{ $complaint->created_at->format('F j, Y h:i A') }}</p>
                                <p class="mb-1"><strong>Last Updated:</strong> {{ $complaint->updated_at->format('F j, Y h:i A') }}</p>
                                <p class="mb-1"><strong>Category:</strong> {{ $complaint->issue_type }}</p>
                                <p class="mb-1"><strong>Amount:</strong> {{ $complaint->amount_paid }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="mb-4">
                                <h6 class="mb-2">Subject</h6>
                                <p>{{ $complaint->subject }}</p>
                            </div>
                            <div class="mb-4">
                                <h6 class="mb-2">Description</h6>
                                <div class="p-3 bg-light rounded text-dark">
                                    {!! nl2br(e($complaint->description)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection