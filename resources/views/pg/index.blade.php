@extends('layouts.dashboard')
@section('content')
    <div class="title-header">
        <h5>Bio Data</h5>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Personal Information</h5>
                                </div>
                                <form method="POST" action="{{ route('application.update', $applicant['appno']) }}"
                                    class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">
                                                Application No</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $applicant['appno'] }}" type="text"
                                                    placeholder="Product Name" readonly>
                                                <input class="form-control" value="{{ $applicant['appno'] }}" type="text"
                                                    hidden name="appno">
                                            </div>

                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Application
                                                Type</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="js-example-basic-single w-100" name="application_type">
                                                    <option disabled>{{ $applicant['application_type'] ?? '' }}</option>
                                                    <option value="Postgraduate">Postgraduate</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">
                                                Full Name</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="fullname"
                                                    value="{{ $applicant['fullname'] ?? '' }}" type="text"
                                                    placeholder="Full Name">
                                            </div>

                                            <label class="form-label-title col-sm-2 mb-4">
                                                Email Address</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $applicant['email_address'] ?? '' }}"
                                                    name="email_address" type="text" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Gender</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="js-example-basic-single w-100" name="sex">
                                                    <option value="{{ $applicant['sex'] }}" selected='selected'>
                                                        {{ $applicant['sex'] ?? '' }}</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>

                                            <label class="col-lg-2 col-md-3 mb-4 col-form-label form-label-title">
                                                Date Of Birth</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $applicant['date_of_birth'] ?? '' }}"
                                                    name="date_of_birth" type="date" placeholder="Date Of Birth">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center nigeriaFields">
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Country</label>
                                            <div class="col-sm-4 mb-4" id="internationalFields" style="display: none;">
                                                <select class="js-example-basic-single w-100" name="country" id="country"
                                                    required>
                                                    <option value="{{ $applicant['country'] }}" selected='selected'>
                                                        {{ $applicant['country'] ?? '' }}</option>
                                                        <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">State</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="js-example-basic-single w-100" name="state_of_origin"
                                                    id="state" onchange="selectLGA(this)" required>
                                                    <option value="{{ $applicant['state_of_origin'] }}" selected='selected'>
                                                        {{ $applicant['state_of_origin'] ?? '' }}</option>
                                                        <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">LGA</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="js-example-basic-single w-100" name="lga" id="lga"
                                                    required>
                                                    <option disabled>LGA Menu</option>
                                                    <option value="{{ $applicant['lga'] }}" selected='selected'>
                                                        {{ $applicant['lga'] ?? '' }}</option>
                                                </select>
                                            </div>

                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Home Town</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $applicant->home_town }}"
                                                    name="home_town" type="text" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Address</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control"
                                                    value="{{ $applicant['contact_address'] ?? '' }}"
                                                    name="contact_address" type="text" placeholder="Address">
                                            </div>

                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Phone
                                                Number</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $applicant['phone_no'] ?? '' }}"
                                                    name="phone_no" type="text" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="button login button-1 text-center">
                                            <button class="btn btn-primary" type="submit">
                                                <span>Save</span>
                                                <i class="fa fa-check"></i>
                                            </button>
                                            {{-- <a href="{{ route('institution_details.form', $applicant['appno']) }}">
                                                <button class="btn btn-success" type="button" style="background: blue">
                                                    <span>Next</span>
                                                    <i class="fa fa-arrow-right"></i>
                                                </button>
                                            </a> --}}

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch the list of countries from the API
            fetch('https://restcountries.com/v3.1/all') // Example API
                .then(response => response.json())
                .then(data => {
                    const countrySelect = document.getElementById('country');

                    data.sort((a, b) => a.name.common.localeCompare(b.name.common)); // Sort countries alphabetically
                    // Loop through the data and create option elements
                    data.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.name.common; // Use country full name as value
                        option.textContent = country.name.common; // Use country name as display text
                        countrySelect.appendChild(option);
                    });

                    // Show the dropdown after populating
                    document.getElementById('internationalFields').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching country data:', error);
                });
        });
    </script>
    
    <script>
        //Fetch all States
        fetch('https://nga-states-lga.onrender.com/fetch')
            .then((res) => res.json())
            .then((data) => {
                var x = document.getElementById("state");
                for (let index = 0; index < Object.keys(data).length; index++) {
                    var option = document.createElement("option");
                    option.text = data[index];
                    option.value = data[index];
                    x.add(option);
                }
            });
        //Fetch Local Goverments based on selected state
        function selectLGA(target) {
            var state = target.value;
            fetch('https://nga-states-lga.onrender.com/?state=' + state)
                .then((res) => res.json())
                .then((data) => {
                    var x = document.getElementById("lga");

                    var select = document.getElementById("lga");
                    var length = select.options.length;
                    for (i = length - 1; i >= 0; i--) {
                        select.options[i] = null;
                    }
                    for (let index = 0; index < Object.keys(data).length; index++) {
                        var option = document.createElement("option");
                        option.text = data[index];
                        option.value = data[index];
                        x.add(option);
                    }
                });
        }
    </script>
@endsection
