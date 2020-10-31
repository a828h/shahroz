@extends('layouts.app')

@section('content')
@if(isset($isDemo) && $isDemo)
@include('client.pages.demo')
@endif
<!--Begin::Row-->
<div class="row" id="printJS-form">
    <div class="col-xl-4">
        <!--begin::Stats Widget 25-->
        <div class="card card-custom bg-light-success card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-2x svg-icon-success">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/General/Visible.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
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
                <span
                    class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{number_format($campaign->impersion_cnt)}}</span>
                <span class="font-weight-bold text-dark-50 font-size-sm">@lang('client.campaigns.imperssion_cnt')</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 25-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 29-->
        <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
            style="background-position: right top; background-size: 30% auto; background-image: url({{asset('assets/media/svg/shapes/abstract-1.svg')}})">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-info svg-icon-2x">
                    <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Wallet2.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <rect fill="#000000" opacity="0.3" x="2" y="2" width="10" height="12" rx="2" />
                            <path
                                d="M4,6 L20,6 C21.1045695,6 22,6.8954305 22,8 L22,20 C22,21.1045695 21.1045695,22 20,22 L4,22 C2.8954305,22 2,21.1045695 2,20 L2,8 C2,6.8954305 2.8954305,6 4,6 Z M18,16 C19.1045695,16 20,15.1045695 20,14 C20,12.8954305 19.1045695,12 18,12 C16.8954305,12 16,12.8954305 16,14 C16,15.1045695 16.8954305,16 18,16 Z"
                                fill="#000000" />
                        </g>
                    </svg>
                    <!--end::Svg Icon--></span>
                <span
                    class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{number_format($budgetData['cost'])}}</span>
                <span class="font-weight-bold text-dark-50 font-size-sm">@lang('client.campaigns.cost')</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 29-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bg-info card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-white svg-icon-2x">
                    <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Calculator.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <rect fill="#000000" opacity="0.3" x="7" y="4" width="10" height="4" />
                            <path
                                d="M7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,20 C19,21.1045695 18.1045695,22 17,22 L7,22 C5.8954305,22 5,21.1045695 5,20 L5,4 C5,2.8954305 5.8954305,2 7,2 Z M8,12 C8.55228475,12 9,11.5522847 9,11 C9,10.4477153 8.55228475,10 8,10 C7.44771525,10 7,10.4477153 7,11 C7,11.5522847 7.44771525,12 8,12 Z M8,16 C8.55228475,16 9,15.5522847 9,15 C9,14.4477153 8.55228475,14 8,14 C7.44771525,14 7,14.4477153 7,15 C7,15.5522847 7.44771525,16 8,16 Z M12,12 C12.5522847,12 13,11.5522847 13,11 C13,10.4477153 12.5522847,10 12,10 C11.4477153,10 11,10.4477153 11,11 C11,11.5522847 11.4477153,12 12,12 Z M12,16 C12.5522847,16 13,15.5522847 13,15 C13,14.4477153 12.5522847,14 12,14 C11.4477153,14 11,14.4477153 11,15 C11,15.5522847 11.4477153,16 12,16 Z M16,12 C16.5522847,12 17,11.5522847 17,11 C17,10.4477153 16.5522847,10 16,10 C15.4477153,10 15,10.4477153 15,11 C15,11.5522847 15.4477153,12 16,12 Z M16,16 C16.5522847,16 17,15.5522847 17,15 C17,14.4477153 16.5522847,14 16,14 C15.4477153,14 15,14.4477153 15,15 C15,15.5522847 15.4477153,16 16,16 Z M16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 C15.4477153,18 15,18.4477153 15,19 C15,19.5522847 15.4477153,20 16,20 Z M8,18 C7.44771525,18 7,18.4477153 7,19 C7,19.5522847 7.44771525,20 8,20 L12,20 C12.5522847,20 13,19.5522847 13,19 C13,18.4477153 12.5522847,18 12,18 L8,18 Z M7,4 L7,8 L17,8 L17,4 L7,4 Z"
                                fill="#000000" />
                        </g>
                    </svg>
                    <!--end::Svg Icon--></span>
                <span
                    class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{number_format($budgetData['costPerImp'], 3)}}</span>
                <span class="font-weight-bold text-white font-size-sm">@lang('client.campaigns.costPerImp')</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 30-->
    </div>
</div>
<!--End::Row-->
<div class="card card-custom gutter-b">
    <div class="card-body pt-10 pb-5">
        <div id="main" style="width: 100%; height: 400px;"></div>
    </div>
</div>
@if($campaign->resource_type === 'all' || $campaign->resource_type === 'campaign')
<div class="card card-custom gutter-b bg-diagonal bg-diagonal-light-primary">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between p-4">
            <div class="d-flex flex-column mr-5">
                <a href="#" class="h4 text-dark text-hover-primary mb-5">
                    @lang('client.campaigns.showCampaignResource')
                </a>
                <p class="text-dark-50">
                    @lang('client.campaigns.showCampaignResourceText')
                </p>
            </div>
            <div class="ml-6 flex-shrink-0">
                <button href="#" target="_blank"
                    class="btn font-weight-bolder text-uppercase btn-primary py-4 px-6 dynamic"
                    data-id="{{$campaign->id}}" data-type="campaign">
                    @lang('client.campaigns.view')
                </button>
            </div>
        </div>
    </div>
</div>
@endif
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-6">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">@lang('client.campaigns.publisherReport')</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">@lang('client.campaigns.publisherReportDesc',
                ['publisherCount' => ($campaign->contentPublishers()->count())])</span>
        </h3>
        <div class="card-toolbar">
            <button id="generate_pdf"
                class="btn btn-info font-weight-bolder font-size-sm mr-3">@lang('client.campaigns.print')</button>
            <a class="btn btn-warning font-weight-bolder font-size-sm mr-3" id="downloadLink"
                href="{{route('campaigns.downloadExcel',[$campaign->id])}}">@lang('client.campaigns.exportExcel')</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-0 pb-3">
        <div class="tab-content">
            <!--begin::Table-->
            <div class="table-responsive">
                <table id="myTable" class="table table-head-custom table-head-bg table-bordered table-vertical-center">
                    <thead>
                        <tr class="text-left text-uppercase">
                            <th style="min-width: 250px" class="pl-7">
                                <span class="text-dark-75">@lang('client.campaignPublisher.publishers')</span>
                            </th>
                            <th style="min-width: 100px">@lang('client.campaignPublisher.impersion_cnt')</th>
                            <th style="min-width: 80px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $chartSource = [];
                        $pdfData = [];
                        $publishers = [];
                        @endphp
                        @if(count($campaign->contents))
                        @foreach ($campaign->contents as $contentIndex => $content)
                        @php
                        $chartData['impersions'][] = $content->impersion_cnt;
                        @endphp
                        @foreach($content->contentRows AS $contentRowsIndex => $row)
                        <tr style="border-top: {{ $contentRowsIndex === 0 ? '1px solid #ccc' : '' }}">
                            @if($contentRowsIndex === 0)
                            <td rowspan="{{count($content->contentRows)}}" style="padding: 0;">
                                <div style="display: flex; justify-content: flex-start; flex-wrap: wrap; margin: 0;">
                                    @if(count($content->contentPublishers) === 1)
                                    @php
                                    if(!isset($publishers[$contentIndex])) {
                                    $publishers[$contentIndex] = [];
                                    }
                                    $publishers[$contentIndex][] = $contentPublisher->publisher->name
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50 symbol-light mr-4">
                                            <span class="symbol-label">
                                                <img src="{{!empty($content->contentPublishers[0]->image_url) ? $content->contentPublishers[0]->image_url : asset('assets/media/svg/avatars/001-boy.svg')}}"
                                                    class="h-75 align-self-end"
                                                    alt="{{$content->contentPublishers[0]->name}}" />
                                            </span>
                                        </div>
                                        <div>
                                            <a href="#"
                                                class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$content->contentPublishers[0]->publisher->name}}</a>
                                            <span
                                                class="text-muted font-weight-bold d-block">{{$content->contentPublishers[0]->publisher->link}}</span>
                                        </div>
                                    </div>
                                    @else
                                    @foreach ($content->contentPublishers as $contentPublisher)
                                    @php
                                    if(!isset($publishers[$contentIndex])) {
                                    $publishers[$contentIndex] = [];
                                    }
                                    $publishers[$contentIndex][] = $contentPublisher->publisher->name
                                    @endphp
                                    <div class="d-flex align-items-center"
                                        style="border: 1px solid #ccc; margin: 3px; padding: 3px 10px; border-radius: 5px; background-color: #efefef;">
                                        <div class="symbol symbol-50 symbol-light mr-4">
                                            <span class="symbol-label" style="height: 25px; width: 25px;">
                                                <img src="{{!empty($contentPublisher->publisher->image_url) ? $contentPublisher->publisher->image_url : asset('assets/media/svg/avatars/001-boy.svg')}}"
                                                    class="h-75 align-self-end"
                                                    alt="{{$contentPublisher->publisher->name}}" />
                                            </span>
                                        </div>
                                        <div>
                                            <a href="{{$contentPublisher->publisher->link}}"
                                                class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-md">{{$contentPublisher->publisher->name}}</a>
                                        </div>
                                    </div>

                                    @endforeach
                                    @endif
                                </div>
                            </td>
                            @endif
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($row->impersion_cnt)}}</span>
                            </td>

                            @if($content->content_type === 'normal' || $content->content_type === 'type1')
                            <td class="pr-0 text-right" rowspan="1">
                                <div class="btn-group" role="group" aria-label="First group">
                                    @if($campaign->resource_type === 'all' || $campaign->resource_type === 'content')
                                    <button type="button" class="btn btn-warning btn-icon dynamic"
                                        data-id="{{$row->id}}" data-type="contentRow_resource"><i
                                            class="fas fa-upload"></i></button>
                                    @endif
                                    <button type="button" class="btn btn-success btn-icon dynamic"
                                        data-id="{{$row->id}}" data-type="contentRow_media"><i
                                            class="fas fa-photo-video"></i></button>
                                </div>
                            </td>
                            @elseif($content->content_type === 'type2' && $contentRowsIndex === 0 )
                            <td class="pr-0 text-right" rowspan="{{count($content->contentRows)}}">
                                <div class="btn-group" role="group" aria-label="First group">
                                    @if($campaign->resource_type === 'all' || $campaign->resource_type === 'content')
                                    <button type="button" class="btn btn-warning btn-icon dynamic"
                                        data-id="{{$row->id}}" data-type="contentRow_resource"><i
                                            class="fas fa-upload"></i></button>
                                    @endif
                                    <button type="button" class="btn btn-success btn-icon dynamic"
                                        data-id="{{$row->id}}" data-type="contentRow_media"><i
                                            class="fas fa-photo-video"></i></button>
                                </div>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
    <!--end::Body-->
</div>
@endsection
@php
foreach($publishers AS $pubIndex => $publisher) {
$publishers[$pubIndex] = implode(',', $publisher);
}
@endphp
@section('styles')
<link type="text/css" rel="stylesheet"
    href="{{asset('assets/plugins/custom/lightGallery/dist/css/lightgallery.css')}}" />
<link type="text/css" rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css" />
<style>
    .lg-outer {
        direction: ltr
    }
</style>
@endsection

@section('scripts')
@parent
<script src="{{asset('assets/plugins/custom/lightGallery/dist/js/lightgallery-all.js')}}"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>


<script type="text/javascript">
    $('.dynamic').on('click', function() {
        var type = $(this).attr('data-type');
        var id = $(this).attr('data-id');
        var url = "{{ route('dropzone.fetch',['__type__', '__id__']) }}";
        url = url.replace('__type__', type).replace('__id__', id)
        $.ajax({
            url: url,
            type: 'GEt',
            header: { _token: '{{ csrf_token() }}' },
            success:function(response){
                console.log(response);
                $(this).lightGallery({
                    share: false,
                    thumbnail: false,
                    dynamic: true,
                    videojs: true,
                    dynamicEl: response
                })
            },
            error: function (){alert('error');},
        });


    });
    $('#exampleModalCenter').modal('hide');

    $('#generate_pdf').on('click',function(e) {
        var printContents = document.getElementById('kt_content').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    });

    var data = @json($chartSource);
    var legends = {
        imperssion: "{{__('client.campaignPublisher.imperssion')}}",
    };

    const primary = '#6993FF';
    const success = '#1BC5BD';
    const info = '#8950FC';
    const warning = '#FFA800';
    const danger = '#F64E60';

    const apexChart = "#main";
		var options = {
			series: [{
				name: 'impersions',
				data: @json($chartData['impersions'])
            }
            ],
			chart: {
				type: 'bar',
				height: 350
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '55%',
					endingShape: 'rounded'
				},
			},
			dataLabels: {
				enabled: true
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
                categories: @json($publishers),
                labels: {
                    show: false
                },
			},
			yaxis: {
				title: {
					text: ''
				}
			},
			fill: {
				opacity: 1
			},
			tooltip: {
				y: {
					formatter: function (val) {
						return "$ " + val + " thousands"
					}
				}
			},
			colors: [primary, success, warning]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
</script>
{{--  @include('client.campaignPublisher.js.index_js')  --}}
@endsection
