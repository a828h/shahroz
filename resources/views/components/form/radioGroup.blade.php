@php
if(!isset($label)){
$label = "$scope.$name";
}

if(!isset($placeholder)){
$placeholder = $scope . '.' . Str::camel("choose_$name");
}
$pluralName = Str::plural($name);
$optionLabelBase = "$scope.$pluralName";
$hasError = $errors->has($name);

@endphp
<div class="col-lg col-md {{$hasError ? 'has-danger' : ''}}">
    <label>@lang($label):</label>
    <div class="radio-inline">
        @isset($staticOptions)
        @foreach ($staticOptions as $key => $labelOption)
        <label class="radio radio-solid">
            @isset($value)
                @php
                $checkedArr = [];
                $checkedArr = $key === ($value ?? '') ? ['checked' => 'checked'] : [];
                @endphp
                
                {!! Form::radio($name, $key, null, $checkedArr) !!}
            @else
            {!! Form::radio($name, $key) !!}
            @endisset
            {{$labelOption}}
            <span></span>
            <span></span>
        </label>
        @endforeach
        @else
        @foreach ($options as $option)
        <label class="radio radio-solid">
            @isset($value)
            @php
            $checkedArr = $option == ($value ?? '') ? ['checked' => 'checked'] : [];
            @endphp
            {!! Form::radio($name, $option, null, $checkedArr) !!}
            @else
            {!! Form::radio($name, $option) !!}
            @endisset
            @lang("$optionLabelBase.$option")
            <span></span>
        </label>
        @endforeach
        @endisset
    </div>
    @if($hasError)
    <div class="invalid-feedback" role="alert">
        <strong>{{ $errors->first($name) }}</strong>
    </div>
    @else
    <span class="form-text text-muted">@lang($placeholder)</span>
    @endif
</div>