@extends('layouts.auth')

@section('content')
<!--begin::Login Sign in form-->
<div class="login-signin">
    <div class="mb-20">
        <h3>{{ __('auth.Reset Password') }}</h3>
    </div>
    <form class="form" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token ?? '' }}">
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" type="email"
                placeholder="{{ __('auth.E-Mail-Address') }}" name="email"
                value="{{ $email ?? old('email') }}" required autocomplete="email"
                autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('password')
                        is-invalid @enderror" type="password" placeholder="{{ __('auth.Password') }}"
                name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8" name="password_confirmation" required
                autocomplete="new-password" type="password"
                placeholder="{{ __('auth.Confirm Password') }}">
        </div>
       
        <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
            {{ __('auth.Reset Password') }}
        </button>
    </form>
    <div class="mt-10">
        <span class="opacity-70 mr-4">{{ __('auth.Dont have an account yet ?') }}</span>
        <a href="{{ route('register') }}" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">{{ __('auth.Register') }}</a>
    </div>
</div>
@endsection
