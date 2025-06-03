<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Application Profile</title>
    <link rel="stylesheet" href="{{asset('report/style.css')}}">
    <script type="importmap">
      {
        "imports": {
          "three": "https://unpkg.com/three@0.138.0/build/three.module.js",
          "three/addons/": "https://unpkg.com/three@0.138.0/examples/jsm/"
        }
      }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <header class="top-section">
            <div class="logo-container">
                <img src="{{asset('BSULOGO3.PNG')}}" alt="School Logo" id="schoolLogo">
            </div>
            <div class="school-address">
                <h2>Rev. Fr. Moses Orshio Adasu University, </h2>
                <h4>Makurdi.</h4>
                <h4>Application For Admission Into</h4>
                <h4>Post Graduate School</h4>
                <p>Application No: {{$applicant->appno}}</p>
            </div>
            <div class="passport-container">
                <img src="{{$applicant->passport}}" alt="Passport Photo" id="passportPhoto">
            </div>
        </header>

        <div class="mb-4" style="text-align:right;">
            <button class="btn btn-primary" onclick="window.print()" style="margin-right:10px; background:blue">
                <i class="fa fa-print"></i> Print
            </button>
            <button class="btn btn-danger" id="download-pdf-btn">
                <i class="fa fa-file-pdf-o"></i> Download PDF
            </button>
        </div>

        <section class="details-section">
            <h2>Personal Details</h2>
            <div class="details-grid personal-details-grid">
                <div class="detail-item"><span class="detail-label">Full Name:</span> {{$applicant->fullname}}</div>
                <div class="detail-item"><span class="detail-label">Gender:</span> {{$applicant->sex}}</div>
                <div class="detail-item"><span class="detail-label">Date of Birth:</span> {{$applicant->date_of_birth}}</div>
                <div class="detail-item"><span class="detail-label">Phone No:</span> {{$applicant->phone_no}}</div>
                <div class="detail-item"><span class="detail-label">Email Address:</span> {{$applicant->email_address}}</div>
                <div class="detail-item"><span class="detail-label">Nationality:</span> {{$applicant->country}}</div>
                <div class="detail-item"><span class="detail-label">State:</span> {{$applicant->state_of_origin}}</div>
                <div class="detail-item"><span class="detail-label">LGA:</span> {{$applicant->lga}}</div>
                <div class="detail-item detail-full-width"><span class="detail-label">Contact Address:</span>{{$applicant->contact_address}}</div>
            </div>
        </section>

        <section class="details-section">
            <h2>Course Details</h2>
            <div class="details-grid course-details-grid">
                <div class="detail-item"><span class="detail-label">Course Applied:</span> Computer Science</div>
                <div class="detail-item"><span class="detail-label">Department:</span> Computer Science</div>
                <div class="detail-item"><span class="detail-label">Faculty:</span> Science and Technology</div>
                <div class="detail-item"><span class="detail-label">Session:</span> 2024/2025</div>
                <div class="detail-item"><span class="detail-label">Programme:</span> Undergraduate (BSc)</div>
            </div>
        </section>

        <section class="table-section">
            <h2>Institutions Attended</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name of Institution</th>
                        <th>Field of Study</th>
                        <th>Period</th>
                        <th>Certificate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($institutionDetails as $institution)
                        <tr>
                            <td>{{$institution->institution_name}}</td>
                            <td>{{$institution->field_of_study}}</td>
                            <td>{{$institution->date_started }} to {{$institution->date_ended}}</td>
                            <td>{{$institution->certificate_awarded}}</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="table-section">
            <h2>Referees</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Rank/Position</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($referees as $referee)
                        <tr>
                            <td>{{$referee->fullname}}</td>
                            <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6b010a050e451806021f032b0e130a061b070e450e0f1e">{{$referee->email_address}}</a></td>
                            <td>{{$referee->phone_no}}</td>
                            <td>{{$referee->rank}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="certification-section">
            <h2>Credentials Submission</h2>
            <p class="certification-status">
                <input type="checkbox" id="credentialsSubmitted" name="credentialsSubmitted" checked disabled>
                <label for="credentialsSubmitted">I hereby certify that all required credentials have been submitted and are true to the best of my knowledge.</label>
            </p>
            <p class="signature-line">
                _________________________ <br>
                Applicant's Signature (or Digital Affirmation)
            </p>
        </section>

        <footer>
            <p>&copy; 2024 MOAUM. All rights reserved.</p>
        </footer>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="script.js" type="module"></script>
    <!-- html2pdf.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    document.getElementById('download-pdf-btn').addEventListener('click', function () {
        // Select the main content to export (excluding buttons)
        const element = document.querySelector('.container');
        // Optional: Remove the buttons before export
        const btns = document.querySelectorAll('.mb-4');
        btns.forEach(btn => btn.style.display = 'none');

        html2pdf().set({
            margin: 0.05,
            filename: 'application_report_{{ $applicant->appno }}.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'a3', orientation: 'portrait' }
        }).from(element).save().then(() => {
            // Restore buttons after export
            btns.forEach(btn => btn.style.display = '');
        });
    });
</script>
</body>
</html>