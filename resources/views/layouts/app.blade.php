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
        }
    </style>

</head>
<div id="page-container" class="main-content-boxed">

    @yield("content")
</div>
<script src="{{asset("/js/codebase.core.min.js")}}"></script>

<script src="{{asset("/js/codebase.app.js")}}"></script>

@include("plugins.jquery-validate")
@yield("script")
</html>
