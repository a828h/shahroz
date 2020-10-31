@php
$label = "$scope.$name";
$pluralName = Str::plural($name);
$optionLabelBase = "$scope.$pluralName";
@endphp
<div class="col-lg-6">
    <label>@lang($label):</label>
    <label>@lang("$optionLabelBase.$value")</label>
</div>