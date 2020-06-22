@extends('layouts.app')

@section("title")
    <h1 class="h2 mt-50 mb-10 font-w300">@lang("passwords.Don’t worry, we’ve got your back")</h1>
@endsection
@section('content')
    <!-- Main Container -->
    <form class="js-validation-signin" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group row">
            <div class="col-12">
                <div class="form-material floating">
                    <input type="email"
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

        <div class="form-group row gutters-tiny mt-50">
            <div class="col-12 mb-10 mx-auto">
                <button type="submit"
                        class="btn btn-primary mx-auto d-block font-size-lg border-transparent">
                    @lang("passwords.reset button")
                </button>
            </div>
        </div>

        <div class="form-group row gutters-tiny mt-30">
            <div class="col-12 mb-10">
                <a href="{{ route('login') }}" class="text-center d-block font-size-md">
                    @lang('passwords.back to login',['url'=>route('login')])
                </a>
            </div>
        </div>
    </form>
@endsection