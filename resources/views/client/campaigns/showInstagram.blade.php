@extends('layouts.app')

@section('content')
@if(isset($isDemo) && $isDemo)
@include('client.pages.demo')
@endif
@include('client.campaigns._show.topBoxes')

@include('client.campaigns._show.midBoxes')
{{--  @include('client.campaigns._show.chart')  --}}
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
                ['publisherCount' => ($campaign->contents()->count())])</span>
        </h3>
        <div class="card-toolbar">
            <button id="generate_pdf"
                class="btn btn-info font-weight-bolder font-size-sm mr-3">@lang('client.campaigns.print')</button>
            <a class="btn btn-warning font-weight-bolder font-size-sm mr-3" id="downloadLink" href="{{route('campaigns.downloadExcel',[$campaign->id])}}">@lang('client.campaigns.exportExcel')</a>

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
                                <span class="text-dark-75">@lang('client.campaignPublisher.name')</span>
                            </th>
                            <th style="min-width: 100px" data-toggle="tooltip" title="Impersion count">@lang('client.campaignPublisher.impersion_cnt')</th>
                            <th style="min-width: 100px" data-toggle="tooltip" title="Reach count">@lang('client.campaignPublisher.reach_cnt')</th>
                            <th style="min-width: 100px" data-toggle="tooltip" title="Click count">@lang('client.campaignPublisher.clicks_cnt')</th>
                            <th style="min-width: 100px" data-toggle="tooltip" title="Like count">@lang('client.campaignPublisher.like_cnt')</th>
                            <th style="min-width: 100px" data-toggle="tooltip" title="Share count">@lang('client.campaignPublisher.share_cnt')</th>
                            <th style="min-width: 100px" data-toggle="tooltip" title="Save count">@lang('client.campaignPublisher.save_cnt')</th>
                            <th style="min-width: 100px" data-toggle="tooltip" title="Sticker tap count">@lang('client.campaignPublisher.sticker_tap_cnt')</th>
                            <th style="min-width: 100px" data-toggle="tooltip" title="Comment count">@lang('client.campaignPublisher.comment_cnt')</th>
                            <th style="min-width: 80px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $chartSource = [];
                        $pdfData = [];
                        $publishers = [];
                        $chartData = [
                            'impersions' => [],
                            'clicks' => []
                        ];
                        @endphp
                        @if(count($campaign->contents))
                        @foreach ($campaign->contents as $contentIndex => $content)
                        @php
                            $chartData['impersions'][] = $content->impersion_cnt;
                            $chartData['clicks'][] = $content->clicks_cnt;
                        @endphp
                        <tr style="border-top:1px solid #ccc" class="main-tr-{{$contentIndex}}">
                            <td rowspan="1" data-count="{{count($content->contentRows) + 1}}" style="padding: 0;">
                                <div style="display: flex; justify-content: flex-start; flex-wrap: wrap; margin: 0;">
                                    @if(count($content->contentPublishers) === 1)
                                    @php
                                        if(!isset($publishers[$contentIndex])) {
                                            $publishers[$contentIndex] = [];
                                        }
                                        $publishers[$contentIndex][] = $content->contentPublishers[0]->publisher->name
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
                                    @if(count($content->contentRows) > 1)
                                        <button class="btn btn-primary btn-sm tr-toggle btn-expand m-3" data-index="{{$contentIndex}}">@lang('client.campaigns.withDetail')</button>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($content->impersion_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($content->clicks_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($content->reach_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($content->like_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($content->share_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($content->save_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($content->sticker_tap_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($content->comment_cnt)}}</span>
                            </td>

                            @if($content->media_type === 'content' )
                            <td class="text-right" rowspan="1" class="content_media_file_td_{{$contentIndex}}">
                                <div class="btn-group" role="group" aria-label="First group">
                                    @if($campaign->resource_type === 'all' || $campaign->resource_type === 'content')
                                    <button type="button" class="btn btn-warning btn-icon dynamic"
                                        data-id="{{$content->id}}" data-type="content_resource"><i
                                            class="fas fa-upload"></i></button>
                                    @endif
                                    <button type="button" class="btn btn-success btn-icon dynamic"
                                        data-id="{{$content->id}}" data-type="content_media"><i
                                            class="fas fa-photo-video"></i></button>
                                </div>
                            </td>
                            @elseif($content->resource_type === 'content')
                            <td class="text-right" rowspan="1" class="content_resource_file_td_{{$contentIndex}}">
                                <div class="btn-group" role="group" aria-label="First group">
                                    @if($campaign->resource_type === 'all' || $campaign->resource_type === 'content')
                                    <button type="button" class="btn btn-warning btn-icon dynamic"
                                        data-id="{{$content->id}}" data-type="content_resource"><i
                                            class="fas fa-upload"></i></button>
                                    @endif
                                    <button type="button" class="btn btn-success btn-icon dynamic"
                                        data-id="{{$content->id}}" data-type="content_media"><i
                                            class="fas fa-photo-video"></i></button>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @foreach($content->contentRows AS $contentRowsIndex => $row)
                        <tr style="display: none; background-color: #f7f7f7" class="detail-tr-{{$contentIndex}}">
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($row->impersion_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($row->clicks_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($row->reach_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($row->like_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($row->share_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($row->save_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($row->sticker_tap_cnt)}}</span>
                            </td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{number_format($row->comment_cnt)}}</span>
                            </td>

                            @if($content->media_type === 'rows')
                            <td class="text-right" rowspan="1">
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
                            @elseif($content->resource_type === 'rows')
                            <td class="text-right" rowspan="{{count($content->contentRows)}}">
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
<style>
    .lg-outer {
        direction: ltr
    }
</style>
@endsection

@section('scripts')
<script src="{{asset('assets/plugins/custom/lightGallery/dist/js/lightgallery-all.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/custom/echart/echarts.min.js')}}"></script>

<script type="text/javascript">
    $('.tr-toggle').on('click', function() {
        var index = $(this).attr('data-index');
        if(!$(this).hasClass('expanded')) {
            var conttd = $('.main-tr-' + index).find('td:nth-of-type(1)').attr('data-count');
            $('.main-tr-' + index).find('td:nth-of-type(1)').attr('rowspan', conttd);
            $('.detail-tr-' + index).fadeIn(0);
            $(this).removeClass('expanded').addClass('expanded');
            $(this).html('{{__('client.campaigns.withoutDetail')}}');
            $('.content_media_file_td_'+index).attr('rowspan', conttd)
        } else {
            $('.main-tr-' + index).find('td:nth-of-type(1)').attr('rowspan', '1');
            $('.detail-tr-' + index).fadeOut(0);
            $(this).removeClass('expanded');
            $(this).html('{{__('client.campaigns.withDetail')}}');
            $('.content_media_file_td_'+index).attr('rowspan', 1)
        }
    });

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

    var _initMixedWidget16 = function() {
        var element = document.getElementById("kt_mixed_widget_16_chart");
        var height = parseInt(KTUtil.css(element, 'height'));

        if (!element) {
            return;
        }

        var options = {
            series: ["{{$ratioData['ClickPerImp']}}", "{{$ratioData['ReachPerImp']}}", "{{$ratioData['StickerTapPerImp']}}", "{{$ratioData['SharePerImp']}}"],
            chart: {
                height: height,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: "30%"
                    },
                    dataLabels: {
                        showOn: "always",
                        name: {
                            show: false,
                            fontWeight: "700",
                        },
                        value: {
                            color: KTApp.getSettings()['colors']['gray']['gray-700'],
                            fontSize: "18px",
                            fontWeight: "700",
                            offsetY: 10,
                            show: true
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            fontWeight: "bold",
                            formatter: function (w) {
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return "{{$ratioData['ClickPerImp']}}%";
                            }
                        }
                    },
                    track: {
                        background: KTApp.getSettings()['colors']['gray']['gray-100'],
                        strokeWidth: '100%'
                    }
                }
            },
            colors: [
                KTApp.getSettings()['colors']['theme']['base']['info'],
                KTApp.getSettings()['colors']['theme']['base']['danger'],
                KTApp.getSettings()['colors']['theme']['base']['success'],
                KTApp.getSettings()['colors']['theme']['base']['primary']
            ],
            stroke: {
                lineCap: "round",
            },
            labels: ["Progress"]
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

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
        reach: "{{__('client.campaignPublisher.reach')}}",
        click: "{{__('client.campaignPublisher.click')}}",
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
            },{
				name: 'clicks',
				data: @json($chartData['clicks'])
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
        $(document).ready(function() {
            _initMixedWidget16();
        })
</script>
{{--  @include('client.campaignPublisher.js.index_js')  --}}
@endsection
