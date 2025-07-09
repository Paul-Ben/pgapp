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
    <div class="py-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xxl-3 col-lg-6">
                    <div class="main-tiles border-5 border-0 card o-hidden">
                        <div class="custome-4-bg b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Total Support Tickets</span>
                                    <h4 class="mb-0 counter">{{ $totalTickets }}
                                        <span class="badge badge-light-info grow">
                                            <i data-feather="help-circle"></i>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xxl-3 col-lg-6">
                    <div class="main-tiles border-5 border-0 card o-hidden">
                        <div class="custome-4-bg b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Total Pending Tickets</span>
                                    <h4 class="mb-0 counter">{{ $pendingTickets }}
                                        <span class="badge badge-light-info grow">
                                            <i data-feather="help-circle"></i>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xxl-3 col-lg-6">
                    <div class="main-tiles border-5 border-0 card o-hidden">
                        <div class="custome-4-bg b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <span class="m-0">Total Resolved Tickets</span>
                                    <h4 class="mb-0 counter">{{ $resolvedTickets }}
                                        <span class="badge badge-light-info grow">
                                            <i data-feather="help-circle"></i>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <h2 class="card-title mb-4 fw-semibold">Complaints Dashboard</h2>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        {{-- <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Ticket Number</th>
                                    <th scope="col">Issue Type</th>
                                    <th scope="col">Student Info</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="min-width: 140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaints as $complaint)
                                    <tr>
                                        <td class="text-truncate" style="max-width: 150px;">
                                            {{ $complaint->ticket_number }}
                                        </td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}</td>
                                        <td>
                                            <div>ID: {{ $complaint->matric_number }}</div>
                                            @if ($complaint->user_name)
                                                <div>Name: {{ $complaint->user_name }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($complaint->issue_type === 'payment')
                                                <div>Ref: {{ $complaint->payment_reference }}</div>
                                                <div>Item: {{ $complaint->payment_item }}</div>
                                                <div>Amount: ₦{{ number_format($complaint->amount_paid, 2) }}</div>
                                            @endif
                                            @if ($complaint->description)
                                                <div>{{ \Illuminate\Support\Str::limit($complaint->description, 100) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-warning text-dark',
                                                    'in_progress' => 'bg-info text-white',
                                                    'resolved' => 'bg-success text-white',
                                                ];
                                                $badgeClass =
                                                    $statusClasses[$complaint->status] ?? 'bg-secondary text-white';
                                            @endphp
                                            <span class="badge {{ $badgeClass }} text-uppercase">
                                                {{ str_replace('_', ' ', ucfirst($complaint->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('complaints.update-status', $complaint) }}"
                                                method="POST" class="d-flex">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()"
                                                    class="form-select form-select-sm">
                                                    <option value="pending"
                                                        {{ $complaint->status === 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="in_progress"
                                                        {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>In
                                                        Progress</option>
                                                    <option value="resolved"
                                                        {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No complaints found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table> --}}
                        <div class="table-responsive">
                            <table id="complaintsTable" class="table table-striped table-hover align-middle mb-0"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Ticket Number</th>
                                        <th scope="col">Issue Type</th>
                                        <th scope="col">Student Info</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" style="min-width: 140px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($complaints as $complaint)
                                        <tr>
                                            <td class="text-truncate" style="max-width: 150px;">
                                                <a href="{{route('show.complaint', $complaint)}}">
                                                  {{ $complaint->ticket_number }}  
                                                </a>
                                                
                                            </td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}</td>
                                            <td>
                                                <div>ID: {{ $complaint->matric_number }}</div>
                                                @if ($complaint->user_name)
                                                    <div>Name: {{ $complaint->user_name }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($complaint->issue_type === 'payment')
                                                    <div>Ref: {{ $complaint->payment_reference }}</div>
                                                    <div>Item: {{ $complaint->payment_item }}</div>
                                                    <div>Amount: ₦{{ number_format($complaint->amount_paid, 2) }}</div>
                                                @endif
                                                @if ($complaint->description)
                                                    <div>{{ \Illuminate\Support\Str::limit($complaint->description, 100) }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $statusClasses = [
                                                        'pending' => 'bg-warning text-dark',
                                                        'in_progress' => 'bg-info text-white',
                                                        'resolved' => 'bg-success text-white',
                                                    ];
                                                    $badgeClass =
                                                        $statusClasses[$complaint->status] ?? 'bg-secondary text-white';
                                                @endphp
                                                <span class="badge {{ $badgeClass }} text-uppercase">
                                                    {{ str_replace('_', ' ', ucfirst($complaint->status)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('complaints.update-status', $complaint) }}"
                                                    method="POST" class="d-flex">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" onchange="this.form.submit()"
                                                        class="form-select form-select-sm">
                                                        <option value="pending"
                                                            {{ $complaint->status === 'pending' ? 'selected' : '' }}>
                                                            Pending</option>
                                                        <option value="in_progress"
                                                            {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>In
                                                            Progress</option>
                                                        <option value="resolved"
                                                            {{ $complaint->status === 'resolved' ? 'selected' : '' }}>
                                                            Resolved</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">No complaints found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="mt-4 d-flex justify-content-center">

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
            var table = $('#complaintsTable').DataTable({
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
