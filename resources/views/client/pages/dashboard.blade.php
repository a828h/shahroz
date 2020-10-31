@extends('layouts.app')

@section('content')
@if(isset($isDemo) && $isDemo)
    @include('client.pages.demo')
@endif
<style>
    .apexcharts-tooltip {
        max-width: 200px;
        right: auto;
    }
</style>
<div class="row">
    <div class="col-xl-8">
        <!--begin::Mixed Widget 1-->
        <div class="card card-custom bg-gray-100 gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 bg-danger py-5">
                <h3 class="card-title font-weight-bolder text-white">@lang('client.dashboard.instagram_campaigns')</h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0 position-relative overflow-hidden">
                <!--begin::Chart-->
                <div id="kt_mixed_widget_4_chart" class="card-rounded-bottom bg-danger" style="height: 200px; background-color: #FFF4DE; background-repeat: no-repeat; background-position: center; background-size: auto 150%; background-image: url('{{asset('assets/media/svg/logos/instagram-2016.svg')}}')"></div>
                <!--end::Chart-->
                <!--begin::Stats-->
                <div class="card-spacer mt-n15">
                    <!--begin::Row-->
                    <div class="row m-0">
                        <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Box2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                                                fill="#000000" />
                                            <path
                                                d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                                                fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                            </span>
                            <a href="#"
                                class="text-info font-weight-bold font-size-h6">@lang('client.dashboard.campaign_cnt')
                                : {{number_format($instagramCampaigns['campaign_cnt'])}}</a>
                        </div>
                        <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/General/Visible.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                            </span>
                            <a href="#"
                                class="text-success font-weight-bold font-size-h6">@lang('client.dashboard.imp_cnt') :
                                {{number_format($instagramCampaigns['imp_cnt'])}}</a>
                        </div>
                        <div class="w-100 d-md-none"></div>
                        <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/General/Attachment1.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z"
                                            fill="#000000" opacity="0.3"
                                            transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) " />
                                        <path
                                            d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z"
                                            fill="#000000"
                                            transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) " />
                                    </g>
                                </svg>
                                <!--end::Svg Icon--></span>
                            <a href="#"
                                class="text-danger font-weight-bold font-size-h6">@lang('client.dashboard.reach_cnt') :
                                {{number_format($instagramCampaigns['reach_cnt'])}}</a>
                        </div>
                        <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/General/Cursor.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M14.2330207,14.3666907 L16.3111786,18.8233147 C16.4278814,19.0735846 16.3196038,19.3710749 16.0693338,19.4877777 L14.2567182,20.3330142 C14.0064483,20.449717 13.708958,20.3414394 13.5922552,20.0911694 L11.4668267,15.5331733 L8.85355339,18.1464466 C8.7597852,18.2402148 8.63260824,18.2928932 8.5,18.2928932 C8.22385763,18.2928932 8,18.0690356 8,17.7928932 L8,5.13027585 C8,5.00589283 8.04636089,4.88597544 8.13002996,4.79393946 C8.31578343,4.58961065 8.63200759,4.57455235 8.8363364,4.76030582 L18.1424309,13.2203917 C18.2368163,13.3061967 18.2948385,13.424831 18.3046218,13.5520135 C18.3258009,13.8273425 18.1197718,14.0677099 17.8444428,14.088889 L14.2330207,14.3666907 Z"
                                            fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon--></span>
                            <a href="#"
                                class="text-warning font-weight-bold font-size-h6 mt-2">@lang('client.dashboard.clicks_cnt')
                                : {{number_format($instagramCampaigns['clicks_cnt'])}}</a>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row m-0">
                        <div class="col bg-white px-6 py-8 rounded-xl mr-7">
                            <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Like.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M9,10 L9,19 L10.1525987,19.3841996 C11.3761964,19.7920655 12.6575468,20 13.9473319,20 L17.5405883,20 C18.9706314,20 20.2018758,18.990621 20.4823303,17.5883484 L21.231529,13.8423552 C21.5564648,12.217676 20.5028146,10.6372006 18.8781353,10.3122648 C18.6189212,10.260422 18.353992,10.2430672 18.0902299,10.2606513 L14.5,10.5 L14.8641964,6.49383981 C14.9326895,5.74041495 14.3774427,5.07411874 13.6240179,5.00562558 C13.5827848,5.00187712 13.5414031,5 13.5,5 L13.5,5 C12.5694044,5 11.7070439,5.48826024 11.2282564,6.28623939 L9,10 Z"
                                            fill="#000000" />
                                        <rect fill="#000000" opacity="0.3" x="2" y="9" width="5" height="11" rx="1" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon--></span>
                            <a href="#"
                                class="text-danger font-weight-bold font-size-h6 mt-2">@lang('client.dashboard.like_cnt')
                                : {{number_format($instagramCampaigns['like_cnt'])}}</a>
                        </div>
                        <div class="col bg-white px-6 py-8 rounded-xl mr-7">
                            <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Interselect.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z M17,16 L17,10 C17,8.34314575 15.6568542,7 14,7 L8,7 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L17,16 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M9.27272727,9 L13.7272727,9 C14.5522847,9 15,9.44771525 15,10.2727273 L15,14.7272727 C15,15.5522847 14.5522847,16 13.7272727,16 L9.27272727,16 C8.44771525,16 8,15.5522847 8,14.7272727 L8,10.2727273 C8,9.44771525 8.44771525,9 9.27272727,9 Z"
                                            fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon--></span>
                            <a href="#"
                                class="text-warning font-weight-bold font-size-h6 mt-2">@lang('client.dashboard.tap_cnt')
                                : {{number_format($instagramCampaigns['tap_cnt'])}}</a>
                        </div>
                        <div class="w-100 d-md-none"></div>
                        <div class="col bg-white px-6 py-8 rounded-xl mr-7">
                            <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Media/Airplay-video.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M7,15 C7.55228475,15 8,15.4477153 8,16 C8,16.5522847 7.55228475,17 7,17 L6,17 C4.34314575,17 3,15.6568542 3,14 L3,7 C3,5.34314575 4.34314575,4 6,4 L18,4 C19.6568542,4 21,5.34314575 21,7 L21,14 C21,15.6568542 19.6568542,17 18,17 L17,17 C16.4477153,17 16,16.5522847 16,16 C16,15.4477153 16.4477153,15 17,15 L18,15 C18.5522847,15 19,14.5522847 19,14 L19,7 C19,6.44771525 18.5522847,6 18,6 L6,6 C5.44771525,6 5,6.44771525 5,7 L5,14 C5,14.5522847 5.44771525,15 6,15 L7,15 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                        <polygon fill="#000000" opacity="0.3" points="8 20 16 20 12 15" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon--></span>
                            <a href="#"
                                class="text-info font-weight-bold font-size-h6 mt-2">@lang('client.dashboard.publisher_cnt')
                                : {{number_format($instagramCampaigns['publisher_cnt'])}}</a>
                        </div>

                        <div class="col bg-white px-6 py-8 rounded-xl mr-7">
                            <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z"
                                            fill="#000000" opacity="0.3"
                                            transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) " />
                                        <path
                                            d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z"
                                            fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon--></span>
                            <a href="#"
                                class="text-success font-weight-bold font-size-h6 mt-2">@lang('client.dashboard.cost') :
                                {{number_format($instagramCampaigns['cost'])}}</a>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 1-->
    </div>
    <div class="col-xl-4">
        <!--begin::Mixed Widget 2-->
        <div class="card card-custom bg-gray-100 gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 bg-primary py-5">
                <h3 class="card-title font-weight-bolder text-white">@lang('client.dashboard.telegram_campaigns')</h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0 position-relative overflow-hidden">
                <!--begin::Chart-->
                <div id="kt_mixed_widget_5_chart" class="card-rounded-bottom bg-primary" style="height: 200px; background-color: #FFF4DE; background-repeat: no-repeat; background-position: center; background-size: auto 150%; background-image: url('{{asset('assets/media/svg/misc/015-telegram.svg')}}')"></div>
                <!--end::Chart-->
                <!--begin::Stats-->
                <div class="card-spacer mt-n15">
                    <!--begin::Row-->
                    <div class="row m-0">
                        <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Box2.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                                            fill="#000000" />
                                        <path
                                            d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <a href="#"
                                class="text-info font-weight-bold font-size-h6">@lang('client.dashboard.campaign_cnt')
                                : {{number_format($telegramCampaigns['campaign_cnt'])}}</a>
                        </div>
                        <div class="col bg-white px-6 py-8 rounded-xl mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/General/Visible.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <a href="#"
                                class="text-success font-weight-bold font-size-h6 mt-2">@lang('client.dashboard.imp_cnt')
                                : {{number_format($telegramCampaigns['imp_cnt'])}}</a>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row m-0">
                        <div class="col bg-white px-6 py-8 rounded-xl mr-7">
                            <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Media/Airplay-video.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M7,15 C7.55228475,15 8,15.4477153 8,16 C8,16.5522847 7.55228475,17 7,17 L6,17 C4.34314575,17 3,15.6568542 3,14 L3,7 C3,5.34314575 4.34314575,4 6,4 L18,4 C19.6568542,4 21,5.34314575 21,7 L21,14 C21,15.6568542 19.6568542,17 18,17 L17,17 C16.4477153,17 16,16.5522847 16,16 C16,15.4477153 16.4477153,15 17,15 L18,15 C18.5522847,15 19,14.5522847 19,14 L19,7 C19,6.44771525 18.5522847,6 18,6 L6,6 C5.44771525,6 5,6.44771525 5,7 L5,14 C5,14.5522847 5.44771525,15 6,15 L7,15 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                        <polygon fill="#000000" opacity="0.3" points="8 20 16 20 12 15" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <a href="#"
                                class="text-danger font-weight-bold font-size-h6 mt-2">@lang('client.dashboard.publisher_cnt')
                                : {{number_format($telegramCampaigns['publisher_cnt'])}}</a>
                        </div>
                        <div class="col bg-white px-6 py-8 rounded-xl">

                            <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z"
                                                fill="#000000" opacity="0.3"
                                                transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) " />
                                            <path
                                                d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                            </span>
                            <a href="#"
                                class="text-warning font-weight-bold font-size-h6 mt-2">@lang('client.dashboard.cost') :
                                {{number_format($telegramCampaigns['cost'])}}</a>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 2-->
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">@lang('client.dashboard.recent')</span>
        </h3>
        <div class="card-toolbar">
            <a href="{{route('campaigns.index')}}" class="btn btn-success font-weight-bolder font-size-sm">
                <span class="svg-icon svg-icon-md svg-icon-white">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path
                                d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                            <path
                                d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero"></path>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>@lang('client.dashboard.show_all')</a>
        </div>
    </div>
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">
                        <th class="pl-0" style="min-width: 100px">@lang('client.campaigns.name')</th>
                        <th style="min-width: 120px">@lang('client.campaigns.platform')</th>

                        <th style="min-width: 100px">@lang('client.campaigns.impersion_cnt')</th>
                        <th style="min-width: 100px">@lang('client.campaigns.reach_cnt')</th>
                        <th style="min-width: 100px">@lang('client.campaigns.clicks_cnt')</th>
                        <th style="min-width: 150px">@lang('client.campaigns.start_at')</th>
                        <th style="min-width: 150px">@lang('client.campaigns.end_at')</th>
                        <th class="pr-0 text-right" style="min-width: 160px">@lang('admin.global.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($campaigns))
                    @foreach ($campaigns as $campaign)
                    <tr>
                        <td class="pl-0">
                            <a href="{{ route( 'campaigns.show', $campaign->id ) }}"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$campaign->name}}</a>
                        </td>
                        <td>
                            {!! simpleBadge($campaign->platform,[
                            'telegram' => [ 'state' => 'danger', 'text' => __('client.campaigns.platforms.telegram')
                            ],
                            'instagram_post' => [ 'state' => 'info', 'text' =>
                            __('client.campaigns.platforms.instagram_post') ],
                            'instagram_story' => [ 'state' => 'primary', 'text' =>
                            __('client.campaigns.platforms.instagram_story') ]
                            ]) !!}
                        </td>
                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->impersion_cnt, 0)}}</span>
                        </td>
                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->reach_cnt, 0)}}</span>
                        </td>
                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->clicks_cnt, 0)}}</span>
                        </td>
                        <td>
                            <span
                                class="text-dark-50 font-weight-bolder d-block font-size-lg">{{$campaign->start_at_fa}}</span>
                        </td>
                        <td>
                            <span
                                class="text-dark-50 font-weight-bolder d-block font-size-lg">{{$campaign->end_at_fa}}</span>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="{{ route( 'campaigns.show', $campaign->id ) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-pie.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon--></span>
                                </span>
                            </a>
                        </td>
                    </tr>

                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
</div>
@endsection

@section('scripts')
<script>
    var _initMixedWidget4 = function() {
        var element = document.getElementById("kt_mixed_widget_4_chart");
        var height = parseInt(KTUtil.css(element, 'height'));

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'تعداد بازدید',
                data: @json($instagramStat['imp'])
            }, {
                name: 'تعداد ناشر',
                data: @json($instagramStat['publisher'])
            }],
            chart: {
                type: 'bar',
                height: height,
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['15px'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 1,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($instagramStat['names']),
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                min: 0,
                max: 100,
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            fill: {
                type: ['solid', 'solid'],
                opacity: [0.25, 1]
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                followCursor: true,
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family'],
                },
                y: {
                    formatter: function(val) {
                        return val
                    },
                },
                marker: {
                    show: true
                }
            },
            colors: ['#ffffff', '#ffffff'],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                padding: {
                    left: 20,
                    right: 20
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

    var _initMixedWidget5 = function() {
        var element = document.getElementById("kt_mixed_widget_5_chart");
        var height = parseInt(KTUtil.css(element, 'height'));

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'تعداد بازدید',
                data: @json($instagramStat['imp'])
            }, {
                name: 'تعداد ناشر',
                data: @json($instagramStat['publisher'])
            }],
            chart: {
                type: 'bar',
                height: height,
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30px'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 1,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($instagramStat['names']),
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                min: 0,
                max: 100,
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            fill: {
                type: ['solid', 'solid'],
                opacity: [0.25, 1]
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                followCursor: true,
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family'],
                },
                y: {
                    formatter: function(val) {
                        return val
                    },
                },
                marker: {
                    show: true
                }
            },
            colors: ['#ffffff', '#ffffff'],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                padding: {
                    left: 20,
                    right: 20
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }
    $(document).ready(function() {
        _initMixedWidget4();
        _initMixedWidget5();
    })

</script>
@endsection
