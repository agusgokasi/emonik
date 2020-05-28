<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rincian extends Model
{

	protected $dates = ['created_at', 'updated_at'];
    // relation with Permohonan
    public function permohonan()
    {
        return $this->belongsTo('App\Permohonan', 'permohonan_id');
    }
}
