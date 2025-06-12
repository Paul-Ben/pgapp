@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                       
                            <div class="alert alert-danger">
                                <strong>Alert!</strong> You have not added any referencees yet.
                            </div>
                            <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>First Referee Information</h5>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        
                                    @endif
                                </div>
                                <form method="POST" action="{{ route('referee.submission.store', $applicant->appno) }}" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <div class="col-sm-4 mb-4" hidden>
                                                <input class="form-control" name="applicants_id" value="{{$applicant->appno}}" type="text" placeholder="Applicant ID" hidden>
                                                <input class="form-control" name="referee_id" value="{{$referee->id}}" type="text" placeholder="Applicant ID" hidden>
                                            </div>

                                            <label class="form-label-title col-sm-2 mb-4">Full Name</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="fullname" value="{{$referee->fullname}}" type="text" placeholder="Full Name" required readonly>
                                            </div>
                                            <label class="form-label-title col-sm-2 mb-4">Email Address</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="email_address" value="{{$referee->email_address}}" type="email" placeholder="Email Address" required readonly>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Phone Number</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="phone_no" value="{{$referee->phone_no}}" type="text" placeholder="Phone Number" required readonly>
                                            </div>
                                            <label class="form-label-title col-sm-2 mb-4">Rank</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="rank" value="{{$referee->rank}}" type="text" placeholder="Rank" required readonly>
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                           
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Application
                                                Type</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="js-example-basic-single w-100" name="recommendation_status" required>
                                                    <option selected>Select Recommendation</option>
                                                    <option value="1">Recommended</option>
                                                    <option value="0">Not Recommended</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Comments</label>
                                            <div class="col-sm-4 mb-4">
                                                <textarea class="form-control" name="note" rows="3" placeholder="Comments" required></textarea>
                                            </div>
                                        </div>

                                        <div class="button login button-1 text-center">
                                            <button class="btn btn-primary" type="submit">
                                                <span>Submit</span>
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection