<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\ContentRow;
use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    function index(string $type, string $id)
    {
        return view('dropzone')->with([
            'type' => $type,
            'id' => $id,
        ]);
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

    function upload(Request $request, string $type, string $id)
    {
        $image = $request->file('file');
        $ext = $image->extension();
        $mimType = $image->getMimeType();
        $size = $image->getSize();
        $imageName = md5($id . '-' .time()) . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        if(is_numeric($id)) {
            if($type === 'campaign'){
                $documentableType = 'App\Campaign';
            } else if($type === 'contentRow_resource' || $type === 'contentRow_media') {
                $documentableType = 'App\ContentRow';
            }  else if($type === 'content_resource' || $type === 'content_media') {
                $documentableType = 'App\Content';
            }
            Document::create([
                'temp_id' => $id,
                'name' => $imageName,
                'path' => 'images/'. $imageName,
                'type' => $type,
                'file_type' => explode('/', $mimType)[0],
                'mimtype' => $mimType,
                'extention' => $ext,
                'size' => $size,
                'status' => 'attached',
                'server' => 'local',
                'documentable_type' => $documentableType,
                'documentable_id' => $id,
            ]);
        } else {
            Document::create([
                'temp_id' => $id,
                'name' => $imageName,
                'path' => 'images/'. $imageName,
                'type' => $type,
                'file_type' => explode('/', $mimType)[0],
                'mimtype' => $mimType,
                'extention' => $ext,
                'size' => $size,
                'status' => 'temp',
                'server' => 'local',
                'documentable_type' => '',
                'documentable_id' => 0,
            ]);
        }
        return response()->json(['success' => $imageName, 'name' => $imageName]);
    }

    function fetch(string $type, string $id)
    {
        $response = [];
        if(is_numeric($id)) {
            if($type === 'campaign') {
                $documents = Document::where('documentable_type', 'App\Campaign')
                    ->where('documentable_id', $id)->get();

            } else if($type === 'contentRow_resource' || $type === 'contentRow_media'){
                $documents = Document::where('documentable_type', 'App\ContentRow')
                    ->where('documentable_id', $id)
                    ->where('type', $type)->get();
            }  else if($type === 'content_resource' || $type === 'content_media'){
                $documents = Document::where('documentable_type', 'App\Content')
                    ->where('documentable_id', $id)
                    ->where('type', $type)->get();
            }
            if(count($documents)) {
                foreach($documents AS $document) {
                    $response[] = [
                        'name' => $document->name,
                        'size' => $document->size,
                        'path' => $this->getPath($document)
                    ];
                }
            }
        } else {
            $documents = Document::where('temp_id', $id)->get();
            foreach($documents AS $document) {
                $response[] = [
                    'name' => $document->name,
                    'size' => $document->size,
                    'path' => $this->getPath($document)
                ];
            }
        }
        return response()->json($response);
    }

    function delete(Request $request)
    {
        if ($request->get('name')) {
            $document = Document::where('name', $request->get('name'))->orderBy('id', 'desc')->first();
            $document->delete();
            \File::delete(public_path('images/' . $request->get('name')));
        }
    }
}
