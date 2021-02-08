<?php

use Illuminate\Database\Seeder;
use App\Fakultase;

class FakultasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Fakultas = new Fakultase();
        $Fakultas->nama = "Fakultas MIPA";
        $Fakultas->status = 1;
        $Fakultas->created_by = 1;
        $Fakultas->save();
    }
}
