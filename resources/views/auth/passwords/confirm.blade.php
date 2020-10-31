@extends('layouts.auth')

@section('content')
<!--begin::Login forgot password form-->
<div class="login-forgot" style="display: block">
    <div class="mb-20">
        <h3>{{ __('auth.Confirm Email Form') }}</h3>
        <div class="text-muted font-weight-bold">{{ __('auth.Please_confirm_your_password_before_continuing') }}</div>
    </div>
    <form class="form" method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="input-group mb-10">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror"
                type="password" placeholder="{{ __('auth.Password') }}" name="password" required
                autocomplete="current-password" autofocus>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button type="submit"
                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('auth.Confirm Password') }}</button>

            @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}"
                class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">@lang('auth.Forgot Your Password?')</a>
            @endif
        </div>
    </form>
</div>
<!--end::Login forgot password form-->
@endsection