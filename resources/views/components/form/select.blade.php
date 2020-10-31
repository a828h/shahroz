@php
$pluralName = Str::plural($name);
if(isset($scope)) {
    $label = "$scope.$name";
    $placeholder = $scope . '.' . Str::camel("choose_$name");
    $optionLabelBase = "$scope.$pluralName";
    if(isset($options)){
        $makedOptions = [];
        foreach($options AS $option) {
        $makedOptions[$option] = __("$optionLabelBase.$option");
        }
    }
}

$simpleName = substr($name, 0, -2);
$hasError = $errors->has($errorName ?? $name);
$noError = $noError ?? false;
if(!empty($customError)) {
    $noError = false;
    $hasError = true;
}

$size = $size ?? 'col-lg col-md';
@endphp
<div class="{{$size}} {{!$noError && $hasError ? 'has-danger' : ''}}">
    @isset($label)<label>@lang($label ?? ''):</label>@endisset
    {!! Form::select($name, $makedOptions ?? $staticOptions, $value ?? null, array_merge(['class' => !$noError && $hasError ? 'form-control m-bootstrap-select m_selectpicker is-invalid' : 'form-control m-bootstrap-select m_selectpicker',
    'title' => __($placeholder ?? '')], $extra ?? [])) !!}
    @if(!$noError && $hasError)
    <div class="invalid-feedback" role="alert">
        <strong>{{ $errors->first($name) }}</strong>
    </div>
    @endif
    @if(!empty($customError))
        <div class="invalid-feedback" role="alert">
            <strong>{{ $customError }}</strong>
        </div>
    @endif
</div>


@section('scripts')
@parent
<script>
    var BootstrapSelect = {
            init: function () {
                $(".m_selectpicker").selectpicker();
            },
        };
        jQuery(document).ready(function () {
            BootstrapSelect.init();
        });
</script>
@endsection
