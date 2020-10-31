<?php

namespace App\Imports;

use App\Campaign;
use App\Publisher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Image;
use Storage;
use UniSharp\LaravelFilemanager\LfmStorageRepository;

class CampaignPublisherTelegramImport implements ToCollection
{
    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function collection(Collection $rows)
    {
        $sum = 0;
        foreach ($rows as $index => $row) {
            if (is_numeric($row[1]) && !empty($row[0])) {
                $sum += $row[1];
                $publisher = Publisher::where('link', $row[0])->first();
                if (!$publisher) {
                    $publisher = Publisher::create([
                        'name' => $row[0],
                        'platform' => 'telegram',
                        'status' => 'new',
                        'link' => $row[0],
                        'data' => [],
                    ]);
                }

                $imgUrl = $row[2];
                try {
                    $urlArr = explode('/', $imgUrl);

                    $image = Image::make($imgUrl);
                } catch (\Exception $e) {
                    $imgUrl = str_replace('http:/', 'http://', $imgUrl);
                    $image = Image::make($imgUrl);
                }

                $ext = $this->getExtention($image);
                $image = $image->encode($ext, 100);
                $filename = uniqid(10) . '_' . $index . '_' . $this->campaign->id;
                $path = "public/files/1". "/$filename.$ext";
                $res = Storage::disk('local')->putFile($path, $image->encode(), 'public');
                $url = config('app.url').Storage::url($path);

                $this->campaign->publishers()->attach($publisher->id, [
                    "video_url" => $res ? $url : '',
                    "impersion_cnt" => $row[1],
                    'insight' => ''
                ]);
            }
        }

        $this->campaign->update(['impersion_cnt' => $sum]);
    }

    private function getExtention($image)
    {
        $mime = $image->mime();  //edited due to updated to 2.x
        if ($mime == 'image/jpeg')
            $extension = 'jpg';
        elseif ($mime == 'image/png')
            $extension = 'png';
        elseif ($mime == 'image/gif')
            $extension = 'gif';
        else
            $extension = '';

        return $extension;
    }
}
