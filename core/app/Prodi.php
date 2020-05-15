<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    // relation with Fakultas
    public function fakultas()
    {
        return $this->belongsTo('App\Fakultase', 'fakultas_id');
    }
}
