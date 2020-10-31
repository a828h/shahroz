<?php

if (!function_exists('simpleBadge')) {
    function simpleBadge($value, $options = [])
    {
        $state = $options[$value]['state'] ?? '';
        $text = $options[$value]['text'] ?? $value;
        return "<span class='label label-lg label-light-{$state} label-inline'>{$text}</span>";
    }
}

if (!function_exists('dotetBadge')) {
    function dotetBadge($value, $options = [])
    {
        $state = $options[$value]['state'] ?? '';
        $text = $options[$value]['text'] ?? $value;

        return "<span class='label label-{$state} label-dot mr-2'></span>&nbsp;
        <span class='font-weight-bold text-{$state}'>{$text}</span>";
    }
}

if (!function_exists('convertToFa')) {
    function convertToFa($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $num = range(0, 9);
        $englishNumbersOnly = str_replace($num, $persian, $string);
        return $englishNumbersOnly;
    }
}