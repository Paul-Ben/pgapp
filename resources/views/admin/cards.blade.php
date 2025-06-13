 <div class="row">
     <!-- chart caard section start -->
     <div class="col-sm-6 col-xxl-4 col-lg-6">
         <div class="b-b-primary border-5 border-0 card o-hidden">
             <a href="{{ route('all.applicants') }}">
                 <div class="custome-1-bg b-r-4 card-body">
                     <div class="media align-items-center static-top-widget">
                         <div class="media-body p-0">
                             <span class="m-0">Total Applications</span>
                             <h4 class="mb-0 counter">{{ $applicaationcount }}
                                 <span class="badge badge-light-primary grow">
                                     <i data-feather="trending-up"></i>8.5%</span>
                             </h4>
                         </div>
                         <div class="align-self-center text-center">
                             <i data-feather="database"></i>
                         </div>
                     </div>
                 </div>
             </a>

         </div>
     </div>

     <div class="col-sm-6 col-xxl-4 col-lg-6">
         <div class="b-b-danger border-5 border-0 card o-hidden">
             <a href="{{ route('completed.applications') }}">
                 <div class=" custome-2-bg  b-r-4 card-body">
                     <div class="media static-top-widget">
                         <div class="media-body p-0">
                             <span class="m-0">Complete Applications</span>
                             <h4 class="mb-0 counter">{{ $completedApplications }}
                                 <span class="badge badge-light-danger grow">
                                     <i data-feather="trending-down"></i>8.5%</span>
                             </h4>
                         </div>
                         <div class="align-self-center text-center">
                             <i data-feather="shopping-bag"></i>
                         </div>
                     </div>
                 </div>
             </a>

         </div>
     </div>

     <div class="col-sm-6 col-xxl-4 col-lg-6">
         <div class="b-b-secondary border-5 border-0  card o-hidden">
             <div class=" custome-3-bg b-r-4 card-body">
                 <div class="media static-top-widget">
                     <div class="media-body p-0">
                         <span class="m-0">Incomplete Applications</span>
                         <h4 class="mb-0 counter">{{ $incompleteApplications }}
                             <span class="badge badge-light-secondary grow ">
                                 <i data-feather="trending-up"></i>8.5%</span>
                         </h4>
                     </div>

                     <div class="align-self-center text-center">
                         <i data-feather="message-circle"></i>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     {{-- <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="b-b-success border-5 border-0 card o-hidden">
                    <div class=" custome-4-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total User</span>
                                <h4 class="mb-0 counter">45631
                                    <span class="badge badge-light-success grow">
                                        <i data-feather="trending-down"></i>8.5%</span>
                                </h4>
                            </div>

                            <div class="align-self-center text-center">
                                <i data-feather="user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
     <!-- chart caard section End -->
 </div>
