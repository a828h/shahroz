<?php

namespace App\Exports;

use App\Campaign;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CampaignExport implements FromView
{

    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function view(): View
    {
        return view($this->campaign->platform == 'telegram' ? 'client.exports.campaignTelegram' : 'client.exports.campaignInstagram', [
            'campaign' => $this->campaign
        ]);
    }
}
