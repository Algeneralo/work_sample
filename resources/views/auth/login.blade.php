@extends('layouts.app')

@section('content')
    <!-- Main Container -->
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
                    <h1 class="h2 mt-50 mb-10 font-w300">@lang("auth.login-message")</h1>
                    <h2 class="h6 font-w400 mb-0">@lang("auth.login-with-email")</h2>
                </div>
                <!-- END Header -->

                <!-- Sign In Form -->
                <div class="row justify-content-center px-5">
                    <div class="col-12">
                        <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-signin" method="POST"
                              action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text"
                                               class="form-control  @if($errors->has("email")) is-invalid @endif"
                                               name="email" required id="login-username" value="{{ old('email') }}">
                                        <label for="login-username">@lang("auth.your-email")</label>
                                        @if($errors->has("email"))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first("email")}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="password" id="login-password"
                                               class="form-control @if($errors->has("password"))  is-invalid @endif"
                                               name="password"
                                               required autocomplete="current-password">
                                        <label for="login-password">@lang("auth.your-password")</label>
                                        @if($errors->has("email"))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first("password")}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row gutters-tiny mt-50">
                                <div class="col-12 mb-10 mx-auto">
                                    <button type="submit"
                                            class="btn btn-primary mx-auto d-block font-size-lg border-transparent">
                                        @lang("auth.login")
                                    </button>
                                </div>

                            </div>
                            <div class="form-group row gutters-tiny mt-30">
{{--                                <div class="col-12 mb-10">--}}
{{--                                    <a href="#" class="text-center d-block text-black font-size-md">--}}
{{--                                        Passwort vergessen--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            </div>
                        </form>
                        <div class="row mt-50">
                            <div class="col-4">
{{--                                <a href="#" class="text-muted link-effect">Impressum</a>--}}
                            </div>
                            <div class="col-4 text-center">
                                <span class="text-muted">©{{\Carbon\Carbon::now()->year}} {{ config('app.name', 'Laravel') }}</span>
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
    <!-- END Main Container -->
@endsection
