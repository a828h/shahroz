<?php

namespace App\Jobs;

use App\CampaignPublisher;
use App\Document;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class uploadDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $document;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function file_get_contents_curl( $url ) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if($this->document->server === 'bot') {
                $imgUrl = $this->document->path;
                if (!(strpos($imgUrl, 'http://') || strpos($imgUrl, 'https://'))) {
                    $imgUrl = str_replace('http:/', 'http://', $imgUrl);
                }
                $contents = $this->file_get_contents_curl($imgUrl);
                $name = substr($imgUrl, strrpos($imgUrl, '/') + 1);
                $mainPath = "images" . "/$name";
                $path = "public_html/reports/$mainPath";

                Storage::disk('FTP')->put($path, $contents, 'public');

                $mimetype = Storage::disk('FTP')->mimeType($path);
                $size = Storage::disk('FTP')->size($path);


                if ($mimetype) {
                   $this->document->update([
                    'name' => $name,
                    'path' => $mainPath,
                    'file_type' => explode('/', $mimetype)[0],
                    'mimtype' => $mimetype,
                    'extention' => '',
                    'size' => $size,
                    'status' => 'attached',
                    'server' => 'ftp',
                   ]);
                }
            } else if($this->document->server === 'local') {

            }

        } catch (Exception $e) {
            Log::info($e);
            dd('error');
        }
    }
}
