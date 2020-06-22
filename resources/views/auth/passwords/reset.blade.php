@extends('layouts.app')

@section("title")
    <h1 class="h2 mt-50 mb-10 font-w300">@lang("passwords.reset password")</h1>
    <h2 class="h6 font-w400 mb-0">@lang("passwords.reset password message")</h2>
@endsection
@section('content')
    <!-- Main Container -->
    <form method="POST" action="{{ route('password.update') }}" class="js-validation-bootstrap">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="email"
                           class="form-control  @error('email') is-invalid @enderror"
                           name="email" required id="login-username" value="{{$email ?? old('email') }}">
                    <label for="login-username">@lang("auth.your-email")</label>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror

                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="password" id="password"
                           class="form-control  @error('password') is-invalid @enderror"
                           name="password" autocomplete="new-password" data-rule-minlength="6" required>
                    <label for="login-username">@lang("auth.password")</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="password"
                           class="form-control" data-rule-minlength="6"
                           data-rule-equalto="#password"
                           name="password_confirmation" required>
                    <label for="login-username">@lang("passwords.repeat password")</label>
                </div>
            </div>
        </div>
        <div class="form-group row gutters-tiny mt-50">
            <div class="col-12 mb-10 mx-auto">
                <button type="submit"
                        class="btn btn-primary mx-auto d-block font-size-lg border-transparent">
                    @lang("passwords.reset button")
                </button>
            </div>
        </div>
        <div class="form-group row mt-10">
            <div class="col-12">
                <a href="{{ route('login') }}" class="text-center d-block font-size-md">
                    @lang('passwords.back to login',['url'=>route('login')])
                </a>
            </div>
        </div>
    </form>
@endsection
