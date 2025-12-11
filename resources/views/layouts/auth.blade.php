<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PAGE TITLE HERE -->
    <title>{{ env('APP_NAME') }} - @yield('pageTitle')</title>

    <link rel="icon" type="image/png" href="{{ asset('logos/icon.png') }}">

    <link href="{{ asset('dash/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('dash/css/style.css') }}" rel="stylesheet">

</head>

<body class="body h-100">
    <div class="container h-100" style="max-width: 570px;">
        @yield('content')
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('dash/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('dash/js/custom.min.js') }}"></script>
    <script src="{{ asset('dash/js/dlabnav-init.js') }}"></script>
    {{--<script src="{{ asset('dash/js/styleSwitcher.js') }}"></script>--}}
    <script>
        document.body.style.zoom="80%";
    </script>

</body>
</html>
