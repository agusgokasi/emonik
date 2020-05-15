<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    public function users()
    {

        return $this->hasMany('App\User', 'permissions_id');
    }
}
