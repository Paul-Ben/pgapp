@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Select Your Program</h2>
    <form action="{{ route('programme.store', $applicant->appno) }}" method="POST">
        @csrf
        <div class="mb-4 row align-items-center">
            <label class="form-label-title col-sm-2 mb-4">Application No:</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" value="{{ $applicant->appno }}" type="text" readonly>
            </div>

            <label class="form-label-title col-sm-2 mb-4">Highest Qualification:</label>
            <div class="col-sm-4 mb-4">
                <select name="qualification" class="form-control" required>
                    <option value="" disabled>Select Program</option>
                    <option value="Undergraduate (BSc)">Undergraduate (BSc)</option>
                    <option value="Postgraduate (MSc)">Postgraduate (MSc)</option>
                    <option value="Postgraduate (PhD)">Postgraduate (PhD)"></option>
                </select>
            </div>
        </div>
        <div class="mb-4 row align-items-center">
            <label class="form-label-title col-sm-2 mb-4">Application No:</label>
            <div class="col-sm-4 mb-4">
                <input class="form-control" value="{{ $applicant->appno }}" type="text" readonly>
            </div>

            <label class="form-label-title col-sm-2 mb-4">Course of Study:</label>
            <div class="col-sm-4 mb-4">
                <select name="qualification" class="form-control" required>
                    <option value="" disabled>Select Program</option>
                    <option value="Undergraduate (BSc)">Undergraduate (BSc)</option>
                    <option value="Postgraduate (MSc)">Postgraduate (MSc)</option>
                    <option value="Postgraduate (PhD)">Postgraduate (PhD)"></option>
                </select>
            </div>
        </div>


        <div class="button login button-1 text-center">
            <button class="btn btn-primary" type="submit">
                <span>Submit</span>
                <i class="fa fa-check"></i>
            </button>
        </div>
    </form>
</div>
@endsection

