<!-- filepath: c:\Users\Joseph\Herd\pg\resources\views\pg\applicant_not_found.blade.php -->
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
                                    <h5>Applicant Not Found</h5>
                                </div>
                                
                                <div class="text-center py-5">
                                    <div class="mb-4">
                                        <i class="fas fa-exclamation-triangle text-danger" style="font-size: 5rem;"></i>
                                    </div>
                                    <h3 class="mb-3 text-danger">We couldn't find the applicant you are looking for.</h3>
                                    <p class="mb-4">The application number you entered does not match any records in our system.<br>
                                    Please check the number and try again, or contact support if you believe this is an error.</p>
                                    
                                    <div class="alert alert-warning mx-auto" style="max-width: 600px;">
                                        <p><strong>Possible reasons:</strong></p>
                                        <ul class="mb-0">
                                            <li>Incorrect application number entered</li>
                                            <li>The applicant's record has not been created yet</li>
                                            <li>The record may have been removed</li>
                                        </ul>
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