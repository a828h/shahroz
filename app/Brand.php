<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }

    public function scopeSearch($query, $search)
    {
        if (!$search) return $query;
        return $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        });
    }

    public function scopeCategoryIn($query, $categories)
    {
        if(!$categories || count($categories) === 0) return $query; 
        return $query->whereIn('category_id', $categories);
    }
}
