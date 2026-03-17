<!DOCTYPE html>
<html lang="vi">

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('account/images/icons/favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('account/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('account/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('account/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('account/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('account/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('account/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('account/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('account/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('account/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('account/css/main.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZtj4ZqfK1h6vFhRbNQF8rR2S0q6rvj6aq8qC7EwEsmexjSPh5tOKm84x6Y5W" crossorigin="anonymous">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('account/images/bg-01.jpg') }}');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

                <div class="text-center m-3">
                    <a href="/" class="badge badge-success">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

    <script src="{{ asset('account/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('account/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('account/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('account/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('account/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('account/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('account/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('account/vendor/countdowntime/countdowntime.js') }}"></script>
    <script src="{{ asset('account/js/main.js') }}"></script>

</body>

</html>
