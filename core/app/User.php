<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'tor',
        'unit_id',
        'permission_id',
        'status',
        'password', 
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

    // relation with Permissions
    public function permissionsGroup()
    {
        return $this->belongsTo('App\Permission', 'permission_id');
    }

    // relation with Units
    public function units()
    {
        return $this->belongsTo('App\Unit', 'unit_id');
    }
}
