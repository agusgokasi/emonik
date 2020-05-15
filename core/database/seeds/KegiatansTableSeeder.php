<?php

use Illuminate\Database\Seeder;
use App\Kegiatan;

class KegiatansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Stadium Generale";
        $Kegiatan->bulan = "Januari";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 1;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Seminar";
        $Kegiatan->bulan = "Maret";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 1;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Lainnya";
        $Kegiatan->bulan = "April";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 1;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Lainnya";
        $Kegiatan->bulan = "Mei";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 1;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();
        //
        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Stadium Generale";
        $Kegiatan->bulan = "Januari";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 2;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Seminar";
        $Kegiatan->bulan = "Maret";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 2;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Lainnya";
        $Kegiatan->bulan = "April";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 2;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Lainnya";
        $Kegiatan->bulan = "Mei";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 2;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();
        //
        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Stadium Generale";
        $Kegiatan->bulan = "Januari";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 3;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Seminar";
        $Kegiatan->bulan = "Maret";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 3;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Lainnya";
        $Kegiatan->bulan = "April";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 3;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Lainnya";
        $Kegiatan->bulan = "Mei";
        $Kegiatan->maksimaldana = "10000000";
        $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 3;
        $Kegiatan->status = 1;
        $Kegiatan->created_by = 1;
        $Kegiatan->save();
    }
}
