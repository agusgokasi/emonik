<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    // relation with Fakultas
    public function fakultas()
    {
        return $this->belongsTo('App\Fakultase', 'fakultas_id');
    }
    // relation with Prodi
    public function prodi()
    {
        return $this->belongsTo('App\Prodi', 'prodi_id');
    }
}
