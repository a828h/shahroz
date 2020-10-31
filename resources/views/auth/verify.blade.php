@extends('layouts.auth')

@section('content')

<div class="login-forgot" style="display: block">
    <div class="mb-20">
        <h3>{{ __('auth.VerifyـYourـEmailـAddress') }}</h3>
        @if(session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('auth.A_fresh_verification_link_has_been_sent_to_your_email_address') }}
        </div>
        @endif
        <div class="text-muted font-weight-bold">{{ __('auth.Beforeـproceedingـpleaseـcheckـyourـemailـforـaـverificationـlink.') }},</div>
        <div class="text-muted font-weight-bold">{{ __('auth.Ifـyouـdidـnotـreceiveـtheـemail') }}</div>
    </div>
    <form class="form" method="POST">
        @csrf
        <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button type="submit"
                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('auth.clickـhereـtoـrequestـanother') }}</button>
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