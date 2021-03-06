<?php

namespace App\Imports;

use App\Campaign;
use App\Document;
use App\Jobs\uploadDocument;
use App\Publisher;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Image;


class CampaignPublisherInstagramImport implements ToCollection
{
    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function collection(Collection $rows)
    {
        $sheetType = '';
        if ($rows[0][0] === 'Page' && $rows[0][1] === 'Admin Id') {
            $sheetType = 2;
        } else if ($rows[0][0] === 'Page' && $rows[0][1] === 'Impression') {
            $sheetType = 1;
        }

        $campaignMetaData = [
            'impersion_cnt' => 0,
            'like_cnt' => 0,
            'reach_cnt' => 0,
            'clicks_cnt' => 0,
            'share_cnt' => 0,
            'save_cnt' => 0,
            'sticker_tap_cnt' => 0,
            'comment_cnt' => 0,
        ];
        $content = null;
        $contentData = [
            "impersion_cnt" => 0,
            "reach_cnt" => 0,
            "clicks_cnt" => 0,
            "like_cnt" => 0,
            "share_cnt" => 0,
            "save_cnt" => 0,
            "sticker_tap_cnt" => 0,
            "comment_cnt" => 0,
            "our_cost" => 0,
            "customer_cost" => 0,
        ];

        $data = [];
        $contents = [];
        $documents = [];
        $jobDocuments = [];

        foreach ($rows as $index => $row) {
            if (!(empty($row['0']) || $row['0'] === 'Page' || $row['0'] === 'page')) {
                if ($sheetType === 1) {
                    $data[] = [
                        'publishers' => explode('$|$|$', trim($row[0])),
                        'impersion_cnt' => $row[1] ?? 0,
                        'reach_cnt' => $row[2] ?? 0,
                        'clicks_cnt' => $row[3] ?? 0,
                        'like_cnt' => $row[6] ?? 0,
                        'share_cnt' => $row[5] ?? 0,
                        'save_cnt' => $row[8] ?? 0,
                        'sticker_tap_cnt' => $row[4] ?? 0,
                        'comment_cnt' => $row[7] ?? 0,
                        'admin_id' => 'unknown',
                        'documents' => explode('$|$|$', trim($row[9])),
                    ];
                } else if ($sheetType === 2) {
                    $data[] = [
                        'publishers' => explode('$|$|$', trim($row[0])),
                        'admin_id' => trim($row[1]),
                        'impersion_cnt' => $row[2] ?? 0,
                        'reach_cnt' => $row[3] ?? 0,
                        'clicks_cnt' => $row[4] ?? 0,
                        'like_cnt' => $row[7] ?? 0,
                        'share_cnt' => $row[6] ?? 0,
                        'save_cnt' => $row[9] ?? 0,
                        'sticker_tap_cnt' => $row[5] ?? 0,
                        'comment_cnt' => $row[8] ?? 0,
                        'documents' => explode('$|$|$', trim($row[10])),
                    ];
                }
            }
        }
        foreach ($data as $index => $item) {
            if (count($item['publishers']) === 0) {
                $contents[count($contents) - 1]['rows'][] = $item;
            } else {
                $contents[] = [
                    'publishers' => $item['publishers'],
                    'rows' => [$item],
                ];
            }
        }

        foreach ($contents as $index => $content) {
            $documents = [];
            foreach ($content['rows'] as $row) {
                if (count($row['documents']) !== 0) {
                    $documents[] = $row['documents'];
                }
            }
            if (count($documents) === 1) {
                $contents[$index]['documents'] = $contents[$index]['rows'][0]['documents'];
                $contents[$index]['media_type'] = 'content';
            } else {
                $contents[$index]['media_type'] = 'rows';
            }
        }
        foreach ($contents as $index => $content) {
            $contentData = [
                "impersion_cnt" => 0,
                "reach_cnt" => 0,
                "clicks_cnt" => 0,
                "like_cnt" => 0,
                "share_cnt" => 0,
                "save_cnt" => 0,
                "sticker_tap_cnt" => 0,
                "comment_cnt" => 0,
                "our_cost" => 0,
                "customer_cost" => 0,
            ];

            $contentIns = $this->campaign->contents()->create($contentData);
            $publishers = [];
            foreach ($content['publishers'] as $publisherRow) {
                $publisher = Publisher::where('link', $publisherRow)->first();
                if (!$publisher) {
                    $publisher = Publisher::create([
                        'name' => $publisherRow ?? 'unknown',
                        'platform' => 'instagram',
                        'status' => 'new',
                        'link' => $publisherRow,
                        'data' => [],
                    ]);
                }
                $publishers[] = $publisher;
            }

            foreach ($publishers as $publisherData) {
                $contentIns->contentPublishers()->create(['publisher_id' => $publisherData->id]);
            }
            if (isset($content['media_type']) && $content['media_type'] === 'content') {
                $contentIns->update(['media_type' => 'content']);
                foreach ($content['documents'] as $documentsRow) {

                    if ($documentsRow) {
                        $jobDocuments[] = Document::create([
                            'temp_id' => $contentIns->id,
                            'name' => 'temp_bot',
                            'path' => $documentsRow,
                            'type' => 'content_media',
                            'file_type' => 'image',
                            'mimtype' => '',
                            'extention' => '',
                            'size' => 0,
                            'status' => 'temp',
                            'server' => 'bot',
                            'documentable_type' => 'App\Content',
                            'documentable_id' => $contentIns->id,
                        ]);
                    }
                }
            }

            foreach ($content['rows'] as $row) {
                $contentRow = $contentIns->contentRows()->create([
                    "impersion_cnt" => $row['impersion_cnt'],
                    "reach_cnt" => $row['reach_cnt'],
                    "clicks_cnt" => $row['clicks_cnt'],
                    "sticker_tap_cnt" => $row['sticker_tap_cnt'],
                    "share_cnt" => $row['share_cnt'],
                    "like_cnt" => $row['like_cnt'],
                    "comment_cnt" => $row['comment_cnt'],
                    "save_cnt" => $row['save_cnt'],
                ]);

                $contentData['impersion_cnt'] += $row['impersion_cnt'];
                $contentData['reach_cnt'] += $row['reach_cnt'];
                $contentData['clicks_cnt'] += $row['clicks_cnt'];
                $contentData['like_cnt'] += $row['like_cnt'];
                $contentData['share_cnt'] += $row['share_cnt'];
                $contentData['save_cnt'] += $row['save_cnt'];
                $contentData['sticker_tap_cnt'] += $row['sticker_tap_cnt'];
                $contentData['comment_cnt'] += $row['comment_cnt'];

                if (isset($content['media_type']) && $content['media_type'] === 'rows') {
                    $contentIns->update(['media_type' => 'rows']);
                    foreach ($row['documents'] as $documentsRow) {
                        if ($documentsRow) {
                            $jobDocuments[] = Document::create([
                                'temp_id' => $contentRow->id,
                                'name' => 'temp_bot',
                                'path' => $documentsRow,
                                'type' => 'contentRow_media',
                                'file_type' => 'image',
                                'mimtype' => '',
                                'extention' => '',
                                'size' => 0,
                                'status' => 'temp',
                                'server' => 'bot',
                                'documentable_type' => 'App\ContentRow',
                                'documentable_id' => $contentRow->id,
                            ]);
                        }
                    }
                }
            }

            $campaignMetaData['impersion_cnt'] += $contentData['impersion_cnt'];
            $campaignMetaData['reach_cnt'] += $contentData['reach_cnt'];
            $campaignMetaData['clicks_cnt'] += $contentData['clicks_cnt'];
            $campaignMetaData['like_cnt'] += $contentData['like_cnt'];
            $campaignMetaData['share_cnt'] += $contentData['share_cnt'];
            $campaignMetaData['save_cnt'] += $contentData['save_cnt'];
            $campaignMetaData['sticker_tap_cnt'] += $contentData['sticker_tap_cnt'];
            $campaignMetaData['comment_cnt'] += $contentData['comment_cnt'];

            $contentIns->update($contentData);
        }

        $this->campaign->update($campaignMetaData);

        foreach ($jobDocuments as $document) {
            uploadDocument::dispatch($document);
        }
    }
}
