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
                                    <h5>Edit Institution Details</h5>
                                    <span>Applicant ID: {{ $applicants_id }}</span>
                                </div>
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
                                <form method="POST" action="{{ route('institution_details.update', $applicants_id) }}"
                                    class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('PUT')
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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($institutionDetails as $index => $detail)
                                                    <tr>
                                                        <td><input type="text"
                                                                name="institutions[{{ $index }}][institution_name]"
                                                                class="form-control" value="{{ $detail->institution_name }}"
                                                                required></td>
                                                        <td><input type="text"
                                                                name="institutions[{{ $index }}][certificate_awarded]"
                                                                class="form-control"
                                                                value="{{ $detail->certificate_awarded }}" required></td>
                                                        <td><input type="text"
                                                                name="institutions[{{ $index }}][field_of_study]"
                                                                class="form-control" value="{{ $detail->field_of_study }}"
                                                                required></td>
                                                        <td><input type="date"
                                                                name="institutions[{{ $index }}][date_started]"
                                                                class="form-control" value="{{ $detail->date_started }}"
                                                                required></td>
                                                        <td><input type="date"
                                                                name="institutions[{{ $index }}][date_ended]"
                                                                class="form-control" value="{{ $detail->date_ended }}"
                                                                required></td>
                                                        <td><button type="button"
                                                                class="btn btn-danger remove-row">&times;</button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-end my-3">
                                        <button type="button" class="btn btn-success" id="add-row">Add Row</button>
                                    </div>

                                    <div class="button login button-1 text-center">
                                        <button class="btn btn-primary" type="submit">
                                            <span>Save Changes</span>
                                            <i class="fa fa-check"></i>
                                        </button>
                                        {{-- <a href="{{ route('documents.upload', $applicants_id) }}">
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
    <script>
        let rowCount = {{ count($institutionDetails) }};

        document.getElementById('add-row').addEventListener('click', function() {
            const tableBody = document.querySelector('#institution-details-table tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
            <td><input type="text" name="institutions[${rowCount}][institution_name]" class="form-control" placeholder="Institution Name" required></td>
            <td><input type="text" name="institutions[${rowCount}][certificate_awarded]" class="form-control" placeholder="Degree" required></td>
            <td><input type="text" name="institutions[${rowCount}][field_of_study]" class="form-control" placeholder="Field of Study" required></td>
            <td><input type="date" name="institutions[${rowCount}][date_started]" class="form-control" required></td>
            <td><input type="date" name="institutions[${rowCount}][date_ended]" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger remove-row">&times;</button></td>
        `;

            tableBody.appendChild(newRow);
            rowCount++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
@endsection
