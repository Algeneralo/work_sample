@extends('layouts.app')

@section('content')
    <form class="js-validation-reminder" method="POST" action="{{ route('password.email') }}"
          novalidate="novalidate">
        @csrf
        <div class="block block-themed block-rounded block-shadow">
            <div class="block-header bg-gd-primary">
                <h3 class="block-title">Password Reminder</h3>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <div class="col-12">
                        <label for="reminder-credential">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="reminder-credential"
                               name="email" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-alt-primary">
                        <i class="fa fa-asterisk mr-10"></i> Password Reminder
                    </button>
                </div>
            </div>
            <div class="block-content bg-body-light">
                <div class="form-group text-center">
                    <a class="link-effect text-muted mr-10 mb-5 d-inline-block"
                       href="{{route("login")}}">
                        <i class="fa fa-user text-muted mr-5"></i> Sign In
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
@section("script")
    <script src="{{asset("/js/pages/op_auth_reminder.min.js")}}"></script>
@endsection