@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Add a Programme</h5>
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
                                <form method="POST" action="{{ route('programme.update', $programme->id) }}"
                                    class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">

                                            <label class="form-label-title col-sm-2 mb-4">Programme Name</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $programme->name }}" name="name" type="text"
                                                    placeholder="Faculty Name" required>
                                            </div>
                                            <label class="form-label-title col-sm-2 mb-4">Programme Code</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $programme->code }}" name="code" type="text"
                                                    placeholder="Faculty Code" required>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            {{-- <label class="form-label-title col-sm-2 mb-4">Faculty</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="form-control" name="faculty_id" required>
                                                    <option value="" selected>Select Faculty</option>
                                                    @foreach ($faculties as $faculty)
                                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            <label class="form-label-title col-sm-2 mb-4">Department</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="form-control" name="department_id" required>
                                                    <option value="{{ $programme->department_id }}" selected>{{$programme->department->name}}</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                    @endforeach
                                                </select>
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

                        {{-- @if ($count == 1)
                            <div class="alert alert-success">
                                <strong>Success!</strong> You have added one referee. Please add one more referee to
                                proceed.
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>B. Second Referee Information</h5>
                                    </div>
                                    <form method="POST" action="{{ route('referees.store') }}"
                                        class="theme-form theme-form-2 mega-form">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-4 row align-items-center">
                                                <div class="col-sm-4 mb-4" hidden>
                                                    <input class="form-control" name="applicants_id"
                                                        value="{{ $applicant->appno }}" type="text"
                                                        placeholder="Applicant ID" hidden>
                                                </div>

                                                <label class="form-label-title col-sm-2 mb-4">Full Name</label>
                                                <div class="col-sm-4 mb-4">
                                                    <input class="form-control" name="fullname" type="text"
                                                        placeholder="Full Name" required>
                                                </div>
                                                <label class="form-label-title col-sm-2 mb-4">Email Address</label>
                                                <div class="col-sm-4 mb-4">
                                                    <input class="form-control" name="email_address" type="email"
                                                        placeholder="Email Address" required>
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-2 mb-4">Phone Number</label>
                                                <div class="col-sm-4 mb-4">
                                                    <input class="form-control" name="phone_no" type="text"
                                                        placeholder="Phone Number" required>
                                                </div>
                                                <label class="form-label-title col-sm-2 mb-4">Rank</label>
                                                <div class="col-sm-4 mb-4">
                                                    <input class="form-control" name="rank" type="text"
                                                        placeholder="Rank" required>
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
                        @endif --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
