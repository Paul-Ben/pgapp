{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
     <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon_io/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon_io/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon_io/site.webmanifest')}}">
    <title>PG Admin - log In</title>

    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
</head>

<body>
    <!-- login page start-->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="login-section">
                        <div class="materialContainer">
                            <div class="box">
                                <div>
                                    <div class="logo">
                                        <img src="{{asset('BSULOGO3.png')}}" class="img-fluid blur-up lazyload"
                                          width="100px" height="100px"  alt="">
                                    </div>
                                </div>
                                <div class="login-title">
                                    <h2>Login</h2>
                                </div>
                                <div class="input">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="name" value="{{ old('email') }}" required
                                        autocomplete="username" autofocus>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="spin"></span>
                                </div>

                                <div class="input">
                                    <label for="pass">Password</label>
                                    <input type="password" name="password" id="pass" required
                                        autocomplete="current-password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="spin"></span>
                                </div>

                                <a href="forgot-password.html" class="pass-forgot">Forgot your password?</a>

                                <div class="button login">
                                    <button onclick="location.href = 'index.html';">
                                        <span>Log In</span>
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- latest jquery-->
            <script src="assets/js/jquery-3.6.0.min.js"></script>

            <!-- Bootstrap js-->
            <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

            <!-- Theme js-->
            <script src="assets/js/script.js"></script>
        </div>
    </form>
</body>

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MOAUM Undergraduate Portal Login</title>
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
                <h2>Keep<br>connected<br>with MOAUM<br>Postgraduate Portal</h2>
                <p>We are glad to see you again!</p>
            </div>
            <!-- Right Side -->
            <div class="login-right">
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h4 class="mb-4 fw-bold">SIGN IN</h4>
                    <div class="mb-3">
                        <label for="email" class="form-label visually-hidden">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" placeholder="Email"name="email"
                                value="{{ old('email') }}" required autocomplete="username" autofocus>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-envelope"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label visually-hidden">Password</label>
                        <div class="input-group">
                            <label for="pass">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                autocomplete="current-password" placeholder="Password" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-login w-100 mb-3">Log In</button>
                </form>
                <div class="footer">
                    MOAUM Undergraduate Portal. Powered by <br> <a href="#">ICT Unit</a>
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
