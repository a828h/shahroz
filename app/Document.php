<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'temp_id', 'name', 'path', 'type', 'file_type', 'mimtype', 'extention', 'status', 'server', 'documentable_type', 'documentable_id', 'size'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }
}
