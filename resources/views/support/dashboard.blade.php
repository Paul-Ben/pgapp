@extends('layouts.support')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-xxl-3 col-lg-6">
            <div class="main-tiles border-5 border-0 card o-hidden">
                <div class="custome-1-bg b-r-4 card-body">
                    <div class="media align-items-center static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Total Tickets</span>
                            <h4 class="mb-0 counter">{{ $totalTickets }}
                                <span class="badge badge-light-primary grow">
                                    <i data-feather="message-square"></i>
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3 col-lg-6">
            <div class="main-tiles border-5 border-0 card o-hidden">
                <div class="custome-2-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Open Tickets</span>
                            <h4 class="mb-0 counter">{{ $openTickets }}
                                <span class="badge badge-light-danger grow">
                                    <i data-feather="alert-circle"></i>
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3 col-lg-6">
            <div class="main-tiles border-5 border-0 card o-hidden">
                <div class="custome-3-bg b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Resolved Tickets</span>
                            <h4 class="mb-0 counter">{{ $resolvedTickets }}
                                <span class="badge badge-light-success grow">
                                    <i data-feather="check-circle"></i>
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
                            <span class="m-0">Average Response Time</span>
                            <h4 class="mb-0">{{ $avgResponseTime }} hrs
                                <span class="badge badge-light-info grow">
                                    <i data-feather="clock"></i>
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tickets -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Support Tickets</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ticket ID</th>
                                    <th>Subject</th>
                                    <th>Applicant</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTickets as $ticket)
                                <tr>
                                    <td>#{{ $ticket->id }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->applicant->fullname }}</td>
                                    <td>
                                        @if($ticket->status == 'Open')
                                            <span class="badge badge-danger">{{ $ticket->status }}</span>
                                        @elseif($ticket->status == 'In Progress')
                                            <span class="badge badge-warning">{{ $ticket->status }}</span>
                                        @else
                                            <span class="badge badge-success">{{ $ticket->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $ticket->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('support.tickets.show', $ticket->id) }}" class="btn btn-primary btn-sm">
                                            <i data-feather="eye"></i> View
                                        </a>
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
@endsection