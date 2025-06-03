@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2 text-center">
                                    <h5>Thank You for Your Submission!</h5>
                                </div>
                                
                                <div class="text-center py-5">
                                    <div class="mb-4">
                                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                                    </div>
                                    <h3 class="mb-3">Application already Submitted Successfully</h3>
                                    <p class="mb-4">We appreciate you taking the time to complete your application. {{ $applicant->fullname }}.</p>
                                    
                                    <div class="alert alert-info mx-auto" style="max-width: 600px;">
                                        <p><strong>Application Number:</strong> {{ $applicant->appno }}</p>
                                        <p><strong>Applicant Name:</strong> {{ $applicant->fullname }}</p>
                                        <p><strong>Date Submitted:</strong> {{ $applicant->updated_at->format('F j, Y \a\t g:i a') }}</p>
                                    </div>
                                    
                                    <div class="button login button-1 text-center mt-4">
                                        <a href="{{ url('/') }}" class="btn btn-primary">
                                            <span>Return to Home</span>
                                            <i class="fas fa-home"></i>
                                        </a>
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