@extends('layouts.auth')

@section('content')
<div class="login-forgot" style="display: block">
    <div class="mb-20">
        <h3>{{ __('auth.Reset Password') }}</h3>
        <div class="text-muted font-weight-bold">{{ __('auth.Enter your email to reset your password') }}</div>
    </div>
    <form class="form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="input-group mb-10">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" type="text"
                placeholder="{{ __('auth.E-Mail-Address') }}" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button type="submit"
                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('auth.Request') }}</button>
            <a href="{{ route('login') }}"
                class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('auth.Cancel') }}</a>
        </div>
    </form>
    <div class="mt-10">
        <span class="opacity-70 mr-4">{{ __('auth.Dont have an account yet ?') }}</span>
        <a href="{{ route('register') }}" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">{{ __('auth.Register') }}</a>
    </div>
</div>
@endsection
