<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Permohonan extends Model
{
    // relation with Kegiatan
    public function kegiatan()
    {
        return $this->belongsTo('App\Kegiatan', 'kegiatan_id');
    }
    // relation with user
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
    // relation with Kategori
    // public function kategori()
    // {
    //     return $this->belongsTo('App\Kategori', 'kategori_id');
    // }
}
