@php
    $trClass = '';
    if(isset($parentType)) {
        $trClass = $parentType === 'type1' ? 'row-type-1' : $trClass;
        $trClass = $parentType === 'type2' ? 'row-type-2' : $trClass;
    }
@endphp
<tr id="{{ $id ?? ''}}" data-number="{{$number ?? ''}}" child-node-count="{{($childCount ?? 0) - 1 }}" class="{{$trClass}}">
    @if(isset($root) && $root)
        <td style="padding: 2px" rowspan="{{isset($childCount) ? $childCount : 1}}">
            {!! Form::select(isset($number) && isset($index) ? "content[$number][$index][publishers][]" :'publishers[]', $publishers, isset($row['publishers']) ? $row['publishers'] : [], ['class' =>
            'form-control form-control-sm m-bootstrap-select m-bootstrap-select-table '. (isset($root) && $root && !isset($disableSelect) ? ' enableSelectClass ' : '') .'
            m_selectpicker'.($id ?? ''), 'title' => __('admin.campaigns.choosePublisher'), "data-boundary"=>"window",
            'data-live-search'=>"true", 'multiple' => 'true', "data-selected-text-format"=>"count > 3", "multiple
            data-actions-box"=>"true"
            ]) !!}
        </td>
    @endif
    <td style="padding: 2px">
        @if(isset($root) && $root)
            <input type="hidden" name='{{isset($number) && isset($index) ? "content[$number][$index][contentType]" : "contentType"}}' value="{{$type ?? 'normal'}}" />
        @endif
        {!! Form::input('number', isset($number) && isset($index) ? "content[$number][$index][impersion_cnt]" : 'impersion_cnt', isset($row['impersion_cnt']) ? $row['impersion_cnt'] : null, ['class'
        => "form-control form-control-sm", 'placeholder' => __('admin.campaigns.enterImpersionCnt')]) !!}
    </td>
    <td style="padding: 2px">
        {!! Form::input('number', isset($number) && isset($index) ? "content[$number][$index][reach_cnt]":'reach_cnt', isset($row['reach_cnt']) ? $row['reach_cnt'] : null, ['class' =>
        "form-control form-control-sm",
        'placeholder' =>
        __('admin.campaigns.enterReachCnt')]) !!}
    </td>
    <td style="padding: 2px">
        {!! Form::input('number', isset($number) && isset($index)  ? "content[$number][$index][clicks_cnt]" :'clicks_cnt', isset($row['clicks_cnt']) ? $row['clicks_cnt'] : null, ['class' =>
        "form-control form-control-sm",
        'placeholder' =>
        __('admin.campaigns.enterClicksCnt')]) !!}
    </td>
    <td style="padding: 2px">
        {!! Form::input('number', isset($number) && isset($index) ? "content[$number][$index][like_cnt]":'like_cnt', isset($row['like_cnt']) ? $row['like_cnt'] : null, ['class' =>
        "form-control form-control-sm",
        'placeholder' =>
        __('admin.campaigns.enterLikeCnt')]) !!}
    </td>
    <td style="padding: 2px">
        {!! Form::input('number', isset($number) && isset($index) ? "content[$number][$index][share_cnt]" :'share_cnt', isset($row['share_cnt']) ? $row['share_cnt'] : null, ['class' =>
        "form-control form-control-sm",
        'placeholder' =>
        __('admin.campaigns.enterShareCnt')]) !!}
    </td>
    <td style="padding: 2px">
        {!! Form::input('number', isset($number) && isset($index) ? "content[$number][$index][save_cnt]" :'save_cnt', isset($row['save_cnt']) ? $row['save_cnt'] : null, ['class' =>
        "form-control form-control-sm",
        'placeholder' =>
        __('admin.campaigns.enterSaveCnt')]) !!}
    </td>
    <td style="padding: 2px">
        {!! Form::input('number', isset($number) && isset($index) ? "content[$number][$index][sticker_tap_cnt]" :'sticker_tap_cnt', isset($row['sticker_tap_cnt']) ? $row['sticker_tap_cnt'] : null,
        ['class' => "form-control
        form-control-sm", 'placeholder' =>
        __('admin.campaigns.enterStickerTapCnt')]) !!}
    </td>
    <td style="padding: 2px">
        {!! Form::input('number', isset($number) && isset($index) ? "content[$number][$index][comment_cnt]" :'comment_cnt', isset($row['comment_cnt']) ? $row['comment_cnt'] : null, ['class' =>
        "form-control form-control-sm",
        'placeholder' =>
        __('admin.campaigns.enterCommentCnt')]) !!}
    </td>
    @if(isset($root) && $root)
        <td style="padding: 2px" rowspan="{{isset($childCount) ? $childCount : 1}}">
            {!! Form::select(isset($number) && isset($index) ? "content[$number][$index][type]" :'type', ['impression' => __('admin.campaigns.types.impression'), 'fix' =>
            __('admin.campaigns.types.fix')], isset($row['type']) ? $row['type'] : null, ['class' => 'form-control
            form-control-sm' .  (isset($root) && $root && !isset($disableSelect) ? ' enableSelectClass ' : '') .
            'm-bootstrap-select m_selectpicker'.($id ?? '')]) !!}
        </td>
        <td style="padding: 2px" rowspan="{{isset($childCount) ? $childCount : 1}}">
            {!! Form::input('number', isset($number) && isset($index) ? "content[$number][$index][our_cost]" :'our_cost', isset($row['our_cost']) ? $row['our_cost'] : null, ['class' =>
            "form-control form-control-sm",
            'placeholder' =>
            __('admin.campaigns.enterOurCost')]) !!}
        </td>
        <td style="padding: 2px" rowspan="{{isset($childCount) ? $childCount : 1}}">
            {!! Form::input('number', isset($number) && isset($index) ? "content[$number][$index][customer_cost]" :'customer_cost', isset($row['customer_cost']) ? $row['customer_cost'] : null, ['class'
            => "form-control form-control-sm",
            'placeholder' =>
            __('admin.campaigns.enterCustomerCost')]) !!}
        </td>
    @endif
    @if((isset($root) && $root && (!isset($type) || (isset($type) && $type !== 'type2'))) || (isset($parentType) && $parentType === 'type1'))
        <td x="{{($parentType ?? '') . ' ' . ($type ?? '')}}">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <button type="button" class="btn btn-primary  btn-icon" onclick="openDropZoneModal(this)" data-type="contentRow_resource" data-id="{{$row['id'] ?? 'noid'}}">
                    <i class="fas fa-upload"></i>
                </button>
                <input type="hidden" name="contentRow_resource_id" value="{{$row['id'] ?? 'noid'}}">

                <button type="button" class="btn btn-warning btn-icon" style="border-top-left-radius: 5px; border-bottom-left-radius: 5px" onclick="openDropZoneModal(this)" data-type="contentRow_media" data-id="{{$row['id'] ?? 'noid'}}">
                    <i class="fas fa-photo-video"></i>
                </button>
                <input type="hidden" name="contentRow_media_id" value="{{$row['id'] ?? 'noid'}}">
            </div>

        </td>
    @elseif((isset($root) && $root) && (isset($type) && $type === 'type2'))
        <td rowspan="{{isset($childCount) ? $childCount : 1}}">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <button type="button" class="btn btn-primary  btn-icon" onclick="openDropZoneModal(this)" data-type="contentRow_resource" data-id="{{$row['id'] ?? 'noid'}}">
                    <i class="fas fa-upload"></i>
                </button>
                <input type="hidden" name="contentRow_resource_id" value="{{$row['id'] ?? 'noid'}}">

                <button type="button" class="btn btn-warning btn-icon" style="border-top-left-radius: 5px; border-bottom-left-radius: 5px" onclick="openDropZoneModal(this)" data-type="contentRow_media" data-id="{{$row['id'] ?? 'noid'}}">
                    <i class="fas fa-photo-video"></i>
                </button>
                <input type="hidden" name="contentRow_media_id" value="{{$row['id'] ?? 'noid'}}">
            </div>
        </td>
    @endif
    @if(isset($root) && $root)
        <td style="padding: 2px" rowspan="{{isset($childCount) ? $childCount : 1}}">
            <div class="dropdown dropdown-inline">
                <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" data-boundary="window">
                    <i class="ki ki-bold-more-ver"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-sm" style="">
                    <span class="dropdown-item" onclick="addARow()">
                        <Act></Act>@lang('admin.campaigns.addNewRow')
                    </span>
                    @if(!isset($type) || $type === 'normal' || $type === 'type1')
                        <span class="dropdown-item" onclick="addARowSamePublisher(this)">
                            <Act></Act>@lang('admin.campaigns.addNewRowMultuPublisher')
                        </span>
                    @endif
                    @if(!isset($type) || $type === 'normal' || $type === 'type2')
                        <span class="dropdown-item" onclick="addARowSamePublisherAndDocument(this)">
                            <Act></Act>@lang('admin.campaigns.addNewRowMultuDocument')
                        </span>
                    @endif
                    @if(!isset($type) || $type === 'normal' || $type === 'type1')
                        <span class="dropdown-item" onclick="removeRow(this)">
                            <Act></Act>@lang('admin.campaigns.removeSingleRow')
                        </span>
                    @endif
                    @if(!isset($type) || $type === 'normal' || $type === 'type2')
                        <span class="dropdown-item" onclick="removeRowType2(this)">
                            <Act></Act>@lang('admin.campaigns.removeSingleRowMultiDoc')
                        </span>
                    @endif
                </div>
            </div>
        </td>
    @endif
</tr>
