{{-- @extends('layouts.main')

@section('content')
    <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive table-desi">
                                            <table class="table table-striped all-package">
                                                <thead>
                                                    <tr>
                                                        <th>S/No</th>
                                                        <th>Application No</th>
                                                        <th>Applicant Name</th>
                                                        <th>Email</th>
                                                        <th>Phone No</th>
                                                        <th>Gender</th>
                                                        <th>Nationality</th>
                                                        <th>State</th>
                                                        <th>LGA</th>
                                                        <th>Application Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($applicants as $applicant)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $applicant->appno }}</td>
                                                        <td>{{ $applicant->fullname }}</td>
                                                        <td>{{ $applicant->email_address }}</td>
                                                        <td>{{ $applicant->phone_no }}</td>
                                                        <td>{{ $applicant->sex }}</td>
                                                        <td>{{ $applicant->country }}</td>
                                                        <td>{{ $applicant->state_of_origin }}</td>
                                                        <td>{{ $applicant->lga }}</td>
                                                        <td>{{ $applicant->updated_at->format('Y-m-d') }}</td>
                                                       <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="order-detail.html">
                                                                        <span class="lnr lnr-eye"></span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="javascript:void(0)">
                                                                        <span class="lnr lnr-pencil"></span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="javascript:void(0)">
                                                                        <span class="lnr lnr-trash"></span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection --}}
<!-- filepath: c:\Users\Joseph\Herd\pg\resources\views\admin\completed_applications.blade.php -->
{{-- @extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css"/>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="table-responsive table-desi">
                                <table id="completed-applications-table" class="table table-striped all-package">
                                    <thead>
                                        <tr>
                                            <th>S/No</th>
                                            <th>Application No</th>
                                            <th>Applicant Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>Gender</th>
                                            <th>Nationality</th>
                                            <th>State</th>
                                            <th>LGA</th>
                                            <th>Application Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applicants as $applicant)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $applicant->appno }}</td>
                                            <td>{{ $applicant->fullname }}</td>
                                            <td>{{ $applicant->email_address }}</td>
                                            <td>{{ $applicant->phone_no }}</td>
                                            <td>{{ $applicant->sex }}</td>
                                            <td>{{ $applicant->country }}</td>
                                            <td>{{ $applicant->state_of_origin }}</td>
                                            <td>{{ $applicant->lga }}</td>
                                            <td>{{ $applicant->updated_at->format('Y-m-d') }}</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <span class="lnr lnr-eye"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-trash"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            $('#completed-applications-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print'
                ],
                pageLength: 25
            });
        });
    </script>
@endsection --}}
<!-- filepath: c:\Users\Joseph\Herd\pg\resources\views\admin\completed_applications.blade.php -->
{{-- @extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <!-- Download/Search Buttons will appear here -->
                        <div class="mb-3" id="datatable-buttons-container"></div>
                        <div>
                            <div class="table-responsive table-desi">
                                <table id="completed-applications-table" class="table table-striped all-package">
                                    <thead>
                                        <tr>
                                            <th>S/No</th>
                                            <th>Application No</th>
                                            <th>Applicant Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>Gender</th>
                                            <th>Nationality</th>
                                            <th>State</th>
                                            <th>LGA</th>
                                            <th>Application Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applicants as $applicant)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $applicant->appno }}</td>
                                                <td>{{ $applicant->fullname }}</td>
                                                <td>{{ $applicant->email_address }}</td>
                                                <td>{{ $applicant->phone_no }}</td>
                                                <td>{{ $applicant->sex }}</td>
                                                <td>{{ $applicant->country }}</td>
                                                <td>{{ $applicant->state_of_origin }}</td>
                                                <td>{{ $applicant->lga }}</td>
                                                <td>{{ $applicant->updated_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="order-detail.html">
                                                                <span class="lnr lnr-eye"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)">
                                                                <span class="lnr lnr-pencil"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)">
                                                                <span class="lnr lnr-trash"></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#completed-applications-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print'
                ],
                pageLength: 25
            });

            // Move the buttons to the custom container above the table
            table.buttons().container().appendTo('#datatable-buttons-container');
        });
    </script>
@endsection --}}

{{-- @extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
    <style>
        /* Additional styling to ensure proper display */
        .dt-buttons {
            margin-bottom: 15px;
        }

        .dataTables_filter {
            float: right;
            margin-bottom: 15px;
        }

        .dataTables_length {
            margin-bottom: 15px;
        }
    </style>

    <div class="container-fluid">
        @include('admin.cards')
        <!-- Completed Applications Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title mb-0">Completed Applications</h4>
                            <!-- Download Button -->
                            <a href="{{ route('completed.applications.download') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-download"></i> Download Completed Applications
                            </a>
                        </div>

                        <!-- Container for buttons and search -->
                        <div class="table-top-options">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="datatable-buttons-container"></div>
                                </div>
                                <div class="col-md-6">
                                    <div id="datatable-search-container"></div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-desi">
                            <table id="completed-applications-table" class="table table-striped all-package">
                                <thead>
                                    <tr>
                                        <th>S/No</th>
                                        <th>Application No</th>
                                        <th>Applicant Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Gender</th>
                                        <th>Nationality</th>
                                        <th>State</th>
                                        <th>LGA</th>
                                        <th>Application Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicants as $applicant)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $applicant->appno }}</td>
                                            <td>{{ $applicant->fullname }}</td>
                                            <td>{{ $applicant->email_address }}</td>
                                            <td>{{ $applicant->phone_no }}</td>
                                            <td>{{ $applicant->sex }}</td>
                                            <td>{{ $applicant->country }}</td>
                                            <td>{{ $applicant->state_of_origin }}</td>
                                            <td>{{ $applicant->lga }}</td>
                                            <td>{{ $applicant->updated_at->format('Y-m-d') }}</td>
                                            <td>
                                                <ul class="action-list">
                                                    <li>
                                                        <a href="{{ route('applicant.show', $applicant) }}">
                                                            <span class="lnr lnr-eye"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-trash"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            var table = $('#completed-applications-table').DataTable({
                dom: '<"row"<"col-sm-6"B><"col-sm-6"f>>rtip',
                buttons: [{
                        extend: 'copyHtml5',
                        className: 'btn btn-sm btn-secondary'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-sm btn-success'
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'btn btn-sm btn-info'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm btn-danger'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-warning'
                    }
                ],
                pageLength: 25,
                responsive: true,
                initComplete: function() {
                    // Move buttons to custom container
                    $('.dt-buttons').appendTo('#datatable-buttons-container');
                    // Move search to custom container
                    $('.dataTables_filter').appendTo('#datatable-search-container');
                }
            });
        });
    </script>
@endsection --}}
<!-- filepath: c:\Users\Joseph\Herd\pg\resources\views\admin\completed_applications.blade.php -->
@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
    <style>
        .dt-buttons {
            margin-bottom: 15px;
        }
        .dataTables_filter {
            float: right;
            margin-bottom: 15px;
        }
        .dataTables_length {
            margin-bottom: 15px;
        }
    </style>

    <div class="container-fluid">
        @include('admin.cards')
        <!-- Completed Applications Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title mb-0">Completed Applications</h4>
                            <!-- Download Button -->
                            <a href="{{ route('completed.applications.download') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-download"></i> Download Completed Applications
                            </a>
                        </div>

                        <!-- Custom Search Input -->
                        <div class="row mb-3">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-end">
                                <input type="text" id="custom-search" class="form-control" placeholder="Search by Application No or Name">
                            </div>
                        </div>

                        <!-- Container for buttons and search -->
                        <div class="table-top-options">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="datatable-buttons-container"></div>
                                </div>
                                <div class="col-md-6">
                                    <div id="datatable-search-container"></div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-desi">
                            <table id="completed-applications-table" class="table table-striped all-package">
                                <thead>
                                    <tr>
                                        <th>S/No</th>
                                        <th>Application No</th>
                                        <th>Applicant Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Gender</th>
                                        <th>Nationality</th>
                                        <th>State</th>
                                        <th>LGA</th>
                                        <th>Application Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicants as $applicant)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $applicant->appno }}</td>
                                            <td>{{ $applicant->fullname }}</td>
                                            <td>{{ $applicant->email_address }}</td>
                                            <td>{{ $applicant->phone_no }}</td>
                                            <td>{{ $applicant->sex }}</td>
                                            <td>{{ $applicant->country }}</td>
                                            <td>{{ $applicant->state_of_origin }}</td>
                                            <td>{{ $applicant->lga }}</td>
                                            <td>{{ $applicant->updated_at->format('Y-m-d') }}</td>
                                            <td>
                                                <ul class="action-list">
                                                    <li>
                                                        <a href="{{ route('applicant.show', $applicant) }}">
                                                            <span class="lnr lnr-eye"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-trash"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#completed-applications-table').DataTable({
                dom: '<"row"<"col-sm-6"B><"col-sm-6"f>>rtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        className: 'btn btn-sm btn-secondary'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-sm btn-success'
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'btn btn-sm btn-info'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm btn-danger'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-warning'
                    }
                ],
                pageLength: 25,
                responsive: true,
                initComplete: function() {
                    // Move buttons to custom container
                    $('.dt-buttons').appendTo('#datatable-buttons-container');
                    // Move search to custom container
                    $('.dataTables_filter').appendTo('#datatable-search-container');
                }
            });

            // Custom search for Application No or Name
            $('#custom-search').on('keyup', function() {
                table.columns([1,2]).search(this.value).draw();
            });
        });
    </script>
@endsection