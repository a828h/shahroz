<div class="card-body">
    <ul class="nav nav-tabs nav-tabs-line">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="{{route('admin.campaigns.edit')}}">@lang('admin.campaigns.general')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">@lang('admin.campaigns.campaignPublishers')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">@lang('admin.campaigns.newPublishers')</a>
        </li>
    </ul>
    <div class="tab-content mt-5" id="myTabContent">
        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
            {!! Form::model($campaign, ['route' => ['admin.campaigns.update', $campaign], 'method' => 'put', 'class' =>
            'form']) !!}
            <div class="form-group row validated">
                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'name'])
                @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'users[]', 'staticOptions'
                =>
                $users, 'extra' => ['data-live-search'=>"true", 'multiple' => 'true',
                "data-selected-text-format"=>"count > 3",
                "multiple data-actions-box"=>"true"]])
            </div>
            <div class="form-group row validated">
                @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'categories[]',
                'staticOptions' =>
                $categories, 'extra' => ['data-live-search'=>"true", 'multiple' => 'true',
                "data-selected-text-format"=>"count >
                3",
                "multiple data-actions-box"=>"true"]])
                @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'brands[]', 'staticOptions'
                =>
                $brands, 'extra' => ['data-live-search'=>"true", 'multiple' => 'true',
                "data-selected-text-format"=>"count > 3",
                "multiple data-actions-box"=>"true"]])
            </div>
            <div class="form-group row validated">
                @include('components.form.inputIcon', ['scope' => 'admin.campaigns', 'name' => 'start_at', 'icon' => 'fa
                fa-calendar-alt'])
                @include('components.form.inputIcon', ['scope' => 'admin.campaigns', 'name' => 'end_at', 'icon' => 'fa
                fa-calendar-alt'])
            </div>
            <div class="form-group row validated">
                @include('components.form.radioGroup', ['scope' => 'admin.campaigns', 'name' => 'platform', 'options' =>
                ['telegram', 'instagram_post', 'instagram_story']])
                @include('components.form.radioGroup', ['scope' => 'admin.campaigns', 'name' => 'status', 'options' =>
                ['draft',
                'active', 'archive']])
            </div>
            <div class="form-group m-form__group">
                <div class="row p-2">
                    @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'impersion_cnt',
                    'type'=>"number", 'readonly' => true])
                    @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'reach_cnt',
                    'type'=>"number", 'readonly' => true])
                    @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'clicks_cnt',
                    'type'=>"number", 'readonly' => true])
                    @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'like_cnt',
                    'type'=>"number", 'readonly' => true])
                </div>
                <div class="row p-2">
                    @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'share_cnt',
                    'type'=>"number", 'readonly' => true])
                    @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'save_cnt',
                    'type'=>"number", 'readonly' => true])
                    @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'sticker_tap_cnt',
                    'type'=>"number", 'readonly' => true])
                    @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'comment_cnt',
                    'type'=>"number", 'readonly' => true])
                </div>
                <div class="form-group m-form__group">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary mr-2">@lang('admin.global.saveGeneral')</button>
                        <button type="reset" class="btn btn-secondary">@lang('admin.global.cancel')</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
            {!! Form::open(['route' => ['admin.campaigns.updateCampaignPublishers', $campaign], 'method' => 'put', 'class' =>
            'form']) !!}
            <div id="m_repeater_1">
                <span id="m_repeater_1">
                    <span data-repeater-list="campaignPublishers">
                        @php
                        $publisherList=[];
                        $updatePublisherArr = [];
                        @endphp
                        @if(isset($campaign) && count($campaign->campiagnPublishers))
                        @foreach ($campaign->campiagnPublishers as $index => $campaignPublisher)
                        @php
                        if(($campaignPublisher->publisher->status === 'new' &&
                        !in_array($campaignPublisher->publisher->id,
                        $publisherList))) {
                        $updatePublisherArr[] = $campaignPublisher->publisher;
                        }
                        $publisherList[] = $campaignPublisher->publisher->id;
                        @endphp
                        <div data-repeater-item='{{$index}}' class="form-group  m-form__group {{ $campaignPublisher->publisher->name === 'unknown' ? 'bg-light-warning' : 'bg-light' }} ">
                            <input name="id" type="hidden" value="{{$campaignPublisher->id}}" />

                            <div class="row p-2">
                                @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'publisher',
                                'staticOptions' =>$publishers, 'value' => $campaignPublisher->publisher_id, 'extra' =>
                                ['data-live-search'=>"true"]])
                                <div class="col-lg col-md"></div>
                            </div>
                            <div class="row p-2">
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'impersion_cnt',
                                'type'=>"number", 'value' => $campaignPublisher->impersion_cnt])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'reach_cnt',
                                'type'=>"number", 'value' => $campaignPublisher->reach_cnt ])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'clicks_cnt',
                                'type'=>"number", 'value' => $campaignPublisher->clicks_cnt])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'like_cnt',
                                'type'=>"number", 'value' => $campaignPublisher->like_cnt])
                            </div>
                            <div class="row p-2">
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'share_cnt',
                                'type'=>"number", 'value' => $campaignPublisher->share_cnt])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'save_cnt',
                                'type'=>"number", 'value' => $campaignPublisher->save_cnt])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'sticker_tap_cnt',
                                'type'=>"number", 'value' => $campaignPublisher->sticker_tap_cnt])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'comment_cnt',
                                'type'=>"number", 'value' => $campaignPublisher->comment_cnt])
                            </div>
                            <div class="row p-2">
                                @include('components.form.radioGroup', ['scope' => 'admin.campaigns', 'name' => 'type',
                                'options' => ['impression', 'fix'], 'value' => $campaignPublisher->type])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'our_cost',
                                'type'=>"number", 'value' => $campaignPublisher->our_cost])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'customer_cost',
                                'type'=>"number", 'value' => $campaignPublisher->customer_cost])
                                <div class="col"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-lg col-md">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a data-input="thumbnail" data-preview="holder"
                                                class="btn btn-secondary lfm x1">
                                                <i class="fa fa-picture-o"></i> @lang('admin.campaigns.chooseVideoUrl')
                                            </a>
                                        </span>
                                        {!! Form::input('text', 'video_url', $campaignPublisher->video_url, ['class' =>
                                        "form-control x2", 'id'=>"thumbnail", 'placeholder' =>
                                        __('admin.campaigns.enterVideoUrl'
                                        )]) !!}
                                    </div>
                                    <img id="holder" class="x3" style="margin-top:15px;max-height:100px;">
                                </div>
                                <div class="col-lg col-md">
                                    <div data-repeater-delete=""
                                        class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill align-middle">
                                        <span>
                                            <i class="la la-trash-o"></i>
                                            <span>@lang('admin.global.delete')</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        @else
                        <div data-repeater-item class="form-group  m-form__group box-very-light m-2">
                            <div class="row p-2">
                                @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'publisher',
                                'value'
                                => '',
                                'staticOptions' =>
                                $publishers, 'extra' => ['data-live-search'=>"true"]])
                                <div class="col-lg col-md"></div>
                            </div>
                            <div class="row p-2">
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'impersion_cnt','value' => '',
                                'type'=>"number"])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'reach_cnt','value'
                                => '',
                                'type'=>"number" ])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'clicks_cnt','value' => '',
                                'type'=>"number"])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'like_cnt','value' =>
                                '',
                                'type'=>"number"])
                            </div>
                            <div class="row p-2">
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'share_cnt','value'
                                => '',
                                'type'=>"number"])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'save_cnt','value' =>
                                '',
                                'type'=>"number"])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'sticker_tap_cnt','value' => '',
                                'type'=>"number"])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'comment_cnt','value'
                                => '',
                                'type'=>"number"])
                            </div>
                            <div class="row p-2">
                                @include('components.form.radioGroup', ['scope' => 'admin.campaigns', 'name' => 'type',
                                'options' => ['impression', 'fix']])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'our_cost',
                                'type'=>"number"])
                                @include('components.form.input', ['scope' => 'admin.campaigns', 'name' =>
                                'customer_cost',
                                'type'=>"number"])
                                <div class="col"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-lg col-md">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a data-input="thumbnail" data-preview="holder"
                                                class="btn btn-default lfm x1">
                                                <i class="fa fa-picture-o"></i> انتخاب فایل
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control x2" type="text" name="video_url">
                                    </div>
                                    <img id="holder" class="x3" style="margin-top:15px;max-height:100px;">
                                </div>
                                <div class="col-lg col-md">
                                    <div data-repeater-delete=""
                                        class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill align-middle">
                                        <span>
                                            <i class="la la-trash-o"></i>
                                            <span>@lang('admin.global.delete')</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </span>
                </span>
                <div class="m-form__group form-group box-very-light mx-2">
                    <div class="row">
                        <div class="col-lg-4 ">
                            <div data-repeater-create="" class="btn btn-info">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>@lang('admin.campaigns.addCampaignPublisher')</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group">
                <div class="col-lg-6">
                    <button type="submit"
                        class="btn btn-primary mr-2">@lang('admin.campaigns.saveCampaignPublishers')</button>
                    <button type="reset" class="btn btn-secondary">@lang('admin.global.cancel')</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
            {!! Form::open(['route' => ['admin.campaigns.updateNewPublishers', $campaign], 'method' => 'put', 'class' =>
            'form']) !!}
            @if(count($updatePublisherArr))
            @foreach ($updatePublisherArr as $index => $updatePublisher)
            <div class="form-group m-form__group {{ $updatePublisher->name === '' ? ' border-warning bg-light-warning' : '' }}">
                <div class="row p-2">
                    <input type="hidden" name="publishers[{{$index}}][id]" value="{{$updatePublisher->id}}" />
                    @include('components.form.input', ['scope' => 'admin.publishers', 'name' =>
                    "publishers[$index][name]",
                    'value' =>
                    $updatePublisher->name, 'label' => 'admin.publishers.name', 'placeholder' =>
                    'admin.publishers.enterName'])
                    @include('components.form.inputIcon', ['scope' => 'admin.publishers', 'name' =>
                    "publishers[$index][link]",
                    'icon'
                    => 'la la-url', 'value' => $updatePublisher->link, 'label' => 'admin.publishers.link',
                    'placeholder' => 'admin.publishers.enterLink'])
                    @include('components.form.radioGroup', ['scope' => 'admin.publishers', 'name' =>
                    "publishers[$index][platform]", 'staticOptions' =>
                    ['telegram' => __('admin.publishers.platforms.telegram'), 'instagram' =>
                    __('admin.publishers.platforms.instagram')], 'value' => $updatePublisher->platform, 'label' =>
                    'admin.publishers.platform', 'placeholder' => 'admin.publishers.choosePlatform'])
                    @include('components.form.radioGroup', [
                        'scope' => 'admin.publishers',
                        'name' => "publishers[$index][status]",
                        'staticOptions' => [
                            'new' => __('admin.publishers.statuses.new'),
                            'active' => __('admin.publishers.statuses.active'),
                            'inactive' => __('admin.publishers.statuses.inactive')
                            ],
                        'value' => $updatePublisher->status,
                        'label' => 'admin.publishers.status',
                        'placeholder' => 'admin.publishers.chooseStatus'
                    ])
                </div>
            </div>
            @endforeach
            @endif
            <div class="form-group m-form__group">
                <div class="col-lg-6">
                    <button type="submit"
                        class="btn btn-primary mr-2">@lang('admin.campaigns.savePublishers')</button>
                    <button type="reset" class="btn btn-secondary">@lang('admin.global.cancel')</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@section('styles')
@parent
<link rel="stylesheet" href="{{asset('assets/plugins/custom/datepicker/persian-datepicker.min.css')}}"
    type="text/css" />
@endsection

@section('scripts')
@parent
<script type="text/javascript" src="{{asset('assets/plugins/custom/datepicker/persian-date.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/custom/datepicker/persian-datepicker.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
    jQuery(document).ready(function () {
        $('.lfm').filemanager('file');
        $("#m_repeater_1").repeater({
            initEmpty: false,
            defaultValues: { "text-input": "foo" },
            show: function () {
                $(this).slideDown();
                $(".m_selectpicker").selectpicker();
                $('.x1').each(function(i,element){
                    $(element).attr('data-input', 'thumbnail-' + i)
                    $(element).attr('data-preview', 'holder-' + i)
                })
                $('.x2').each(function(i,element){
                    $(element).attr('id', 'thumbnail-' + i)
                })
                $('.x3').each(function(i,element){
                    $(element).attr('id', 'holder-' + i)
                })
                $('.lfm').filemanager('file');
            },
            hide: function (e) {
                $(this).slideUp(e);
            },
            ready: function(e) {

            }
        });

        $("input[name=start_at], input[name=end_at]").pDatepicker({
            observer: true,
            format: 'YYYY/MM/DD HH:mm:ss',
            calendarType: 'persian',
            responsive: true,
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                },
                hour: {
                    enabled: true,
                },
                minute: {
                    enabled: true,
                },
                second: {
                    enabled: true,
                }
            },
            autoClose: true
        });
    });
</script>
@endsection
