@extends('layouts.main')
@section('content')
    <div class="container-fluid">
       @include('admin.cards')
        <!-- Booking history start-->
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 pb-1">
                    <div class="card-header-title">
                        <h4>Recent Applications</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div>
                        <div class="table-responsive table-desi">
                            <table class="user-table list-table  table table-striped">
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
                                                    <a href="javascript:void(0)">
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
                                    {{-- <tr>
                                        <td>14783112</td>
                                        <td>Gray Brody</td>
                                        <td>20-05-2020</td>
                                        <td>$369</td>
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
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking history  end-->
    </div>
@endsection
