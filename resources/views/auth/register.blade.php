@extends('layouts.auth')

@section('content')
<!--begin::Login Sign up form-->
<div class="login-signup" style="display: block">
    <div class="mb-20">
        <h3>{{ __('auth.Register') }}</h3>
        <div class="text-muted font-weight-bold">{{ __('auth.Enter your details to create your account') }}</div>
    </div>
    <form class="form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('first_name') is-invalid @enderror" type="text"
                placeholder="{{ __('auth.First Name') }}" name="first_name" value="{{ old('first_name') }}" required
                autocomplete="first_name" autofocus>
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('last_name') is-invalid @enderror" type="text"
                placeholder="{{ __('auth.Last Name') }}" name="last_name" value="{{ old('last_name') }}" required
                autocomplete="last_name" autofocus>
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('mobile') is-invalid @enderror" type="text"
                placeholder="{{ __('auth.Mobile') }}" name="mobile" value="{{ old('mobile') }}" required
                autocomplete="mobile">

            @error('mobile')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror" type="email"
                placeholder="{{ __('auth.E-Mail-Address') }}" name="email" value="{{ old('email') }}" required
                autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('brand') is-invalid @enderror" type="text"
                placeholder="{{ __('auth.brand') }}" name="brand" value="{{ old('brand') }}" required
                autocomplete="brand">

            @error('brand')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror" type="password"
                placeholder="{{ __('auth.Password') }}" name="password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <input class="form-control h-auto form-control-solid py-4 px-8" type="password"
                placeholder="{{ __('auth.Confirm Password') }}" name="password_confirmation" required
                autocomplete="new-password">
        </div>
        {{--  <div class="form-group mb-5 text-left">
            <label class="checkbox m-0">
                <input type="checkbox" name="agree" />I Agree the
                <a href="#" class="font-weight-bold">terms and conditions</a>.
                <span></span></label>
            <div class="form-text text-muted text-center"></div>
        </div>  --}}
        <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">
                {{ __('auth.Register') }}
            </button>
            <a href="{{ route('login') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('auth.Cancel') }}</a>
        </div>
    </form>
</div>
<!--end::Login Sign up form-->
@endsection