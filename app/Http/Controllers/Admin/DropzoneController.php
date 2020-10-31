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

    function upload(Request $request, string $type, string $id)
    {
        $image = $request->file('file');
        $ext = $image->extension();
        $mimType = $image->getMimeType();
        $size = $image->getSize();
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        //$image->getSize()
        if(is_numeric($id)) {
            if($type === 'campaign'){
                $documentableType = Campaign::class;
            } else if($type === 'contentRow_resource' || $type === 'contentRow_media') {
                $documentableType = ContentRow::class;
            }  else if($type === 'content_resource' || $type === 'content_media') {
                $documentableType = Content::class;
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
                $documents = Document::where('documentable_type', 'App\Campaign')->where('documentable_id', $id)->get();

                foreach($documents AS $document) {
                    $response[] = [
                        'name' => $document->name,
                        'size' => $document->size,
                        'path' => $document->server === 'local' ? asset($document->path) : $document->path
                    ];
                }
            } else if($type === 'contentRow_resource' || $type === 'contentRow_media'){
                $documents = Document::where('documentable_type', 'App\ContentRow')->where('documentable_id', $id)
                ->where('type', $type)->get();

                foreach($documents AS $document) {
                    $response[] = [
                        'name' => $document->name,
                        'size' => $document->size,
                        'path' => $document->server === 'local' ? asset($document->path) : $document->path
                    ];
                }
            }  else if($type === 'content_resource' || $type === 'content_media'){
                $documents = Document::where('documentable_type', 'App\Http\Controllers\Admin\Content')->where('documentable_id', $id)
                ->where('type', $type)->get();

                foreach($documents AS $document) {
                    $response[] = [
                        'name' => $document->name,
                        'size' => $document->size,
                        'path' => $document->server === 'local' ? asset($document->path) : $document->path
                    ];
                }
            }
        } else {
            $documents = Document::where('temp_id', $id)->get();
            foreach($documents AS $document) {
                $response[] = [
                    'name' => $document->name,
                    'size' => $document->size,
                    'path' => $document->server === 'local' ? asset($document->path) : $document->path
                ];
            }
        }
        return response()->json($response);
    }

    function delete(Request $request)
    {
        if ($request->get('name')) {
            \File::delete(public_path('images/' . $request->get('name')));
        }
    }
}
