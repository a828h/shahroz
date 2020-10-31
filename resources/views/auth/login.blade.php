@extends('layouts.auth')

@section('content')
<!--begin::Login Sign in form-->
<div class="login-signin">
    <div class="mb-20">
        <h3>{{ __('auth.Login') }}</h3>
        <div class="text-muted font-weight-bold">@lang('auth.login_desc')</div>
    </div>
    <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror"
                type="text" placeholder="{{ __('auth.E-Mail-Address') }}" value="{{ old('email') }}" name="email"
                required autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('password')
                        is-invalid @enderror" type="password" placeholder="{{ __('auth.Password') }}" name="password"
                required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
            <label class="checkbox m-0 text-muted">
                <input type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }} />{{ __('auth.Remember Me') }}
                <span></span></label>
            @if(Route::has('password.request'))
            <div class="col m--align-right m-login__form-right">
                <a href="{{ route('password.request') }}" id="kt_login_forgot" class="text-muted text-hover-primary">
                    {{ __('auth.Forgot Your Password?') }}
                </a>
            </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
            {{ __('auth.Login') }}
        </button>
    </form>
    <div class="mt-10">
        <span class="opacity-70 mr-4">{{ __('auth.Dont have an account yet ?') }}</span>
        <a href="{{ route('register') }}" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">{{ __('auth.Register') }}</a>
    </div>
</div>
<!--end::Login Sign in form-->
@endsection