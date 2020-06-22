<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset("/media/favicons/favicon.png")}}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap">

    <link rel="stylesheet" id="css-main" href="{{asset("/css/codebase.css")}}">
    <style>
        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6, body {
            font-family: 'Roboto', sans-serif;

        }

        .bg-gd-dusk {
            background-image: url('/media/bg-login.png') !important;
            background-position: center !important;
            background-repeat: no-repeat;
            height: 100vh;
            filter: blur(20px);
            -webkit-filter: blur(20px);
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;

        }

        .bg-gd-dusk2 {
            min-width: 34%;
            max-width: 40%;
        }

        .hero-static {
            min-height: 40% !important;;
            max-height: 70%;
            background: #ffffffab 0 0 no-repeat padding-box !important;
            box-shadow: 0 0 30px #0000004D;
            border: 0.550000011920929px solid #B2B2B2;
            border-radius: 2px;
            opacity: 1;
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
        }

        @media (max-width: 767.99px) {
            .mt-50, .my-50 {
                margin-top: 20px !important;
            }

            .hero-static {
                max-width: 90% !important;
                min-height: 90% !important;
            }

            .bg-gd-dusk2 {
                max-width: unset;
            }
        }
    </style>

</head>
<div id="page-container" class="main-content-boxed">

    <main id="main-container" class="d-flex justify-content-center align-items-center">

        <!-- Page Content -->
        <div class="bg-gd-dusk"></div>
        <div class="bg-gd-dusk2">
            <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
                <!-- Header -->
                <div class="py-30 px-5 text-center pb-50">
                    <a class="font-w700" href="#">
                        <img src="{{asset("/media/logo.png")}}">
                    </a>
                    @yield("title")
                </div>

                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
            @endif

            @yield('content')
            <!-- Sign In Form -->
                <div class="row justify-content-center px-5">
                    <div class="col-12">
                        <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <div class="row mt-50">
                            <div class="col-4">
                                {{--                                <a href="#" class="text-muted link-effect">Impressum</a>--}}
                            </div>
                            <div class="col-4 text-center">
                                <span class="text-muted">
                                    ©{{\Carbon\Carbon::now()->year}} {{ config('app.name', 'Laravel') }}</span>
                            </div>
                            <div class="col-4 text-right">
                                {{--                                <a href="#" class="text-muted link-effect">Datenschutz</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Sign In Form -->
            </div>
        </div>
        <!-- END Page Content -->

    </main>
</div>
<script src="{{asset("/js/codebase.core.min.js")}}"></script>

<script src="{{asset("/js/codebase.app.js")}}"></script>

@include("plugins.jquery-validate")
@yield("script")
</html>
