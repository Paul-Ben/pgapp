{{-- @extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Institution Details</h5>
                                </div>
                                <form method="POST" action="{{ route('institution_details.store') }}" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Applicant ID</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="applicants_id" value="{{$appno}}" type="text" placeholder="Applicant ID" required>
                                            </div>

                                            <label class="form-label-title col-sm-2 mb-4">Institution Name</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="institution_name" type="text" placeholder="Institution Name" required>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Degree Obtained</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="degree_obtained" type="text" placeholder="Degree Obtained" required>
                                            </div>

                                            <label class="form-label-title col-sm-2 mb-4">Field of Study</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="field_of_study" type="text" placeholder="Field of Study" required>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Start Date</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="start_date" type="date" required>
                                            </div>

                                            <label class="form-label-title col-sm-2 mb-4">End Date</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="end_date" type="date" required>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Grade</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="grade" type="text" placeholder="Grade (e.g., First Class, 4.0 GPA)">
                                            </div>

                                            <label class="form-label-title col-sm-2 mb-4">Transcript URL</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="transcript_url" type="text" placeholder="Transcript URL">
                                            </div>
                                        </div>

                                        <div class="button login button-1 text-center" style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);">
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
@endsection --}}
@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Institution Details</h5>
                                    <span>{{ $appno }}, Please fill out the form below to add your educational
                                        background.</span>
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
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
                                <form method="POST" action="{{ route('institution_details.store') }}"
                                    class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle text-center"
                                            id="institution-details-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Institution Name</th>
                                                    <th>Degree Obtained</th>
                                                    <th>Field of Study</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    {{-- <th>Grade</th>
                                                <th>Transcript URL</th> --}}
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="institutions[0][institution_name]"
                                                            class="form-control" placeholder="Institution Name" required>
                                                    </td>
                                                    <td><input type="text" name="institutions[0][certificate_awarded]"
                                                            class="form-control" placeholder="Degree" required></td>
                                                    <td><input type="text" name="institutions[0][field_of_study]"
                                                            class="form-control" placeholder="Field of Study" required></td>
                                                    <td><input type="date" name="institutions[0][date_started]"
                                                            class="form-control" required></td>
                                                    <td><input type="date" name="institutions[0][date_ended]"
                                                            class="form-control" required></td>
                                                    <td><button type="button" class="btn btn-primary remove-row"
                                                            disabled>&times;</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-end my-3">
                                        <button type="button" class="btn btn-success" id="add-row"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Click to add a new row for another institution you attended.">
                                            Add Row
                                        </button>
                                    </div>

                                    <input type="hidden" name="applicants_id" value="{{ $appno }}">

                                    {{-- <div class="button login button-1 text-center">
                                        <a href="{{ url()->previous() }}">
                                            <button class="btn btn-success" type="button" style="background: blue">
                                                <i class="fa fa-arrow-left"></i>
                                                <span>Previous</span>
                                            </button>
                                        </a>
                                        <button class="btn btn-primary" type="submit">
                                            <span>Save</span>
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </div> --}}
                                    <div class="button login button-1 text-center">
                                        <a href="{{ url()->previous() }}">
                                            <button class="btn btn-success" type="button" style="background: blue"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Go back to the previous step.">
                                                <i class="fa fa-arrow-left"></i>
                                                <span>Previous</span>
                                            </button>
                                        </a>
                                        <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Save all entered institution details.">
                                            <span>Save</span>
                                            <i class="fa fa-check"></i>
                                        </button>
                                         {{-- <a href="{{ route('documents.upload', $appno) }}">
                                            <button class="btn btn-success" type="button" style="background: blue">
                                                <span>Next</span>
                                                <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </a> --}}
                                    </div>
                                </form>
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        let rowCount = 1;

        document.getElementById('add-row').addEventListener('click', function() {
            const tableBody = document.querySelector('#institution-details-table tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
            <td><input type="text" name="institutions[${rowCount}][institution_name]" class="form-control" placeholder="Institution Name" required></td>
            <td><input type="text" name="institutions[${rowCount}][certificate_awarded]" class="form-control" placeholder="Degree" required></td>
            <td><input type="text" name="institutions[${rowCount}][field_of_study]" class="form-control" placeholder="Field of Study" required></td>
            <td><input type="date" name="institutions[${rowCount}][date_started]" class="form-control" required></td>
            <td><input type="date" name="institutions[${rowCount}][date_ended]" class="form-control" required></td>
            <td><button type="button" class="btn btn-primary remove-row">&times;</button></td>
        `;

            tableBody.appendChild(newRow);
            rowCount++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    </script> --}}
    <script>
        let rowCount = 1;

        document.getElementById('add-row').addEventListener('click', function() {
            const tableBody = document.querySelector('#institution-details-table tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
            <td><input type="text" name="institutions[${rowCount}][institution_name]" class="form-control" placeholder="Institution Name" required></td>
            <td><input type="text" name="institutions[${rowCount}][certificate_awarded]" class="form-control" placeholder="Degree" required></td>
            <td><input type="text" name="institutions[${rowCount}][field_of_study]" class="form-control" placeholder="Field of Study" required></td>
            <td><input type="date" name="institutions[${rowCount}][date_started]" class="form-control" required></td>
            <td><input type="date" name="institutions[${rowCount}][date_ended]" class="form-control" required></td>
            <td><button type="button" class="btn btn-primary remove-row" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove this row if you added it by mistake.">&times;</button></td>
        `;

            tableBody.appendChild(newRow);
            rowCount++;

            // Re-initialize tooltips for new buttons
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });

        // Initialize tooltips on page load
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
@endsection

{{-- @push('scripts')

@endpush --}}
