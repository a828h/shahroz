@php
if(isset($scope)) {
if(!isset($label)){
$label = "$scope.$name";
}

if(!isset($placeholder)){
$placeholder = $scope . '.' . Str::camel("enter_$name");
}
}
$type = $type ?? 'text';
$hasError = $errors->has($errorName ?? $name);
$noError = $noError ?? false;
if(!empty($customError)) {
    $noError = false;
    $hasError = true;
}
$size = $size ?? 'col-lg col-md';
$classes = $classes ?? '';
$readonly = $readonly ?? false;
@endphp
<div class="{{$size}} {{!$noError && $hasError ? 'has-danger' : ''}}">
    @isset($label)<label>@lang($label ?? ''):</label>@endisset
    {!! Form::input($type, $name, $value ?? null, ['class' => !$noError && $hasError ? "form-control is-invalid $classes" :
    "form-control $classes",
    'placeholder' => __($placeholder ?? ''), 'readonly'=> $readonly]) !!}
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
