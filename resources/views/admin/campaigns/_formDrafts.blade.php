<div class="card-body">
    <input type="hidden" name="status" value="draft">
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
        $categories, 'extra' => ['data-live-search'=>"true", 'multiple' => 'true', "data-selected-text-format"=>"count > 3",
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
        <div class="col-lg col-md">
            <label for="exampleInputEmail1">@lang('admin.campaigns.uploadExcel')</label>
            <div></div>
            <div class="custom-file">
                <input type="file" name="excel_file" class="custom-file-input" id="customFile">
                <label class="custom-file-label selected"
                    for="customFile"></label>
            </div>
        </div>
    </div>
    <div class="form-group row validated">
        @include('components.form.radioGroup', ['scope' => 'admin.campaigns', 'name' => 'resource_type', 'options' =>
        ['none', 'campaign', 'content', 'all']])
        <div class="col">
            <button type="button" class="btn btn-primary" onclick="openDropZoneModal(this)" data-type="campaign" data-id="noid">
                @lang('admin.campaigns.uploadResource')
            </button>
            <input type="hidden" name="document_campaign_unique_id" value="noid">
        </div>
    </div>
</div>
@section('styles')
@parent
    <link rel="stylesheet" href="{{asset('assets/plugins/custom/datepicker/persian-datepicker.min.css')}}" type="text/css"/>
@endsection

@section('scripts')
@parent
<script type="text/javascript" src="{{asset('assets/plugins/custom/datepicker/persian-date.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/custom/datepicker/persian-datepicker.min.js')}}"></script>
<script>
    jQuery(document).ready(function () {
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
