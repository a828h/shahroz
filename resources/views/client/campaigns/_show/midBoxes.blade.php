<div class="row">
    <div class="col-xl-8">
        <!--begin::Base Table Widget 2-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label font-weight-bolder text-dark">@lang('client.campaigns.top_publishers')</span>
                    <span
                        class="text-muted mt-3 font-weight-bold font-size-sm">@lang('client.campaigns.top_publishers_desc')</span>
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4" data-toggle="tab"
                                href="#kt_tab_pane_2_1">@lang('client.campaigns.share')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4" data-toggle="tab"
                                href="#kt_tab_pane_2_2">@lang('client.campaigns.sticker_tap')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4" data-toggle="tab"
                                href="#kt_tab_pane_2_3">@lang('client.campaigns.click')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" data-toggle="tab"
                                href="#kt_tab_pane_2_4">@lang('client.campaigns.reach')</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="tab-content">
                <div class="card-body pt-2 pb-0 tab-pane fade" id="kt_tab_pane_2_1" role="tabpanel">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                            <thead>
                                <tr>
                                    <th class="p-0" style="width: 50px"></th>
                                    <th class="p-0" style="min-width: 150px"></th>
                                    <th class="p-0" style="min-width: 140px"></th>
                                    <th class="p-0" style="min-width: 120px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bestContents['share'] AS $content)
                                <tr>
                                    <td class="pl-0 py-5">
                                        @if(count($content->contentPublishers) === 1)
                                            <div class="symbol symbol-50 symbol-light mr-2">
                                                <span class="symbol-label">
                                                    <img src="{{!empty($content->contentPublishers[0]->publisher->image_url) ? $content->contentPublishers[0]->publisher->image_url : asset('/assets/media/svg/avatars/001-boy.svg')}}"
                                                        class="h-50 align-self-center" alt="{{$content->contentPublishers[0]->publisher->name}}" />
                                                </span>
                                            </div>
                                        @else
                                            <div class="symbol symbol-50 symbol-light mr-2">
                                                <span class="symbol-label">
                                                    @foreach ($content->contentPublishers as $contentPublisher)
                                                        <img style="height: {{100/(count($content->contentPublishers))}}% !important;" src="{{!empty($contentPublisher->publisher->image_url) ? $contentPublisher->publisher->image_url : asset('/assets/media/svg/avatars/001-boy.svg')}}"
                                                        class="h-50 align-self-center" alt="{{$contentPublisher->publisher->name}}" />
                                                    @endforeach
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="pl-0">
                                        @php
                                            $publishers = [];
                                            foreach($content->contentPublishers AS $contentPublisher){
                                                $publishers[] = $contentPublisher->publisher->name;
                                            }
                                        @endphp
                                        <span class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">{{implode(',', $publishers)}}</span>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-muted font-weight-bold d-block font-size-sm">
                                            @lang('client.campaigns.imperssion')
                                        </span>
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                            {{number_format($content->impersion_cnt, 0)}}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span
                                            class="text-dark-50 font-weight-bold">{{number_format($content->reach_cnt, 0)}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <div class="card-body pt-2 pb-0 tab-pane fade" id="kt_tab_pane_2_2" role="tabpanel">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                            <thead>
                                <tr>
                                    <th class="p-0" style="width: 50px"></th>
                                    <th class="p-0" style="min-width: 150px"></th>
                                    <th class="p-0" style="min-width: 140px"></th>
                                    <th class="p-0" style="min-width: 120px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bestContents['sticker_tap'] AS $content)
                                <tr>
                                    <td class="pl-0 py-5">
                                        @if(count($content->contentPublishers) === 1)
                                            <div class="symbol symbol-50 symbol-light mr-2">
                                                <span class="symbol-label">
                                                    <img src="{{!empty($content->contentPublishers[0]->publisher->image_url) ? $content->contentPublishers[0]->publisher->image_url : asset('/assets/media/svg/avatars/001-boy.svg')}}"
                                                        class="h-50 align-self-center" alt="{{$content->contentPublishers[0]->publisher->name}}" />
                                                </span>
                                            </div>
                                        @else
                                            <div class="symbol symbol-50 symbol-light mr-2">
                                                <span class="symbol-label">
                                                    @foreach ($content->contentPublishers as $contentPublisher)
                                                        <img style="height: {{100/(count($content->contentPublishers))}}% !important;" src="{{!empty($contentPublisher->publisher->image_url) ? $contentPublisher->publisher->image_url : asset('/assets/media/svg/avatars/001-boy.svg')}}"
                                                        class="h-50 align-self-center" alt="{{$contentPublisher->publisher->name}}" />
                                                    @endforeach
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="pl-0">
                                        @php
                                            $publishers = [];
                                            foreach($content->contentPublishers AS $contentPublisher){
                                                $publishers[] = $contentPublisher->publisher->name;
                                            }
                                        @endphp
                                        <span class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">{{implode(',', $publishers)}}</span>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-muted font-weight-bold d-block font-size-sm">
                                            @lang('client.campaigns.imperssion')
                                        </span>
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                            {{number_format($content->impersion_cnt, 0)}}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span
                                            class="text-dark-50 font-weight-bold">{{number_format($content->sticker_tap_cnt, 0)}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <div class="card-body pt-2 pb-0 tab-pane fade" id="kt_tab_pane_2_3" role="tabpanel">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                            <thead>
                                <tr>
                                    <th class="p-0" style="width: 50px"></th>
                                    <th class="p-0" style="min-width: 150px"></th>
                                    <th class="p-0" style="min-width: 140px"></th>
                                    <th class="p-0" style="min-width: 120px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bestContents['click'] AS $content)
                                <tr>
                                    <td class="pl-0 py-5">
                                        @if(count($content->contentPublishers) === 1)
                                            <div class="symbol symbol-50 symbol-light mr-2">
                                                <span class="symbol-label">
                                                    <img src="{{!empty($content->contentPublishers[0]->publisher->image_url) ? $content->contentPublishers[0]->publisher->image_url : asset('/assets/media/svg/avatars/001-boy.svg')}}"
                                                        class="h-50 align-self-center" alt="{{$content->contentPublishers[0]->publisher->name}}" />
                                                </span>
                                            </div>
                                        @else
                                            <div class="symbol symbol-50 symbol-light mr-2">
                                                <span class="symbol-label">
                                                    @foreach ($content->contentPublishers as $contentPublisher)
                                                        <img style="height: {{100/(count($content->contentPublishers))}}% !important;" src="{{!empty($contentPublisher->publisher->image_url) ? $contentPublisher->publisher->image_url : asset('/assets/media/svg/avatars/001-boy.svg')}}"
                                                        class="h-50 align-self-center" alt="{{$contentPublisher->publisher->name}}" />
                                                    @endforeach
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="pl-0">
                                        @php
                                            $publishers = [];
                                            foreach($content->contentPublishers AS $contentPublisher){
                                                $publishers[] = $contentPublisher->publisher->name;
                                            }
                                        @endphp
                                        <span class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">{{implode(',', $publishers)}}</span>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-muted font-weight-bold d-block font-size-sm">
                                            @lang('client.campaigns.imperssion')
                                        </span>
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                            {{number_format($content->impersion_cnt, 0)}}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span
                                            class="text-dark-50 font-weight-bold">{{number_format($content->clicks_cnt, 0)}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <div class="card-body pt-2 pb-0 tab-pane fade show active" id="kt_tab_pane_2_4" role="tabpanel">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                            <thead>
                                <tr>
                                    <th class="p-0" style="width: 50px"></th>
                                    <th class="p-0" style="min-width: 150px"></th>
                                    <th class="p-0" style="min-width: 140px"></th>
                                    <th class="p-0" style="min-width: 120px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bestContents['reach'] AS $content)
                                <tr>
                                    <td class="pl-0 py-5">
                                        @if(count($content->contentPublishers) === 1)
                                            <div class="symbol symbol-50 symbol-light mr-2">
                                                <span class="symbol-label">
                                                    <img src="{{!empty($content->contentPublishers[0]->publisher->image_url) ? $content->contentPublishers[0]->publisher->image_url : asset('/assets/media/svg/avatars/001-boy.svg')}}"
                                                        class="h-50 align-self-center" alt="{{$content->contentPublishers[0]->publisher->name}}" />
                                                </span>
                                            </div>
                                        @else
                                            <div class="symbol symbol-50 symbol-light mr-2">
                                                <span class="symbol-label">
                                                    @foreach ($content->contentPublishers as $contentPublisher)
                                                        <img style="height: {{100/(count($content->contentPublishers))}}% !important;" src="{{!empty($contentPublisher->publisher->image_url) ? $contentPublisher->publisher->image_url : asset('/assets/media/svg/avatars/001-boy.svg')}}"
                                                        class="h-50 align-self-center" alt="{{$contentPublisher->publisher->name}}" />
                                                    @endforeach
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="pl-0">
                                        @php
                                            $publishers = [];
                                            foreach($content->contentPublishers AS $contentPublisher){
                                                $publishers[] = $contentPublisher->publisher->name;
                                            }
                                        @endphp
                                        <span class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">{{implode(',', $publishers)}}</span>
                                    </td>
                                    <td class="text-right">
                                        <span class="text-muted font-weight-bold d-block font-size-sm">
                                            @lang('client.campaigns.imperssion')
                                        </span>
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                            {{number_format($content->impersion_cnt, 0)}}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <span
                                            class="text-dark-50 font-weight-bold">{{number_format($content->reach_cnt, 0)}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Base Table Widget 2-->
    </div>
    <div class="col-xl-4">
        <!--begin::Mixed Widget 16-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <div class="card-title font-weight-bolder">
                    <div class="card-label">@lang('client.campaigns.compareReport')
                        <div class="font-size-sm text-muted mt-2">{{number_format($campaign->impersion_cnt, 0)}}
                            @lang('client.campaigns.imperssion')</div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Chart-->
                <div id="kt_mixed_widget_16_chart" style="height: 200px"></div>
                <!--end::Chart-->
                <!--begin::Items-->
                <div class="mt-10 mb-5">
                    <div class="row row-paddingless mb-10">
                        <!--begin::Item-->
                        <div class="col">
                            <div class="d-flex align-items-center mr-2">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45 symbol-light-info mr-4 flex-shrink-0">
                                    <div class="symbol-label">
                                        <span class="svg-icon svg-icon-lg svg-icon-info">
                                            <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/General/Cursor.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M14.2330207,14.3666907 L16.3111786,18.8233147 C16.4278814,19.0735846 16.3196038,19.3710749 16.0693338,19.4877777 L14.2567182,20.3330142 C14.0064483,20.449717 13.708958,20.3414394 13.5922552,20.0911694 L11.4668267,15.5331733 L8.85355339,18.1464466 C8.7597852,18.2402148 8.63260824,18.2928932 8.5,18.2928932 C8.22385763,18.2928932 8,18.0690356 8,17.7928932 L8,5.13027585 C8,5.00589283 8.04636089,4.88597544 8.13002996,4.79393946 C8.31578343,4.58961065 8.63200759,4.57455235 8.8363364,4.76030582 L18.1424309,13.2203917 C18.2368163,13.3061967 18.2948385,13.424831 18.3046218,13.5520135 C18.3258009,13.8273425 18.1197718,14.0677099 17.8444428,14.088889 L14.2330207,14.3666907 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon--></span>
                                    </div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Title-->
                                <div>
                                    <div class="font-size-h4 text-dark-75 font-weight-bolder">
                                        {{$ratioData['impPerClick']}}%</div>
                                    <div class="font-size-sm text-muted font-weight-bold mt-1">
                                        @lang('client.campaigns.impPerClick')</div>
                                </div>
                                <!--end::Title-->
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="col">
                            <div class="d-flex align-items-center mr-2">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45 symbol-light-danger mr-4 flex-shrink-0">
                                    <div class="symbol-label">
                                        <span class="svg-icon svg-icon-lg svg-icon-danger">
                                            <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/General/Attachment1.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
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
                                    </div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Title-->
                                <div>
                                    <div class="font-size-h4 text-dark-75 font-weight-bolder">
                                        {{$ratioData['impPerReach']}}%</div>
                                    <div class="font-size-sm text-muted font-weight-bold mt-1">
                                        @lang('client.campaigns.impPerReach')</div>
                                </div>
                                <!--end::Title-->
                            </div>
                        </div>
                        <!--end::Item-->
                    </div>
                    <div class="row row-paddingless">
                        <!--begin::Item-->
                        <div class="col">
                            <div class="d-flex align-items-center mr-2">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
                                    <div class="symbol-label">
                                        <span class="svg-icon svg-icon-lg svg-icon-success">
                                            <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Design/Interselect.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
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
                                    </div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Title-->
                                <div>
                                    <div class="font-size-h4 text-dark-75 font-weight-bolder">
                                        {{$ratioData['impPerStickerTap']}}%</div>
                                    <div class="font-size-sm text-muted font-weight-bold mt-1">
                                        @lang('client.campaigns.impPerStickerTap')</div>
                                </div>
                                <!--end::Title-->
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="col">
                            <div class="d-flex align-items-center mr-2">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
                                    <div class="symbol-label">
                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                            <!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Files/Share.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M15.1231569,19.0111815 L7.83785094,14.818972 C8.31992102,14.3336937 8.67836566,13.7254559 8.86199856,13.0454449 L16.0980947,17.246999 C15.6352738,17.7346932 15.2940944,18.3389541 15.1231569,19.0111815 Z M7.75585639,9.10080708 L15.0774983,4.78750147 C15.2169157,5.48579221 15.5381369,6.11848298 15.9897205,6.63413231 L8.86499752,10.9657252 C8.67212677,10.2431476 8.28201274,9.60110795 7.75585639,9.10080708 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                    <circle fill="#000000" opacity="0.3" cx="19" cy="4" r="3" />
                                                    <circle fill="#000000" opacity="0.3" cx="19" cy="20" r="3" />
                                                    <circle fill="#000000" opacity="0.3" cx="5" cy="12" r="3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon--></span>
                                    </div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Title-->
                                <div>
                                    <div class="font-size-h4 text-dark-75 font-weight-bolder">
                                        {{$ratioData['impPerShare']}}%</div>
                                    <div class="font-size-sm text-muted font-weight-bold mt-1">
                                        @lang('client.campaigns.impPerShare')</div>
                                </div>
                                <!--end::Title-->
                            </div>
                        </div>
                        <!--end::Item-->
                    </div>
                </div>
                <!--end::Items-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 16-->
    </div>
</div>
