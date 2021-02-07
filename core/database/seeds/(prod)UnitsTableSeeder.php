<?php

use Illuminate\Database\Seeder;
use App\Unit;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$Unit = new Unit();
        $Unit->nama = "Kaprodi Ilmu Komputer";
        $Unit->status = 1;
        $Unit->fakultas_id = 1;
        $Unit->prodi_id = 1;
        $Unit->created_by = 1;
        $Unit->save();
    }
}
