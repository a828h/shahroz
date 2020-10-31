@extends('layouts.app')

@section('subheader')
<!--begin::Info-->
<div class="d-flex align-items-center flex-wrap mr-1">

    <!--begin::Page Heading-->
    <div class="d-flex align-items-baseline mr-5">

        <!--begin::Page Title-->
        <h2 class="subheader-title text-dark font-weight-bold my-2 mr-3">
            @lang('client.campaigns.list')
        </h2>

        <!--end::Page Title-->
    </div>

    <!--end::Page Heading-->
</div>

<!--end::Info-->
@endsection

@section('content')
@if(isset($isDemo) && $isDemo)
    @include('client.pages.demo')
@endif
<div class="card card-custom gutter-t">
    <!--begin::Form-->
    <form class="form">
        {!! Form::model($data, ['class' => 'form', 'id'=> 'search_form']) !!}
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-3">
                    <label>@lang('admin.global.search'):</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-search"></i>
                            </span>
                        </div>
                        {!! Form::text('search', $value = null, ['class' => 'form-control',
                        'placeholder' => __('admin.global.search') . "...", 'id' => "generalSearch"]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="m-form__group m-form__group--inline">
                        <div class="m-form__label">
                            <label class="m-label m-label--single">@lang('client.campaigns.platform'):</label>
                        </div>
                        <div class="m-form__control">
                            {!! Form::select(
                            'platform',
                            [
                            '' => __('client.campaigns.platforms.all'),
                            'telegram' => __('client.campaigns.platforms.telegram'),
                            'instagram_post' => __('client.campaigns.platforms.instagram_post'),
                            'instagram_story' => __('client.campaigns.platforms.instagram_story')],
                            null,
                            ['class' => "form-control m-bootstrap-select", 'id' => "search_platform"]
                            ) !!}
                        </div>
                    </div>
                    <div class="d-md-none m--margin-bottom-10"></div>
                </div>
                <div class="col-md-6" style="display: flex; justify-content: flex-end; align-items: flex-end">
                    <button class="btn btn-primary align-self-auto" id="search_btn">
                        <span>
                            <i class="la la-search"></i>
                            <span>@lang('client.global.search')</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <!--end::Form-->
</div>

<div class="card card-custom gutter-b">
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
                            <span class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->impersion_cnt)}}</span>
                        </td>
                        <td>
                            <span class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->reach_cnt)}}</span>
                        </td>
                        <td>
                            <span class="text-dark-25 font-weight-bolder d-block font-size-lg">{{number_format($campaign->clicks_cnt)}}</span>
                        </td>
                        <td>
                            <span class="text-dark-50 font-weight-bolder d-block font-size-lg">{{$campaign->start_at_fa}}</span>
                        </td>
                        <td>
                            <span class="text-dark-50 font-weight-bolder d-block font-size-lg">{{$campaign->end_at_fa}}</span>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="{{ route( 'campaigns.show', $campaign->id ) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-pie.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
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
    <!--end::Body-->
    <div class="card-footer">
        {!! $campaigns->appends($_GET)->links('components.pagination') !!}
    </div>
</div>
@endsection

@section('scripts')
@include('client.campaigns.js.index_js')
@endsection
