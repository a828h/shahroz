<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'mobile', 'brand', 'role', 'status', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ]; 

    public function campaigns() {
        return $this->belongsToMany(Campaign::class);
    }

    public function activeCampaigns() {
        return $this->belongsToMany(Campaign::class);
    }

    
    public function scopeSearch($query, $search)
    {
        if(!$search) return $query; 
        return $query->where(function($query) use ($search) {
            $query->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', "%$search%")
                  ->orWhere('email', "%$search%")
                  ->orWhere('mobile', "%$search%");
        });
    }

    public function scopeStatusIs($query, $status)
    {
        if(!$status) return $query; 
        return $query->where('status', $status);
    }

    public function scopeRoleIs($query, $role)
    {
        if(!$role) return $query; 
        return $query->where('role', $role);
    }

    public function getFullNameAttribute()
    {
        return ($this->first_name ?? '') . ' ' . ($this->last_name ?? '');
    }

    public function getIsAdminAttribute() {
        return $this->role == 'admin' || $this->role == 'super_admin';
    }

    public function getIsSuperAdminAttribute() {
        return $this->role == 'super_admin';
    }
}
