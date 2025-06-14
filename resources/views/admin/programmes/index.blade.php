@extends('layouts.main')
@section('content')
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
                        <div class="d-flex justify-content-between">
                            <h4>All Programmes</h4>
                            <a href="{{ route('programme.add')}}" class="btn btn-primary">Add Programme</a>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    <div>
                        <div class="table-responsive table-desi">
                            <table id="programmes-table" class="table table-striped all-package">
                                <thead>
                                    <tr>
                                        <th>S/No</th>
                                        <th>Programme Name</th>
                                        <th>Code</th>
                                        <th>Department</th>
                                        <th>Faculty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programmes as $programme)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $programme->name }}</td>
                                            <td>{{ $programme->code }}</td>
                                            <td>{{ $programme->department->name }}</td>
                                            <td>{{ $programme->department->faculty->name }}</td>
                                            <td>
                                                <ul>
                                                    {{-- <li>
                                                        <a href="#">
                                                            <span class="lnr lnr-eye"></span>
                                                        </a>
                                                    </li> --}}
                                                    <li>
                                                        <a href="{{route('programme.edit', $programme->id)}}">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form method="POST" action="{{ route('programme.delete', $programme->id)}}" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="">
                                                                <button type="submit"
                                                                    class="btn btn-link p-0 border-0 bg-transparent">
                                                                    <span class="lnr lnr-trash"></span>
                                                                </button>
                                                            </a>

                                                        </form>
                                                        {{-- <a href="#">
                                                        <span class="lnr lnr-trash"></span>
                                                    </a> --}}
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
            var table = $('#programmes-table').DataTable({
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

            // Custom search for Application No or Name
            $('#custom-search').on('keyup', function() {
                table.columns([1, 2]).search(this.value).draw();
            });
        });
    </script>
@endsection
