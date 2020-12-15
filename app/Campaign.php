<?php

namespace App;

use App\ModelHelp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\CalendarUtils;

class Campaign extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desc', 'platform', 'status', 'impersion_cnt', 'reach_cnt', 'clicks_cnt', 'like_cnt',
        'share_cnt', 'save_cnt', 'sticker_tap_cnt', 'comment_cnt', 'cost', 'start_at', 'end_at', 'resource_type','executor_id','hunter_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function brands() {
        return $this->belongsToMany(Brand::class);
    }

    public function contents() {
        return $this->hasMany(Content::class);
    }

    public function contentPublishers() {
        return $this->hasManyThrough(
            Content::class,
            ContentPublisher::class,
            'content_id',
            'campaign_id',
            'id',
            'id'
        );
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable')->where('type','campaign_media');;
    }

    public function contentRows() {
        return $this->hasManyThrough(
            Content::class,
            ContentRow::class,
            'campaign_id',
            'content_id',
            'id',
            'id'
        );
    }

    public function hunter(){
        return $this->belongsTo(User::class,"hunter_id");
    }


    public function scopeSearch($query, $search)
    {
        if(!$search) return $query;
        return $query->where(function($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        });
    }

    public function scopeStatusIs($query, $status)
    {
        if(!$status) return $query;
        return $query->where('status', $status);
    }

    public function scopePlatformIs($query, $platform)
    {
        if(!$platform) return $query;
        return $query->where('platform', $platform);
    }

    public function scopeCategoryIn($query, $categories)
    {
        if(!$categories || count($categories) === 0) return $query;
        return $query->whereHas('categories', function($q) use ($categories){
            $q->whereIn('category_id', $categories);
        });
    }

    public function scopeBrandIn($query, $brands)
    {
        if(!$brands || count($brands) === 0) return $query;
        return $query->whereHas('brands', function($q) use ($brands){
            $q->whereIn('brand_id', $brands);
        });
    }

    public function setStartAtAttribute($date)
    {
        $date = CalendarUtils::convertNumbers($date, true);
        $this->attributes['start_at'] = $date <= '1500/01/01 00:00:00' ? CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $date)->format('Y-m-d H:i:s') : str_replace('/', '-', $date);
    }

    public function getStartAtFaAttribute()
    {
        $newDate = CalendarUtils::strftime('Y/m/d', strtotime($this->start_at));
        return CalendarUtils::convertNumbers($newDate);
    }

    public function setEndAtAttribute($date)
    {
        $date = CalendarUtils::convertNumbers($date, true);
        $this->attributes['end_at'] = $date <= '1500/01/01 00:00:00' ? CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $date)->format('Y-m-d H:i:s') : str_replace('/', '-', $date);
    }

    public function getEndAtFaAttribute()
    {
        $newDate = CalendarUtils::strftime('Y/m/d', strtotime($this->end_at));
        return CalendarUtils::convertNumbers($newDate);
    }
}
