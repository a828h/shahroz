@extends('layouts.app')
@php
    $instagramCampaigns = [
           'campaign_cnt' => $campaignCnt,
            'instagram_cnt' => $campaignCntInstagram,
            'telegram_cnt' => $campaignCntTelegram,
                ];
@endphp

@section('content')
    <!--begin::Form-->
    {{--    <form class="form">--}}
    {!! Form::model($data ?? '', ['class' => 'form', 'method' => 'get', 'id'=> 'search_form']) !!}
    <div class="card-body">
        <div class="form-group row">
            <div class="col-md-3">
                <div class="m-form__group m-form__group--inline">
                    <div class="m-form__label">
                        <label>@lang('admin.global.report'):</label>
                    </div>
                    <div class="m-form__control">
                        {!! Form::select(
                        'days',
                        [
                            "7" => "هفته گذشته",
                            "30" => "یک ماه گذشته",
                            "90" => "سه ماه گذشته",
                            "180" => "شش ماه گذشته",
                            "365" => "یکسال گذشته",
                        ],
                        $days,
                        ['class' => "form-control m-bootstrap-select", 'id' => "date",
                         "data-actions-box"=>"true"]
                        ) !!}
                    </div>
                </div>
                <div class="d-md-none m--margin-bottom-10"></div>
            </div>
            <div class="col-md-6" style="display: flex; justify-content: flex-end; align-items: flex-end">
                <button class="btn btn-primary align-self-auto" id="search_btn">
                        <span>
                            <i class="la la-search"></i>
                            <span>@lang('admin.global.report')</span>
                        </span>
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <!--end::Form-->
    <div class="row">
        <div class="col-xl-8 col-md-6 col-sm-12">

            <div class="card card-custom bg-gray-100 gutter-b card-stretch">
                <!--begin::Header-->
                <div class="card-header border-0 bg-primary py-5">
                    <h3 class="card-title font-weight-bolder text-white">@lang('client.dashboard.campaigns')</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0 position-relative overflow-hidden">
                    <!--begin::Chart-->
                    <div id="kt_mixed_widget_4_chart" class="card-rounded-bottom bg-primary py-5"
                         style="height: 200px; background-color: #FFF4DE; background-repeat: no-repeat; background-position: center; background-size: auto 150%; background-image: url('{{asset('assets/media/svg/icons/General/Shield-check.svg')}}')"></div>
                    <!--end::Chart-->
                    <!--begin::Stats-->
                    <div class="card-spacer mt-n15">
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Box2.svg-->
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                                                fill="#000000"/>
                                            <path
                                                d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                                                fill="#000000" opacity="0.3"/>
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
                                <span class="d-block my-2">
                                    <i class="fa-2x fa-instagram fab text-primary"></i>
                            </span>
                                <a href="#"
                                   class="text-success font-weight-bold font-size-h6">@lang('client.dashboard.campaign_cnt')
                                    :
                                    {{number_format($instagramCampaigns['instagram_cnt'])}}</a>
                            </div>
                            <div class="w-100 d-md-none"></div>
                            <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="d-block my-2">
                                    <i class="fa-2x fa-telegram-plane fab text-danger"></i>
                                </span>

                                <a href="#" class="text-danger font-weight-bold font-size-h6">@lang('client.dashboard.campaign_cnt')
                                    :
                                    {{number_format($instagramCampaigns['telegram_cnt'])}}</a>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12">

            <div class="card card-custom bg-gray-100 gutter-b card-stretch">
                <!--begin::Header-->
                <div class="card-header border-0 bg-danger py-5">
                    <h3 class="card-title font-weight-bolder text-white">@lang('admin.publishers.report')</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0 position-relative overflow-hidden">
                    <!--begin::Chart-->
                    <div id="kt_mixed_widget_4_chart" class="card-rounded-bottom bg-danger py-5"
                         style="height: 200px; background-color: #FFF4DE; background-repeat: no-repeat; background-position: center; background-size: auto 150%; background-image: url('{{asset('assets/media/svg/icons/Media/Airplay-video.svg')}}')"></div>
                    <!--end::Chart-->
                    <!--begin::Stats-->
                    <div class="card-spacer mt-n15">
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Group.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                            </span>
                                <a href="#"
                                   class="text-info font-weight-bold font-size-h6">@lang('admin.stat.allPublisher')
                                    : {{number_format($campaignAllPublisherCnt)}}</a>
                            </div>
                            <div class="w-100 d-md-none"></div>
                            <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                            </span>
                                <a href="#"
                                   class="text-danger font-weight-bold font-size-h6">@lang('admin.stat.allPublisherUnique')
                                    : {{number_format($campaignAllPublisherUniqueCnt)}}</a>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12">

            <div class="card card-custom bg-gray-100 gutter-b card-stretch">
                <!--begin::Header-->
                <div class="card-header border-0 bg-warning py-5">
                    <h3 class="card-title font-weight-bolder text-white">@lang('admin.stat.money')</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0 position-relative overflow-hidden">
                    <!--begin::Chart-->
                    <div id="kt_mixed_widget_4_chart" class="card-rounded-bottom bg-warning py-5"
                         style="height: 200px; background-color: #FFF4DE; background-repeat: no-repeat; background-position: center; background-size: auto 150%; background-image: url('{{asset('assets/media/svg/icons/Shopping/Money.svg')}}')"></div>
                    <!--end::Chart-->
                    <!--begin::Stats-->
                    <div class="card-spacer mt-n15">
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Incoming-box.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z" fill="#000000"/>
        <path d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z" fill="#000000" opacity="0.3"/>
        <path d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.959697, 3.661508) rotate(-270.000000) translate(-11.959697, -3.661508) "/>
    </g>
</svg><!--end::Svg Icon--></span>
                                <!--end::Svg Icon-->
                            </span>
                                <a href="#"
                                   class="text-info font-weight-bold font-size-h6">@lang('admin.stat.customerCost')
                                    : {{number_format($customerCost)}}</a>
                            </div>
                            <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Outgoing-box.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z" fill="#000000"/>
        <path d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z" fill="#000000" opacity="0.3"/>
        <path d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.959697, 3.661508) rotate(-90.000000) translate(-11.959697, -3.661508) "/>
    </g>
</svg><!--end::Svg Icon--></span>                            </span>
                                <a href="#"
                                   class="text-success font-weight-bold font-size-h6">@lang('admin.stat.ourCost')
                                    :
                                    {{number_format($ourCost)}}</a>
                            </div>
                            <div class="w-100 d-md-none"></div>
                            <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                                <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
        <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>                                </span>

                                <a href="#" class="text-danger font-weight-bold font-size-h6">@lang('admin.stat.income')
                                    :
                                    {{number_format($customerCost-$ourCost)}}</a>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <div class="row">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">@lang('admin.stat.campaigns.instagram')
                                {{--                                <span class="d-block text-muted pt-2 font-size-sm">Scrollable Horizontal &amp; Vertical DataTable</span>--}}
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable" id="">
                            <thead>
                            <tr>
                                <th class="pl-0" style="min-width: 100px">@lang('client.campaigns.name')</th>
                                <th style="min-width: 120px">@lang('client.campaigns.platform')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.impersion_cnt')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.reach_cnt')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.clicks_cnt')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.customer_cost')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.our_cost')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.income')</th>
                                <th style="min-width: 150px">@lang('client.campaigns.start_at')</th>
                                <th style="min-width: 150px">@lang('client.campaigns.end_at')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($campaignsInstagram))
                                @foreach ($campaignsInstagram as $campaign)
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
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->customer_cost, 0)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->our_cost, 0)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->customer_cost - $campaign->our_cost, 0)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-50 font-weight-bolder d-block font-size-lg">{{$campaign->start_at_fa}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-50 font-weight-bolder d-block font-size-lg">{{$campaign->end_at_fa}}</span>
                                        </td>
                                    </tr>

                                @endforeach
                            @endif

                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <div class="row">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">@lang('admin.stat.campaigns.telegram')
                                {{--                                <span class="d-block text-muted pt-2 font-size-sm">Scrollable Horizontal &amp; Vertical DataTable</span>--}}
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable" id="">
                            <thead>
                            <tr>
                                <th class="pl-0" style="min-width: 100px">@lang('client.campaigns.name')</th>
                                <th style="min-width: 120px">@lang('client.campaigns.platform')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.impersion_cnt')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.reach_cnt')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.clicks_cnt')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.customer_cost')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.our_cost')</th>
                                <th style="min-width: 100px">@lang('client.campaigns.income')</th>
                                <th style="min-width: 150px">@lang('client.campaigns.start_at')</th>
                                <th style="min-width: 150px">@lang('client.campaigns.end_at')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($campaignsTelegram))
                                @foreach ($campaignsTelegram as $campaign)
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
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->customer_cost, 0)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->our_cost, 0)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->customer_cost - $campaign->our_cost, 0)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-50 font-weight-bolder d-block font-size-lg">{{$campaign->start_at_fa}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-50 font-weight-bolder d-block font-size-lg">{{$campaign->end_at_fa}}</span>
                                        </td>
                                    </tr>

                                @endforeach
                            @endif

                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <div class="row">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">ناشرها
                                {{--                                <span class="d-block text-muted pt-2 font-size-sm">Scrollable Horizontal &amp; Vertical DataTable</span>--}}
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable" id="">
                            <thead>
                            <tr>
{{--                                <th class="pl-0" style="min-width: 100px">@lang('client.campaigns.name')</th>--}}
                                <th style="min-width: 120px">نام ناشر</th>
                                <th style="min-width: 100px">تعداد کمپین</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.impersion_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.reach_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.clicks_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.like_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.share_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.save_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.sticker_tap_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.comment_cnt')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(is_countable($publisherStat) && count($publisherStat)>0)
                                @foreach ($publisherStat as $publisher_id => $publisher)
                                   <tr>
                                        <td class="pl-0">
                                            <a href="{{ route( 'admin.publishers.edit', $publisher_id ) }}"
                                               class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$publisherData[$publisher_id]->name}}</a>
                                        </td>
                                       <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($publisher["campaign_cnt"], 0)}}</span>
                                       </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($publisher["impression_cnt"], 3)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($publisher["reach_cnt"], 3)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($publisher["click_cnt"], 3)}}</span>
                                       </td>
                                       <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($publisher["like_cnt"], 3)}}</span>
                                       </td>
                                       <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($publisher["share_cnt"], 3)}}</span>
                                       </td>
                                       <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($publisher["save_cnt"], 3)}}</span>
                                       </td>
                                       <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($publisher["sticker_tap_cnt"], 3)}}</span>
                                       </td>
                                       <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($publisher["comment_cnt"], 3)}}</span>
                                       </td>

                                    </tr>

                                @endforeach
                            @endif

                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <div class="row">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">هانتر ها
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable" id="">
                            <thead>
                            <tr>
                                <th class="pl-0" style="min-width: 100px">نام هانتر</th>
                                <th class="pl-0" style="min-width: 100px">تعداد کمپین</th>
                                <th class="pl-0" style="min-width: 100px">مقدار فروش</th>
                                <th class="pl-0" style="min-width: 100px">مقدار سود</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(is_countable($hunterData) && count($hunterData))
                                @foreach ($hunterData as $hunter_id => $hunter)
                                    <tr>
                                        <td class="pl-0">
                                            <a href="{{ route( 'admin.users.edit', $hunter_id ) }}"
                                               class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$hunter["hunter_data"]->first_name}} {{$hunter["hunter_data"]->last_name}}</a>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($hunter["campaign_cnt"], 0)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($hunter["customer_cost"], 0)}}</span>
                                        </td>
                                        <td>
                            <span
                                class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($hunter["income"], 0)}}</span>
                                        </td>

                                    </tr>

                                @endforeach
                            @endif

                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>



@endsection

@section("styles")
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset("assets/plugins/custom/datatables/datatables.bundle.rtl.css")}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
@endsection

@section("scripts")
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset("assets/js/pages/crud/datatables/basic/scrollable.js")}}"></script>
    <!--end::Page Scripts-->

    <script>
        $(document).ready(function() {
            $('.table').DataTable( {
                "scrollY": 500,
                "scrollX": true
            } );
        } );
    </script>

@endsection

