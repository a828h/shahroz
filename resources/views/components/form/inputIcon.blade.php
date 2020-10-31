@php
$type = $type ?? 'text';
if(!isset($label)){
$label = "$scope.$name";
}

if(!isset($placeholder)){
$placeholder = $scope . '.' . Str::camel("enter_$name");
}

$hasError = $errors->has($name);
$size = $size ?? 'col-lg col-md';
@endphp
<div class="{{$size}} {{$hasError ? 'is-invalid' : ''}}">
    <label>@lang($label):</label>
    <div class="input-group">
        {!! Form::input($type, $name, $value ?? null, ['class' => $hasError ? 'form-control is-invalid' : 'form-control', 'placeholder' =>
        __($placeholder)]) !!}
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="{{$icon}}"></i>
            </span>
        </div>
    </div>
    @if($hasError)
    <div class="invalid-feedback" role="alert">
        <strong>{{ $errors->first($name) }}</strong>
    </div>
    @endif
</div>