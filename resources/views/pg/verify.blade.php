<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PG Application Number Verification">
    <meta name="keywords" content="application, verification">
    <meta name="author" content="your-organization">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon_io/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon_io/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon_io/site.webmanifest')}}">
    <title>PG Application Verification</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
</head>

<body>
    <!-- verification page start-->
    <form method="POST" action="{{ route('applicant.verify.submit') }}">
        @csrf
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="login-section">
                        <div class="materialContainer">
                            <div class="box">
                                <div class="logo">
                                    <img src="{{asset('BSULOGO3.png')}}" alt="logo" class="img-fluid" style="width: 100px; height: auto;">
                                </div>
                                <div class="login-title">
                                    <h2>PG Application Verification</h2>
                                </div>
                                <div class="input">
                                    <label for="app_number">PG Application Number</label>
                                    <input type="text" name="matno" value="{{ old('matno') }}" placeholder="PG1234567" id="app_number" required autofocus>
                                    @error('app_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="spin"></span>
                                </div>

                                <div class="button login">
                                    <button type="submit">
                                        <span>Verify</span>
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- latest jquery-->
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>

    <!-- Theme js-->
    <script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>