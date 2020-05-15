<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Kategori = new Kategori();
        $Kategori->nama = "Seminar";
        $Kategori->status = 1;
        $Kategori->created_by = 1;
        $Kategori->save();

        $Kategori = new Kategori();
        $Kategori->nama = "Lainnya";
        $Kategori->status = 1;
        $Kategori->created_by = 1;
        $Kategori->save();
    }
}
