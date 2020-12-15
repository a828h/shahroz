<div class="card-body">
    <div class="form-group row validated">
        @include('components.form.input', ['scope' => 'admin.campaigns', 'name' => 'name'])
        @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'users[]', 'staticOptions' =>
        $users, 'extra' => ['data-live-search'=>"true", 'multiple' => 'true', "data-selected-text-format"=>"count > 3",
        "multiple data-actions-box"=>"true"]])
    </div>
    <div class="form-group row validated">
        @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'hunter_id',
        'staticOptions' =>
        $hunter, 'extra' => ['data-live-search'=>"true"]])
        @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'executor_id',
        'staticOptions' =>
        $executor, 'extra' => ['data-live-search'=>"true"]])
    </div>
    <div class="form-group row validated">
        @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'categories[]', 'staticOptions' =>
        $categories, 'extra' => ['data-live-search'=>"true", 'multiple' => 'true', "data-selected-text-format"=>"count >
        3",
        "multiple data-actions-box"=>"true"]])
        @include('components.form.select', ['scope' => 'admin.campaigns', 'name' => 'brands[]', 'staticOptions' =>
        $brands, 'extra' => ['data-live-search'=>"true", 'multiple' => 'true', "data-selected-text-format"=>"count > 3",
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
        @include('components.form.radioGroup', ['scope' => 'admin.campaigns', 'name' => 'status', 'options' => ['draft',
        'active', 'archive', 'demo']])
    </div>
    <div class="form-group row validated">
        @include('components.form.radioGroup', ['scope' => 'admin.campaigns', 'name' => 'resource_type', 'options' =>
        ['none', 'campaign', 'content', 'all']])
        <div class="col">
            <button type="button" class="btn btn-primary" onclick="openDropZoneModal(this)" data-type="campaign"
                data-id="noid">
                @lang('admin.campaigns.uploadResource')
            </button>
            <input type="hidden" name="document_campaign_unique_id" value="noid">
        </div>
    </div>
    <div class="card-header">
        <h3 class="card-title"> @lang('admin.campaigns.campaignPublisher')</h3>
    </div>
    <div class="repeater">
        <div data-repeater-list="contents">
            @if(old('contents') && count(old('contents')) > 0)
            @foreach (old('contents') as $index => $item)
            <div data-repeater-item data-repeater-index="{{$index}}" class="rounded rounded-top-0 m-4 p-3"
                style="border: 1px solid #c0c0c0">
                <div class="form-group row validated" style="margin-bottom: 5px">
                    @include('components.form.select', [
                    'label' => 'admin.campaigns.publishers',
                    'placeholder' => 'admin.campaigns.publishers',
                    'name' => 'publishers',
                    'size' => 'col-xs-6 col-md-2',
                    'staticOptions' => $publishers,
                    'value' => $item['publishers'] ?? [],
                    'customError' => $errors->first("contents.$index.publishers"),
                    'extra' => ['data-live-search'=>"true", 'multiple' => 'true', "data-selected-text-format"=>"count >
                    3", "multiple data-actions-box"=>"true"]
                    ])
                    @include('components.form.select', [
                    'label' => 'admin.campaigns.type',
                    'placeholder' => 'admin.campaigns.type',
                    'name' => 'type',
                    'value' => $item['type'],
                    'customError' => $errors->first("contents.$index.type"),
                    'size' => 'col-xs-6 col-md-2',
                    'staticOptions' => ['impression' => __('admin.campaigns.types.impression'), 'fix' =>
                    __('admin.campaigns.types.fix')],
                    ])

                    @include('components.form.input', [
                    'type' => 'number',
                    'label' => 'admin.campaigns.our_cost',
                    'placeholder' => 'admin.campaigns.enterOurCost',
                    'size' => 'col-xs-6 col-md-2',
                    'name' => 'our_cost',
                    'value' => $item['our_cost'],
                    'customError' => $errors->first("contents.$index.our_cost"),
                    ])
                    @include('components.form.input', [
                    'type' => 'number',
                    'label' => 'admin.campaigns.customer_cost',
                    'placeholder' => 'admin.campaigns.enterCustomerCost',
                    'size' => 'col-xs-6 col-md-2',
                    'name' => 'customer_cost',
                    'value' => $item['customer_cost'],
                    'customError' => $errors->first("contents.$index.customer_cost"),
                    ])
                    <div class="form-group">
                        <label>@lang('admin.campaigns.uploadFiles')</label>
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-primary">
                                <input onchange="uploadMediaState(this)" name="media_checked" {{isset($item['media_checked']) ? 'checked' : ''}} class="media-checkbox"
                                    type="checkbox">@lang('admin.campaigns.singleUploadMedia')
                                <span></span></label>
                            <label class="checkbox checkbox-info">
                                <input onchange="uploadResourceState(this)" name="resource_checked" {{isset($item['resource_checked']) ? 'checked' : ''}} class="resource-checkbox"
                                    type="checkbox">@lang('admin.campaigns.uploadFilesResource')
                                <span></span></label>
                        </div>
                        <span class="form-text text-muted">@lang('admin.campaigns.uploadFilesDesc')</span>
                    </div>
                    <div class="row col align-items-center justify-content-end">
                        <button data-repeater-delete type="button" value="Delete" class="btn btn-danger btn-sm mx-2">
                            <i class="flaticon-delete-1"></i>
                            @lang('admin.campaigns.removeContent')
                        </button>
                        <button type="button" class="btn btn-warning btn-icon btn-sm mx-2 media_upload_related_btn {{ isset($item['media_checked']) ? '' : 'd-none'}}"
                            onclick="openDropZoneModal(this)" data-type="content_media" data-id="{{$item['content_media_id'] !== 'noid' ? $item['content_media_id'] : 'noid'}}">
                            <i class="fas fa-photo-video"></i>
                        </button>
                        <input type="hidden" name="content_media_id" class="media_upload_related" value="{{$item['content_media_id'] !== 'noid' ? $item['content_media_id'] : 'noid'}}">
                        <button type="button" class="btn btn-primary btn-icon btn-sm mx-2 resource_upload_related_btn {{ isset($item['resource_checked']) ? '' : 'd-none'}}"
                            onclick="openDropZoneModal(this)" data-type="content_resource" data-id="{{$item['content_resource_id'] !== 'noid' ? $item['content_resource_id'] : 'noid'}}">
                            <i class="fas fa-upload"></i>
                        </button>
                        <input type="hidden" name="content_resource_id" class="resource_upload_related" value="{{$item['content_resource_id'] !== 'noid' ? $item['content_resource_id'] : 'noid'}}">
                    </div>
                </div>


                <!-- innner repeater -->
                <div class="inner-repeater">
                    <table class="table table-bordered table-head-custom table-vertical-center media-table {{isset($item['media_checked']) ? 'hide-media' : ''}} {{isset($item['resource_checked']) ? 'hide-resource' : ''}}">
                        <thead>
                            <tr class="table-head">
                                <th style="min-width: 100px;">@lang('admin.campaigns.impersion_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.reach_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.clicks_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.like_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.share_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.save_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.sticker_tap_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.comment_cnt')</th>
                                <th class="uploadMedia">@lang('admin.campaigns.chooseVideoUrl')</th>
                                <th class="uploadResource">@lang('admin.campaigns.chooseVideoUrl')</th>
                                <th>@lang('admin.campaigns.actions')</th>
                            </tr>
                        </thead>
                        <tbody data-repeater-list="rows">
                            @foreach($item['rows'] AS $indexRow => $row)
                            <tr data-repeater-item data-repeater-index="{{$index}}">
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterImpersionCnt',
                                    'name' => 'impersion_cnt',
                                    'classes' => 'form-control-sm',
                                    'value' => $row['impersion_cnt'],
                                    'customError' => $errors->first("contents.$index.rows.$indexRow.impersion_cnt"),
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterReachCnt',
                                    'name' => 'reach_cnt',
                                    'classes' => 'form-control-sm',
                                    'value' => $row['reach_cnt'],
                                    'customError' => $errors->first("contents.$index.rows.$indexRow.reach_cnt"),
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterClicksCnt',
                                    'name' => 'clicks_cnt',
                                    'classes' => 'form-control-sm',
                                    'value' => $row['clicks_cnt'],
                                    'customError' => $errors->first("contents.$index.rows.$indexRow.clicks_cnt"),
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterLikeCnt',
                                    'name' => 'like_cnt',
                                    'classes' => 'form-control-sm',
                                    'value' => $row['like_cnt'],
                                    'customError' => $errors->first("contents.$index.rows.$indexRow.like_cnt"),
                                    ])
                                </td>

                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterShareCnt',
                                    'name' => 'share_cnt',
                                    'classes' => 'form-control-sm',
                                    'value' => $row['share_cnt'],
                                    'customError' => $errors->first("contents.$index.rows.$indexRow.share_cnt"),
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterSaveCnt',
                                    'name' => 'save_cnt',
                                    'classes' => 'form-control-sm',
                                    'value' => $row['save_cnt'],
                                    'customError' => $errors->first("contents.$index.rows.$indexRow.save_cnt"),
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterStickerTapCnt',
                                    'name' => 'sticker_tap_cnt',
                                    'classes' => 'form-control-sm',
                                    'value' => $row['sticker_tap_cnt'],
                                    'customError' => $errors->first("contents.$index.rows.$indexRow.sticker_tap_cnt"),
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterCommentCnt',
                                    'name' => 'comment_cnt',
                                    'classes' => 'form-control-sm',
                                    'value' => $row['comment_cnt'],
                                    'customError' => $errors->first("contents.$index.rows.$indexRow.comment_cnt"),
                                    ])
                                </td>
                                <td class="uploadMedia">
                                    <button type="button" class="btn btn-warning btn-icon btn-sm"
                                        onclick="openDropZoneModal(this)" data-type="contentRow_media" data-id="{{$row['contentRow_media_id'] !== 'noid'  && !empty($row['contentRow_media_id']) ? $row['contentRow_media_id'] : 'noid'}}">
                                        <i class="fas fa-photo-video"></i>
                                    </button>
                                    <input type="hidden" name="contentRow_media_id" value="{{$row['contentRow_media_id'] !== 'noid' && !empty($row['contentRow_media_id']) ? $row['contentRow_media_id'] : 'noid'}}">
                                </td>
                                <td class="uploadResource">
                                    <button type="button" class="btn btn-primary btn-icon btn-sm"
                                        onclick="openDropZoneModal(this)" data-type="contentRow_resource"
                                        data-id="{{$row['contentRow_resource_id'] !== 'noid' && !empty($row['contentRow_resource_id']) ? $row['contentRow_resource_id'] : 'noid'}}">
                                        <i class="fas fa-upload"></i>
                                    </button>
                                    <input type="hidden" name="contentRow_resource_id" value="{{$row['contentRow_resource_id'] !== 'noid' && !empty($row['contentRow_resource_id']) ? $row['contentRow_resource_id'] : 'noid'}}">
                                </td>
                                <td>
                                    <button data-repeater-delete type="button" value="Delete"
                                        class="btn btn-outline-danger btn-sm btn-icon">
                                        <i class="flaticon-delete"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button data-repeater-create type="button" class="btn btn-outline-success btn-sm mr-3">
                        <i class="flaticon-add-circular-button"></i>
                        @lang('admin.campaigns.addRow')
                    </button>
                </div>

            </div>
            @endforeach
            @else
            <div data-repeater-item class="rounded rounded-top-0 m-4 p-3" style="border: 1px solid #c0c0c0">
                <div class="form-group row validated" style="margin-bottom: 5px">
                    @include('components.form.select', [
                    'label' => 'admin.campaigns.publishers',
                    'placeholder' => 'admin.campaigns.publishers',
                    'name' => 'publishers',
                    'size' => 'col-xs-6 col-md-2',
                    'staticOptions' => $publishers,
                    'extra' => ['data-live-search'=>"true", 'multiple' => 'true', "data-selected-text-format"=>"count >
                    3", "multiple data-actions-box"=>"true"]
                    ])
                    @include('components.form.select', [
                    'label' => 'admin.campaigns.type',
                    'placeholder' => 'admin.campaigns.type',
                    'name' => 'type',
                    'size' => 'col-xs-6 col-md-2',
                    'staticOptions' => ['impression' => __('admin.campaigns.types.impression'), 'fix' =>
                    __('admin.campaigns.types.fix')],
                    ])

                    @include('components.form.input', [
                    'type' => 'number',
                    'label' => 'admin.campaigns.our_cost',
                    'placeholder' => 'admin.campaigns.enterOurCost',
                    'size' => 'col-xs-6 col-md-2',
                    'name' => 'our_cost'
                    ])
                    @include('components.form.input', [
                    'type' => 'number',
                    'label' => 'admin.campaigns.customer_cost',
                    'placeholder' => 'admin.campaigns.enterCustomerCost',
                    'size' => 'col-xs-6 col-md-2',
                    'name' => 'customer_cost'
                    ])
                    <div class="form-group">
                        <label>@lang('admin.campaigns.uploadFiles')</label>
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-primary">
                                <input onchange="uploadMediaState(this)" class="media-checkbox" name="media_checked"
                                    type="checkbox">@lang('admin.campaigns.singleUploadMedia')
                                <span></span></label>
                            <label class="checkbox checkbox-info">
                                <input onchange="uploadResourceState(this)" class="resource-checkbox" name="resource_checked"
                                    type="checkbox">@lang('admin.campaigns.uploadFilesResource')
                                <span></span></label>
                        </div>
                        <span class="form-text text-muted">@lang('admin.campaigns.uploadFilesDesc')</span>
                    </div>
                    <div class="row col align-items-center justify-content-end">
                        <button data-repeater-delete type="button" value="Delete" class="btn btn-danger btn-sm mx-2">
                            <i class="flaticon-delete-1"></i>
                            @lang('admin.campaigns.removeContent')
                        </button>
                        <button type="button" class="btn btn-warning btn-icon btn-sm mx-2 media_upload_related_btn d-none"
                            onclick="openDropZoneModal(this)" data-type="contentRow_media" data-id="noid">
                            <i class="fas fa-photo-video"></i>
                        </button>
                        <input type="hidden" class="media_upload_related d-none" name="content_media_id" value="noid">
                        <button type="button" class="btn btn-primary btn-icon btn-sm mx-2 resource_upload_related_btn d-none"
                            onclick="openDropZoneModal(this)" data-type="contentRow_resource" data-id="noid">
                            <i class="fas fa-upload"></i>
                        </button>
                        <input type="hidden" class="resource_upload_related d-none" name="content_resource_id" value="noid">
                    </div>
                </div>


                <!-- innner repeater -->
                <div class="inner-repeater">
                    <table class="table table-bordered table-head-custom table-vertical-center media-table">
                        <thead>
                            <tr class="table-head">
                                <th style="min-width: 100px;">@lang('admin.campaigns.impersion_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.reach_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.clicks_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.like_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.share_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.save_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.sticker_tap_cnt')</th>
                                <th style="min-width: 100px;">@lang('admin.campaigns.comment_cnt')</th>
                                <th class="uploadMedia">@lang('admin.campaigns.chooseVideoUrl')</th>
                                <th class="uploadResource">@lang('admin.campaigns.chooseVideoUrl')</th>
                                <th>@lang('admin.campaigns.actions')</th>
                            </tr>
                        </thead>
                        <tbody data-repeater-list="rows">
                            <tr data-repeater-item>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterImpersionCnt',
                                    'name' => 'impersion_cnt',
                                    'classes' => 'form-control-sm'
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterReachCnt',
                                    'name' => 'reach_cnt',
                                    'classes' => 'form-control-sm'
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterClicksCnt',
                                    'name' => 'clicks_cnt',
                                    'classes' => 'form-control-sm'
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterLikeCnt',
                                    'name' => 'like_cnt',
                                    'classes' => 'form-control-sm'
                                    ])
                                </td>

                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterShareCnt',
                                    'name' => 'share_cnt',
                                    'classes' => 'form-control-sm'
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterSaveCnt',
                                    'name' => 'save_cnt',
                                    'classes' => 'form-control-sm'
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterStickerTapCnt',
                                    'name' => 'sticker_tap_cnt',
                                    'classes' => 'form-control-sm'
                                    ])
                                </td>
                                <td>
                                    @include('components.form.simpleInput', [
                                    'type' => 'number',
                                    'placeholder' => 'admin.campaigns.enterCommentCnt',
                                    'name' => 'comment_cnt',
                                    'classes' => 'form-control-sm'
                                    ])
                                </td>
                                <td class="uploadMedia">
                                    <button type="button" class="btn btn-warning btn-icon btn-sm"
                                        onclick="openDropZoneModal(this)" data-type="contentRow_media" data-id="noid">
                                        <i class="fas fa-photo-video"></i>
                                    </button>
                                    <input type="hidden" name="contentRow_media_id" value="noid">
                                </td>
                                <td class="uploadResource">
                                    <button type="button" class="btn btn-primary btn-icon btn-sm"
                                        onclick="openDropZoneModal(this)" data-type="contentRow_resource"
                                        data-id="noid">
                                        <i class="fas fa-upload"></i>
                                    </button>
                                    <input type="hidden" name="contentRow_resource_id" value="noid">
                                </td>
                                <td>
                                    <button data-repeater-delete type="button" value="Delete"
                                        class="btn btn-outline-danger btn-sm btn-icon">
                                        <i class="flaticon-delete"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button data-repeater-create type="button" class="btn btn-outline-success btn-sm mr-3">
                        <i class="flaticon-add-circular-button"></i>
                        @lang('admin.campaigns.addRow')
                    </button>
                </div>

            </div>
            @endif
        </div>
        <button data-repeater-create type="button" class="btn btn-success btn-sm mr-3">
            <i class="flaticon-add"></i>
            @lang('admin.campaigns.addContent')
        </button>
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
<script type="text/javascript" src="{{asset('assets/plugins/custom/datepicker/persian-datepicker.min.js')}}">
</script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
    function uploadMediaState(thisObj) {
        var index = $(thisObj).index('.media-checkbox')
        if($(thisObj).prop('checked')) {
            $('.media-table:eq('+index+')').removeClass('hide-media').addClass('hide-media');
            $('.media_upload_related_btn:eq('+index+')').removeClass('d-none');
            $('.media_upload_related:eq('+index+')').removeClass('d-none');
        } else {
            $('.media-table:eq('+index+')').removeClass('hide-media');
            $('.media_upload_related_btn:eq('+index+')').addClass('d-none');
            $('.media_upload_related:eq('+index+')').addClass('d-none');
        }
    }

    function uploadResourceState(thisObj) {
        var index = $(thisObj).index('.resource-checkbox')
        if($(thisObj).prop('checked')) {
            $('.media-table:eq('+index+')').removeClass('hide-resource').addClass('hide-resource');
            $('.resource_upload_related_btn:eq('+index+')').removeClass('d-none');
            $('.resource_upload_related:eq('+index+')').removeClass('d-none');
        } else {
            $('.media-table:eq('+index+')').removeClass('hide-resource');
            $('.resource_upload_related_btn:eq('+index+')').addClass('d-none');
            $('.resource_upload_related:eq('+index+')').addClass('d-none');
        }
    }

    $(document).ready(function () {

        $('.repeater').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
            show: function () {
                $(".m_selectpicker").selectpicker('refresh');
                $(this).slideDown();
            },
            repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater',
                isFirstItemUndeletable: true
            }],
            isFirstItemUndeletable: true,
        });
    });

    jQuery(document).ready(function () {

        {{--  $("#m_repeater_1").repeater({
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
        });  --}}

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
