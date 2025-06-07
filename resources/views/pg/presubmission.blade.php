<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon_io/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon_io/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon_io/site.webmanifest')}}">
    <title>PG Application</title>
    <link rel="stylesheet" href="{{ asset('report/style.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="presubmissionModal" tabindex="-1" aria-labelledby="presubmissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="presubmissionModalLabel"><i
                            class="fa fa-exclamation-triangle text-danger"></i> Please Review Carefully</h5>
                </div>
                <div class="modal-body">
                    <p>
                        <strong>Attention:</strong> Please carefully go through the form and make any final
                        adjustments.<br>
                        <span class="text-danger">Once you submit, further editing will require contacting ICT
                            support.</span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif
        <form action="{{ route('presubmission.update', $applicant->appno) }}" method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <header class="top-section mb-4">
                <div class="logo-container">
                    <img src="{{ asset('BSULOGO3.PNG') }}" alt="School Logo" id="schoolLogo">
                </div>
                <div class="school-address">
                    <h2>Reverend Father Moses Orshio Adasu University, Makurdi.</h2>
                    <h4>Application For Admission Into</h4>
                    <h4>Post Graduate School</h4>
                    <p>Application No: {{ $applicant->appno }}</p>
                </div>
                <div class="passport-container">
                    <img src="{{ $applicant->passport }}" alt="Passport Photo" id="passportPhoto">
                    <input type="file" name="passport" id="passportInput" class="form-control mt-2" accept="image/*">
                </div>
            </header>

            <section class="details-section mb-4">
                <h2>Personal Details</h2>
                <div class="details-grid personal-details-grid">
                    <div class="detail-item">
                        <span class="detail-label">Full Name:</span>
                        <input type="text" name="fullname" value="{{ $applicant->fullname }}" class="form-control">
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Gender:</span>
                        <select name="sex" class="form-control">
                            <option value="Male" {{ $applicant->sex == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $applicant->sex == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Date of Birth:</span>
                        <input type="date" name="date_of_birth" value="{{ $applicant->date_of_birth }}"
                            class="form-control">
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Phone No:</span>
                        <input type="text" name="phone_no" value="{{ $applicant->phone_no }}" class="form-control">
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email Address:</span>
                        <input type="email" name="email_address" value="{{ $applicant->email_address }}"
                            class="form-control">
                    </div>
                    {{-- <div class="detail-item">
                        <span class="detail-label">Nationality:</span> 
                        <input type="text" name="country" value="{{$applicant->country}}" class="form-control">
                    </div> --}}
                    <div class="detail-item nigeriaFields" id="internationalFields" style="display: none;">
                        <span class="detail-label">Nationality:</span>
                        <select name="country" class="form-control" id="country">
                            <option value="">Select Country</option>
                            <option value="{{ $applicant->country }}" selected>{{ $applicant->country }}
                            </option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    {{-- <div class="detail-item nigeriaFields">
                        <span class="detail-label">State:</span>
                        <input type="text" name="state_of_origin" value="{{ $applicant->state_of_origin }}"
                            class="form-control">
                    </div> --}}
                    <div class="detail-item nigeriaFields">
                        <span class="detail-label">State:</span>
                        <select name="state_of_origin" id="state" class="form-control" onchange="selectLGA(this)">
                            <option value="">Select State</option>
                            <option value="Other">Other</option>
                            @if ($applicant->state_of_origin)
                                <option value="{{ $applicant->state_of_origin }}" selected>
                                    {{ $applicant->state_of_origin }}</option>
                            @endif
                            <!-- States will be dynamically populated by JS -->
                        </select>
                    </div>
                    {{-- <div class="detail-item">
                        <span class="detail-label">LGA:</span>
                        <input type="text" name="lga" value="{{ $applicant->lga }}" class="form-control">
                    </div> --}}
                    <div class="detail-item">
                        <span class="detail-label">LGA:</span>
                        <select name="lga" id="lga" class="form-control">
                            @if ($applicant->lga)
                                <option value="{{ $applicant->lga }}" selected>{{ $applicant->lga }}</option>
                            @else
                                <option value="">Select LGA</option>
                            @endif
                            <!-- LGAs will be dynamically populated by JS -->
                        </select>
                    </div>
                    <div class="detail-item detail-full-width">
                        <span class="detail-label">Contact Address:</span>
                        <textarea name="contact_address" class="form-control">{{ $applicant->contact_address }}</textarea>
                    </div>
                </div>
            </section>

            <section class="details-section mb-4">
                <h2>Course Details</h2>
                <div class="details-grid course-details-grid">
                    <div class="detail-item">
                        <span class="detail-label">Course Applied:</span>
                        {{-- <input type="text" name="course_applied" value="Computer Science" class="form-control"> --}}
                        <select name="first_choice" class="form-control" id="">
                            <option value="{{ $applicant->first_choice }}" selected>{{ $applicant->first_choice }}</option>
                            @foreach ($programmes as  $programme  )
                                <option value="{{ $programme->code }}">{{ $programme->name }}</option>
                                
                            @endforeach
                        </select>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Department:</span>
                        <input type="text" name="department" value="Computer Science" class="form-control">
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Faculty:</span>
                        <input type="text" name="faculty" value="Science and Technology" class="form-control">
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Session:</span>
                        <input type="text" name="session" value="2024/2025" class="form-control">
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Programme:</span>
                        <select name="programme" class="form-control">
                            <option value="Undergraduate (BSc)" selected>Undergraduate (BSc)</option>
                            <option value="Postgraduate (MSc)">Postgraduate (MSc)</option>
                            <option value="PhD">PhD</option>
                        </select>
                    </div>
                </div>
            </section>

            <section class="table-section mb-4">
                <h2>Institutions Attended</h2>
                <div id="institutions-container">
                    @foreach ($institutionDetails as $index => $institution)
                        <div class="institution-item mb-3 p-3 border">

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label>Name of Institution</label>
                                    <input type="text" name="institutions[{{ $index }}][institution_name]"
                                        value="{{ $institution->institution_name }}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Field of Study</label>
                                    <input type="text" name="institutions[{{ $index }}][field_of_study]"
                                        value="{{ $institution->field_of_study }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label>Date Started</label>
                                    <input type="date" name="institutions[{{ $index }}][date_started]"
                                        value="{{ $institution->date_started }}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Date Ended</label>
                                    <input type="date" name="institutions[{{ $index }}][date_ended]"
                                        value="{{ $institution->date_ended }}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Certificate Awarded</label>
                                    <input type="text"
                                        name="institutions[{{ $index }}][certificate_awarded]"
                                        value="{{ $institution->certificate_awarded }}" class="form-control">
                                </div>
                            </div>
                            {{-- <button type="button" class="btn btn-sm btn-danger remove-institution">Remove</button> --}}
                        </div>
                    @endforeach
                </div>
                {{-- <button type="button" id="add-institution" class="btn btn-primary mt-2">Add Institution</button> --}}
            </section>

            <section class="table-section mb-4">
                <h2>Referees</h2>
                <div id="referees-container">
                    @foreach ($referees as $index => $referee)
                        <div class="referee-item mb-3 p-3 border">
                            <input type="hidden" name="referees[{{ $index }}][id]"
                                value="{{ $referee->id }}">
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label>Full Name</label>
                                    <input type="text" name="referees[{{ $index }}][fullname]"
                                        value="{{ $referee->fullname }}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Email</label>
                                    <input type="email" name="referees[{{ $index }}][email_address]"
                                        value="{{ $referee->email_address }}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Phone No</label>
                                    <input type="text" name="referees[{{ $index }}][phone_no]"
                                        value="{{ $referee->phone_no }}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Rank/Position</label>
                                    <input type="text" name="referees[{{ $index }}][rank]"
                                        value="{{ $referee->rank }}" class="form-control">
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger remove-referee">Remove</button>
                        </div>
                    @endforeach
                </div>
                {{-- <button type="button" id="add-referee" class="btn btn-primary mt-2">Add Referee</button> --}}
            </section>
            <section>
                <div class="mb-4" style="text-align:center;">
                    <button type="submit" class="btn btn-success" style="margin-right:10px;">
                        <i class="fa fa-save"></i> Save Changes
                    </button>
                </div>

            </section>
            {{-- <section class="certification-section mb-4">
                <h2>Credentials Submission</h2>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="credentialsSubmitted" name="credentialsSubmitted" checked>
                    <label class="form-check-label" for="credentialsSubmitted">
                        I hereby certify that all required credentials have been submitted and are true to the best of my knowledge.
                    </label>
                </div>
                <div class="mt-3">
                    <label>Digital Signature</label>
                    <input type="text" name="digital_signature" class="form-control" placeholder="Type your full name as digital signature">
                </div>
            </section> --}}

            <footer class="mt-4">
                <p>&copy; 2024 MOAUM. All rights reserved.</p>
            </footer>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- html2pdf.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        // Show modal on page load
        document.addEventListener('DOMContentLoaded', function() {
            var presubmissionModal = new bootstrap.Modal(document.getElementById('presubmissionModal'));
            presubmissionModal.show();
        });

        // ...rest of your JS code...
    </script>
    <script>
        // PDF Download functionality
        document.getElementById('download-pdf-btn').addEventListener('click', function() {
            const element = document.querySelector('.container');
            const btns = document.querySelectorAll('.mb-4');
            btns.forEach(btn => btn.style.display = 'none');

            html2pdf().set({
                margin: 0.05,
                filename: 'application_report_{{ $applicant->appno }}.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a3',
                    orientation: 'portrait'
                }
            }).from(element).save().then(() => {
                btns.forEach(btn => btn.style.display = '');
            });
        });

        // Add new institution
        document.getElementById('add-institution').addEventListener('click', function() {
            const container = document.getElementById('institutions-container');
            const index = container.children.length;

            const html = `
                <div class="institution-item mb-3 p-3 border">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label>Name of Institution</label>
                            <input type="text" name="institutions[${index}][institution_name]" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Field of Study</label>
                            <input type="text" name="institutions[${index}][field_of_study]" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label>Date Started</label>
                            <input type="date" name="institutions[${index}][date_started]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Date Ended</label>
                            <input type="date" name="institutions[${index}][date_ended]" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Certificate Awarded</label>
                            <input type="text" name="institutions[${index}][certificate_awarded]" class="form-control">
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-institution">Remove</button>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);
        });

        // Add new referee
        document.getElementById('add-referee').addEventListener('click', function() {
            const container = document.getElementById('referees-container');
            const index = container.children.length;

            const html = `
                <div class="referee-item mb-3 p-3 border">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label>Full Name</label>
                            <input type="text" name="referees[${index}][fullname]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Email</label>
                            <input type="email" name="referees[${index}][email_address]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Phone No</label>
                            <input type="text" name="referees[${index}][phone_no]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Rank/Position</label>
                            <input type="text" name="referees[${index}][rank]" class="form-control">
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-referee">Remove</button>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);
        });

        // Remove institution or referee
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-institution')) {
                e.target.closest('.institution-item').remove();
            }
            if (e.target.classList.contains('remove-referee')) {
                e.target.closest('.referee-item').remove();
            }
        });

        // Preview passport photo when selected
        document.getElementById('passportInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('passportPhoto').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Fetch the list of countries from the API
            fetch('https://restcountries.com/v3.1/all') // Example API
                .then(response => response.json())
                .then(data => {
                    const countrySelect = document.getElementById('country');

                    data.sort((a, b) => a.name.common.localeCompare(b.name
                        .common)); // Sort countries alphabetically
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
</body>

</html>
