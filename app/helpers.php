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

 function getPath($document) {
    switch($document->server) {
        case 'local':
            return asset($document->path);
        case 'ftp':
            return 'https://reports.ad-viceagency.com/?path=' . $document->path . '&hash='.sha1(md5('amir'.$document->path.'amir'));
        default:
            return strpos('http://',$document->path) ? $document->path : str_replace('http:/','http://',$document->path);

    }
}

if (!function_exists('mediaDocuments')) {
    function mediaDocuments($row)
    {
        $res = [];
        $docs = $row->contentMedias;
        if($docs && count($docs)) {
            foreach($docs AS $doc) {
                $res[] = getPath($doc);
            }
        }

        return implode('$|$|$', $res);
    }
}
