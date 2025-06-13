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
        <!-- Booking history start-->
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 pb-1">
                    <div class="card-header-title">
                        <h4>All Applications</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div>
                        <div class="table-responsive table-desi">
                            <table id="total-applications-table" class="table table-striped all-package">
                                <thead>
                                    <tr>
                                        <th>S/No</th>
                                        <th>Application No</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Phone No</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applicants as $applicant)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $applicant->appno }}</td>
                                            <td>{{ $applicant->fullname }}</td>
                                            <td>{{ $applicant->sex }}</td>
                                            <td>{{ $applicant->phone_no }}</td>
                                            @if ($applicant->status == 'Pending')
                                                <td><span class="badge badge-primary">{{ $applicant->status }}</span></td>
                                            @elseif ($applicant->status == 'Completed')
                                                <td><span class="badge badge-success">{{ $applicant->status }}</span></td>
                                            @elseif ($applicant->status == 'Pending Review')
                                                <td><span class="badge badge-success">{{ $applicant->status }}</span></td>    
                                                
                                             @elseif ($applicant->status == 'In Progress')
                                                <td><span class="badge badge-success">{{ $applicant->status }}</span></td>    
                                                
                                            @elseif ($applicant->status == null)
                                                <td><span class="badge badge-success">Started</span></td>    
                                                
                                            @endif
                                           
                                            <td>
                                            <ul>
                                                <li>
                                                    <a href="{{route('applicant.show', $applicant)}}">
                                                        <span class="lnr lnr-eye"></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('applicant.edit', $applicant)}}">
                                                        <span class="lnr lnr-pencil"></span>
                                                    </a>
                                                </li>
                                                {{-- <li>
                                                    <a href="javascript:void(0)">
                                                        <span class="lnr lnr-trash"></span>
                                                    </a>
                                                </li> --}}
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
        <!-- Booking history  end-->
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
            var table = $('#total-applications-table').DataTable({
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
