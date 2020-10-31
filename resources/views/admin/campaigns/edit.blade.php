@extends('layouts.app')

@section('content')
<div class="card card-custom gutter-b">
    <div class="card-header">
        <h3 class="card-title">@lang('admin.campaigns.edit')</h3>
    </div>

    <!--begin::Form-->
    <div class="card-body">
        @include('admin.campaigns.editTab')
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
                    ['draft', 'demo', 'active', 'archive']])
                </div>
                <div class="form-group row validated">
                    @include('components.form.radioGroup', ['scope' => 'admin.campaigns', 'name' => 'resource_type', 'options' =>
                    ['none', 'campaign', 'content', 'all']])
                    <div class="col">
                        <button type="button" class="btn btn-primary" onclick="openDropZoneModal(this)" data-type="campaign" data-id="{{$campaign->id}}" >
                            @lang('admin.campaigns.uploadResource')
                        </button>
                        <input type="hidden" name="document_campaign_unique_id" value="{{$campaign->id}}">
                    </div>
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
        </div>
    </div>
    <!--end::Form-->
</div>
@endsection

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
