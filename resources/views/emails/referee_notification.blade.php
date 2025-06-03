{{-- 
<!DOCTYPE html>
<html>

<head>
    <title>Referee Notification</title>
</head>

<body>
    <h3>Dear {{ $referee->fullname }}!</h3>
    <p>You have been listed as a referee for applicant: <strong>{{$applicant->fullname}}</strong>.</p>

    <p>His/Her application for admission has been successfully submitted. Your reference/recommendation is required.</p>

    <h3>Application Details</h3>
    <p><strong>Applicant Name:</strong> {{ $applicant->fullname }}</p>
    <p><strong>Application No:</strong> ({{ $applicant->appno }})</p>
    <p><strong>Program:</strong> {{ $applicant->programme }}</p>
    <p><strong>Date Submitted:</strong> {{ now()->format('F j, Y') }}</p>
    <p>Click the link below to complete your reference:</p>
    <p><a href="{{ route('referee.reference', ['applicant' => $applicant->id, 'referee' => $referee->id]) }}">Complete Reference</a></p>
    <p><a href="#">Complete Reference</a></p>
    <p>Thank you.</p>

    <footer>
        <p>Best regards,<br>{{ config('app.name') }}</p>
    </footer>
</body>

</html> --}}
<!DOCTYPE html>
<html>

<head>
    <title>Referee Notification</title>
    <style>
        /* @tweakable primary color for the theme */
        :root {
            --primary-color: #007bff;
            --font-family: 'Arial', sans-serif;
            --background-color: #f4f4f4;
            --container-background: #ffffff;
            --text-color: #333333;
            --heading-color: #222222;
            --link-color: #ffffff;
            --button-hover-color: #0056b3;
            --footer-text-color: #777777;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            font-family: var(--font-family);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: var(--container-background);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }

        h3 {
            color: var(--heading-color);
            font-size: 1.5em;
            margin-top: 0;
            margin-bottom: 15px;
        }

        p {
            margin-bottom: 15px;
            font-size: 1em;
        }

        strong {
            color: var(--primary-color);
        }

        .application-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }

        .application-details p {
            margin-bottom: 8px;
        }

        .button-link {
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--link-color) !important; /* Important to override default link color */
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .button-link:hover {
            background-color: var(--button-hover-color);
            color: var(--link-color) !important;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: var(--footer-text-color);
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        footer p {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://www.bsum.edu.ng/njms/img/logo.png" alt="Company Logo" class="logo">
        </div>

        <h3>Dear {{ $referee->fullname }}!</h3>
        <p>You have been listed as a referee for applicant: <strong>{{$applicant->fullname}}</strong>.</p>

        <p>Their application for admission has been successfully submitted. Your reference/recommendation is required to complete the process.</p>

        <div class="application-details">
            <h3>Application Details</h3>
            <p><strong>Applicant Name:</strong> {{ $applicant->fullname }}</p>
            <p><strong>Application No:</strong> ({{ $applicant->appno }})</p>
            <p><strong>Program:</strong> {{ $applicant->programme }}</p>
            <p><strong>Date Submitted:</strong> {{ now()->format('F j, Y') }}</p>
        </div>

        <p>Please click the link below to securely submit your reference:</p>
        <p style="text-align: center; margin-top: 25px; margin-bottom: 25px;">
            {{-- <a href="{{ route('referee.reference', ['applicant' => $applicant->id, 'referee' => $referee->id]) }}" class="button-link">Complete Reference</a> --}}
            <a href="http://pg.test/referee-report/{{ $referee->id }}" class="button-link">Complete Reference</a>
        </p>
        
        <p>Your timely response is greatly appreciated.</p>
        <p>Thank you.</p>

        <footer>
            <p>Best regards,<br>{{ config('app.name') }}</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>