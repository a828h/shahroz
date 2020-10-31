<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'slug', 'priority'
    ];

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function scopeSearch($query, $search)
    {
        if (!$search) return $query;
        return $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('slug', 'like', "%$search%");
        });
    }
}
