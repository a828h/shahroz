<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    protected $table = 'contents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id', 'impersion_cnt', 'reach_cnt', 'clicks_cnt', 'like_cnt', 'share_cnt', 'save_cnt',
        'sticker_tap_cnt', 'comment_cnt', 'type', 'our_cost', 'dealer_cost', 'customer_cost', 'media_type', 'resource_type'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function contentPublishers()
    {
        return $this->hasMany(ContentPublisher::class);
    }

    public function contentRows()
    {
        return $this->hasMany(ContentRow::class);
    }

    public function publishersInstance()
    {
        return $this->belongsToMany(Publisher::class, 'content_publisher', 'content_id', 'publisher_id');
    }

    public function getPublishersAttribute(){
        return $this->contentPublishers->pluck('publisher_id');
    }


    public function resource()
    {
        return $this->morphMany(Document::class, 'documentable')->where('type','resource');
    }

    public function contentMedias()
    {
        return $this->morphMany(Document::class, 'documentable')->where('type','content_media');
    }
}
