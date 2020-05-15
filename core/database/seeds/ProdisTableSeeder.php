<?php

use Illuminate\Database\Seeder;
use App\Prodi;

class ProdisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Prodi = new Prodi();
        $Prodi->nama = "Ilmu Komputer";
        $Prodi->fakultas_id = 1;
        $Prodi->status = 1;
        $Prodi->created_by = 1;
        $Prodi->save();
    }
}
