<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MOAUM Postgraduate Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <img src="" alt="MOAUM Logo">
                <h2>Verify your<br>application number<br>to proceed<br></h2>
                <p>We are glad to see you again!</p>
            </div>
            <!-- Right Side -->

            <div class="login-right">
                <form class="login-form" method="POST" action="#">
                   
                    <h4 class="mb-4 fw-bold">PG Application Verification</h4>
                    <div class="mb-3">
                        <label for="matno" class="form-label visually-hidden">PG Number</label>
                        <div class="input-group">
                            <input type="text" name="matno"  class="form-control"
                                id="matno" placeholder="PG1234567" pattern="^S\d{11}$" required autocomplete="username" autofocus>
                           
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
                    MOAUM Postgraduate Application Portal. Powered by <br> <a href="#">Directorate of
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
