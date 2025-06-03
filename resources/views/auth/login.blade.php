{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!DOCTYPE html>
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
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>Voxo - log In</title>

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

                                {{-- <p class="sign-category">
                                <span>Or sign in with</span>
                            </p> --}}

                                {{-- <div class="row gx-md-3 gy-3">
                                <div class="col-md-6">
                                    <a href="javascript:void(0)">
                                        <div class="social-media fb-media">
                                            <img src="assets/images/facebook.png" class="img-fluid blur-up lazyload"
                                                alt="">
                                            <h6>Facebook</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="javascript:void(0)">
                                        <div class="social-media google-media">
                                            <img src="assets/images/google.png" class="img-fluid blur-up lazyload"
                                                alt="">
                                            <h6>Google</h6>
                                        </div>
                                    </a>
                                </div>
                            </div> --}}

                                {{-- <p>Not a member? <a href="sign-up.html" class="theme-color">Sign up now</a></p> --}}
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

</html>
