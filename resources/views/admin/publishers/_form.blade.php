<div class="card-body">
    <div class="form-group row validated">
        @include('components.form.input', ['scope' => 'admin.publishers', 'name' => 'name'])
        @include('components.form.inputIcon', ['scope' => 'admin.publishers', 'name' => 'link', 'icon' => 'la la-url'])
    </div>
    <div class="form-group row validated">
        @include('components.form.input', ['scope' => 'admin.publishers', 'name' => 'admin_id'])
        @include('components.form.input', ['scope' => 'admin.publishers', 'name' => 'real_id'])
    </div>
    <div class="form-group row validated">
        @include('components.form.radioGroup', ['scope' => 'admin.publishers', 'name' => 'platform', 'options' =>
        ['telegram', 'instagram']])
        @include('components.form.radioGroup', ['scope' => 'admin.publishers', 'name' => 'status', 'options' =>
        ['new', 'active', 'inactive']])
    </div>
    <div class="form-group row validated">
        @include('components.form.radioGroup', ['scope' => 'admin.publishers', 'name' => 'type',
        'options' => ['impression', 'fix']])
        @include('components.form.input', ['scope' => 'admin.publishers', 'name' => 'impersion_cost',
        'type'=>"number"])

    </div>
    <div class="form-group row validated">
        @include('components.form.input', ['scope' => 'admin.publishers', 'name' => 'our_cost',
        'type'=>"number"])
        @include('components.form.input', ['scope' => 'admin.publishers', 'name' => 'customer_cost',
        'type'=>"number"])
    </div>
    <div class="form-group row validated">
        <div class="col-lg col-md">
            <div class="input-group">
                <span class="input-group-btn">
                    <a data-input="thumbnail" data-preview="holder" class="btn btn-secondary lfm">
                        <i class="fa fa-picture-o"></i> @lang('admin.publishers.chooseImageUrl')
                    </a>
                </span>
                {!! Form::input('text', 'image_url', null, ['class' =>
                "form-control", 'id'=>"thumbnail", 'placeholder' => __('admin.publishers.enterImageUrl'
                )]) !!}
            </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
        </div>
        <div class="col-lg-6 col-md-6"></div>
    </div>
</div>

@section('scripts')
@parent
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
    jQuery(document).ready(function () {
        $('.lfm').filemanager('file');   
    }); 
</script>
@endsection