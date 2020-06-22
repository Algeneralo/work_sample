@extends('layouts.app')

@section("title")
    <h1 class="h2 mt-50 mb-10 font-w300">@lang("auth.login-message")</h1>
    <h2 class="h6 font-w400 mb-0">@lang("auth.login-with-email")</h2>
@endsection
@section('content')
    <!-- Main Container -->
    <form class="js-validation-bootstrap" method="POST"
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
            <div class="col-12 mb-10">
                <a href="{{ route('password.request') }}" class="text-center d-block font-size-md">
                    @lang("auth.forgot-password")
                </a>
            </div>
        </div>
    </form>
@endsection
