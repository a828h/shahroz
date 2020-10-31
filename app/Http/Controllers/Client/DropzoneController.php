<?php

namespace App\Http\Controllers\Client;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DropzoneController extends Controller
{

    function fetch(string $type, string $id)
    {
        $response = [];
        if(is_numeric($id)) {
            if($type === 'campaign') {
                $documents = Document::where('documentable_type', 'App\Campaign')->where('documentable_id', $id)->get();
            } else if($type === 'contentRow_resource' || $type === 'contentRow_media'){
                $documents = Document::where('documentable_type', 'App\ContentRow')->where('documentable_id', $id)
                ->where('type', $type)->get();
            } else if($type === 'content_resource' || $type === 'content_media'){
                $documents = Document::where('documentable_type', 'App\Http\Controllers\Admin\Content')->where('documentable_id', $id)
                ->where('type', $type)->get();
            }
        } else {
            $documents = Document::where('temp_id', $id)->get();
        }

        foreach($documents AS $document) {
            $pathArr = explode('.', $document->path);
            if($document->file_type === 'video' || $pathArr[count($pathArr) - 1] === 'mp4') {
                $response[] = [
                    'html' => '<video class="lg-video-object lg-html5" preload="none" controls><source src="'.$this->getPath($document).'#t=0.1" type="video/mp4">Your browser does not support HTML5 video</video>',
                    'name' => $document->name,
                    'alt' => $document->name,
                ];
            } else {
                $response[] = [
                    'name' => $document->name,
                    'src' => $this->getPath($document),
                ];
            }

        }
        return response()->json($response);
    }

    private function getPath($document) {
        switch($document->server) {
            case 'local':
                return asset($document->path);
            case 'ftp':
                return 'https://reports.ad-viceagency.com/?path=' . $document->path . '&hash='.sha1(md5('amir'.$document->path.'amir'));
            default:
                return strpos('http://',$document->path) ? $document->path : str_replace('http:/','http://',$document->path);

        }
    }
}
