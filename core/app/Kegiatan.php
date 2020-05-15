<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    // relation with Kategori
    public function kategori()
    {
        return $this->belongsTo('App\Kategori', 'kategori_id');
    }
    // relation with Unit
    public function unit()
    {
        return $this->belongsTo('App\Unit', 'unit_id');
    }
}
