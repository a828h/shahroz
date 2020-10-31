<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentPublisher extends Model
{
    protected $table = 'content_publisher';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content_id', 'publisher_id'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
