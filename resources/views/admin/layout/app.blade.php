<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vidfee : Pay-to-respond video messages that connect you and your community." />
    <meta property="og:title" content="Vidfee : Pay-to-respond video messages that connect you and your community." />
    <meta property="og:description" content="Vidfee : Pay-to-respond video messages that connect you and your community." />
    <meta property="og:image" content="{{ asset('favicon_logo.png') }}" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>{{ env('APP_NAME') }} - @yield('pageTitle')</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset('logos/icon.png') }}">

    <!-- Vectormap -->
    <link href="{{ asset('dash/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('dash/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('dash/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('dash/css/style.css') }}" rel="stylesheet">
    <style>
        html{
            -moz-transform: scale(0.8);
        }
        .modal-backdrop{
            width: 100% !important;
            height: 100% !important;
        }
    </style>
    @yield('styles')

</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    @include('admin.layout.header')
    {{--@include('admin.layout.sidebar')--}}

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body m-auto">
        <!-- row -->
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    @include('admin.layout.footer')

    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('dash/vendor/global/global.min.js') }}"></script>
{{-- <script src="{{ asset('dash/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script> --}}
<script src="{{ asset('dash/vendor/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('dash/vendor/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('dash/js/custom.min.js') }}"></script>
<script src="{{ asset('dash/js/dlabnav-init.js') }}"></script>

<!-- Toastr -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.body.style.zoom="80%";
</script>
@yield('scripts')

</body>
</html>
