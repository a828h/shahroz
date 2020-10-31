<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'platform', 'link', 'data', 'impersion_cost', 'our_cost', 'dealer_cost', 'customer_cost', 'type',
        'admin_id', 'real_id', 'image_url', 'status'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function campaigns() {
        return $this->belongsToMany(Campaign::class);
    }

    public function scopeSearch($query, $search)
    {
        if(!$search) return $query; 
        return $query->where(function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        });
    }

    public function scopePlatformIs($query, $platform)
    {
        if(!$platform) return $query; 
        return $query->where('platform', $platform);
    }
}
