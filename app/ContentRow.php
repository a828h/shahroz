<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentRow extends Model
{
    protected $table = 'content_row';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content_id', 'impersion_cnt', 'reach_cnt', 'clicks_cnt', 'like_cnt', 'share_cnt', 'save_cnt',
        'sticker_tap_cnt', 'comment_cnt'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function resource()
    {
        return $this->morphMany(Document::class, 'documentable')->where('type','contentRow_resource');
    }

    public function contentMedias()
    {
        return $this->morphMany(Document::class, 'documentable')->where('type','contentRow_media');
    }
}
