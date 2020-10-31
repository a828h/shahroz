@extends('layouts.app')

@section('subheader')
<!--begin::Info-->
<div class="d-flex align-items-center flex-wrap mr-1">

    <!--begin::Page Heading-->
    <div class="d-flex align-items-baseline mr-5">

        <!--begin::Page Title-->
        <h2 class="subheader-title text-dark font-weight-bold my-2 mr-3">
            @lang('admin.campaigns.drafts')
        </h2>

        <!--end::Page Title-->
    </div>

    <!--end::Page Heading-->
</div>

<!--end::Info-->

<!--begin::Toolbar-->
<div class="d-flex align-items-center">

    <!--begin::Button-->
    <a href="{{route('admin.drafts.create')}}"
        class="btn btn-fh btn-white btn-hover-primary font-weight-bold px-2 px-lg-5 mr-2">
        <span class="svg-icon svg-icon-success svg-icon-lg">
            <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Files/Upload.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <path
                        d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                    <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1" />
                    <path
                        d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z"
                        fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon--></span>@lang('admin.campaigns.upload')
    </a>

    <!--end::Button-->


</div>

<!--end::Toolbar-->
@endsection

@section('content')
<div class="card card-custom gutter-t">
    <!--begin::Form-->
    <form class="form">
        {!! Form::model($data, ['class' => 'form', 'method' => 'get', 'id'=> 'search_form']) !!}
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
                            <label class="m-label m-label--single">@lang('admin.campaigns.platform'):</label>
                        </div>
                        <div class="m-form__control">
                            {!! Form::select(
                            'platform',
                            [
                            '' => __('admin.campaigns.platforms.all'),
                            'telegram' => __('admin.campaigns.platforms.telegram'),
                            'instagram_post' => __('admin.campaigns.platforms.instagram_post'),
                            'instagram_story' => __('admin.campaigns.platforms.instagram_story')],
                            null,
                            ['class' => "form-control m-bootstrap-select", 'id' => "search_platform"]
                            ) !!}
                        </div>
                    </div>
                    <div class="d-md-none m--margin-bottom-10"></div>
                </div>
                <div class="col-md-3">
                    <div class="m-form__group m-form__group--inline">
                        <div class="m-form__label">
                            <label>@lang('admin.campaigns.categories[]'):</label>
                        </div>
                        <div class="m-form__control">
                            {!! Form::select(
                            'categories[]',
                            $categories,
                            null,
                            ['class' => "form-control m-bootstrap-select", 'id' => "search_category", 'multiple' =>
                            true,
                            'data-live-search'=>"true", "data-actions-box"=>"true"]
                            ) !!}
                        </div>
                    </div>
                    <div class="d-md-none m--margin-bottom-10"></div>
                </div>
                <div class="col-md-3">
                    <div class="m-form__group m-form__group--inline">
                        <div class="m-form__label">
                            <label>@lang('admin.campaigns.brands[]'):</label>
                        </div>
                        <div class="m-form__control">
                            {!! Form::select(
                            'brands[]',
                            $brands,
                            null,
                            ['class' => "form-control m-bootstrap-select", 'id' => "search_brand", 'multiple' => true,
                            'data-live-search'=>"true", "data-actions-box"=>"true"]
                            ) !!}
                        </div>
                    </div>
                    <div class="d-md-none m--margin-bottom-10"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12" style="display: flex; justify-content: flex-end; align-items: flex-end">
                    <button class="btn btn-primary align-self-auto" id="search_btn">
                        <span>
                            <i class="la la-search"></i>
                            <span>@lang('admin.global.search')</span>
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
                        <th class="pl-0" style="min-width: 100px">@lang('admin.campaigns.name')</th>
                        <th style="min-width: 130px">@lang('admin.campaigns.platform')</th>
                        <th style="min-width: 120px">@lang('admin.campaigns.categories[]')</th>
                        <th style="min-width: 120px">@lang('admin.campaigns.brands[]')</th>

                        <th style="min-width: 150px">@lang('admin.campaigns.date')</th>
                        <th class="pr-0 text-right" style="min-width: 160px">@lang('admin.global.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($campaigns))
                    @foreach ($campaigns as $campaign)
                    <tr>
                        <td class="pl-0">
                            <a href="{{route('admin.campaigns.edit', $campaign)}}"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$campaign->name}}</a>
                        </td>
                        <td>{!! simpleBadge($campaign->platform,[
                            'telegram' => [ 'state' => 'danger', 'text' => __('admin.campaigns.platforms.telegram')
                            ],
                            'instagram_post' => [ 'state' => 'info', 'text' =>
                            __('admin.campaigns.platforms.instagram_post') ],
                            'instagram_story' => [ 'state' => 'primary', 'text' =>
                            __('admin.campaigns.platforms.instagram_story') ]
                            ]) !!}
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                {{$campaign->categories->pluck('name')->implode(',')}}
                            </span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                {{$campaign->brands->pluck('name')->implode(',')}}
                            </span>
                        </td>
                        <td>
                            <span class="text-dark-50 font-weight-bold d-block">{{$campaign->start_at_fa}}</span>
                            <span class="text-dark-75 font-weight-bold">{{$campaign->end_at_fa}}</span>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="{{route('admin.campaigns.edit', $campaign)}}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <a href="javascript:;" data-id="{{$campaign->id}}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm delete-campaign">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <path
                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            <form id="delete-campaign-{{$campaign->id}}-form"
                                action="{{ route( 'admin.campaigns.destroy', $campaign->id ) }}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
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
@include('admin.campaigns.js.drafts_js')
@endsection