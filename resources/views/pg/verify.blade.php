{{-- <!DOCTYPE html>
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

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_io/site.webmanifest') }}">
    <title>MOAUM Postgraduate Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background: #f7f7f7;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 900px;
            min-height: 600px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            border-radius: 18px;
            overflow: hidden;
            display: flex;
        }

        .login-left {
            background: #6c1bc7;
            color: #fff;
            flex: 1.1;
            padding: 48px 32px 32px 32px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .login-left img {
            width: 90px;
            margin-bottom: 32px;
        }

        .login-left h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.1;
        }

        .login-left p {
            font-size: 1.1rem;
            opacity: 0.85;
        }

        .login-right {
            background: #fff;
            flex: 1;
            padding: 48px 40px 32px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .login-form label {
            font-weight: 600;
            color: #222;
        }

        .login-form .form-control {
            border: none;
            border-bottom: 1.5px solid #ccc;
            border-radius: 0;
            box-shadow: none;
            margin-bottom: 18px;
            background: transparent;
        }

        .login-form .form-control:focus {
            border-color: #6c1bc7;
            box-shadow: none;
        }

        .login-form .form-check-label {
            font-weight: 400;
            color: #666;
        }

        .btn-login {
            background: #6c1bc7;
            color: #fff;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(108, 27, 199, 0.18);
            border: none;
        }

        .btn-login:hover {
            background: #52159a;
        }

        .login-right .footer {
            position: absolute;
            bottom: 24px;
            left: 40px;
            font-size: 0.98rem;
            color: #888;
        }

        .login-right .footer a {
            color: #6c1bc7;
            text-decoration: none;
        }

        @media (max-width: 991px) {
            .login-card {
                flex-direction: column;
                width: 98vw;
            }

            .login-left,
            .login-right {
                padding: 32px 16px;
            }

            .login-right .footer {
                position: static;
                margin-top: 24px;
                left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Left Side -->
            <div class="login-left text-center">
                <img src="{{ asset('BSULOGO3.png') }}" alt="MOAUM Logo">
                <h2>Verify your<br>application number<br>to proceed<br></h2>
                <p>We are glad to see you again!</p>
            </div>
            <!-- Right Side -->

            <div class="login-right">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- <form class="login-form" method="GET" action="{{ route('applicant.verify.submit') }}">
                    @csrf
                    <h4 class="mb-4 fw-bold">PG Application Verification</h4>
                    <div class="mb-3">
                        <label for="email" class="form-label visually-hidden">PG Nummber</label>
                        <div class="input-group">
                            <input type="text" name="matno" value="{{ old('matno') }}" class="form-control"
                                id="username" placeholder="PG1234567"name="email" value="{{ old('email') }}" required
                                autocomplete="username" autofocus>
                            @error('matno')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-login w-100 mb-3">Verify</button>
                </form> --}}
                <form class="login-form" method="POST" action="{{ route('applicant.verify.submit') }}">
                    @csrf
                    <h4 class="mb-4 fw-bold">PG Application Verification</h4>
                    <div class="mb-3">
                        <label for="matno" class="form-label visually-hidden">PG Number</label>
                        <div class="input-group">
                            {{-- <input type="text" name="matno" value="{{ old('matno') }}" class="form-control"
                                id="matno" placeholder="S00200000001" pattern="^S\d{11}$" required autocomplete="username" autofocus> --}}
                            <input type="text" name="matno" value="{{ old('matno') }}" class="form-control"
                                id="matno" placeholder="S00200000001" pattern="^S002\d{8}$" required
                                autocomplete="username" autofocus>

                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-login w-100 mb-3">Verify</button>
                </form>
                <div class="footer">
                    MOAUM Postgraduate Application Portal. Powered by <br> <a href="{{ route('login') }}">Directorate of
                        ICT</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Bootstrap JS (optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
