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
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "10000000";
        // $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 1;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Seminar";
        $Kegiatan->bulan = "Maret";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "12000000";
        // $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 1;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Lainnya";
        $Kegiatan->bulan = "April";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "15000000";
        // $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 1;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Lainnya";
        $Kegiatan->bulan = "Mei";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "8000000";
        // $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 1;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();
        //
        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Stadium Generale";
        $Kegiatan->bulan = "Januari";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "10000000";
        // $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 2;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Seminar";
        $Kegiatan->bulan = "Maret";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "12000000";
        // $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 2;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Lainnya";
        $Kegiatan->bulan = "April";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "18000000";
        // $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 2;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Lainnya";
        $Kegiatan->bulan = "Mei";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "8000000";
        // $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 2;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();
        //
        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Stadium Generale";
        $Kegiatan->bulan = "Januari";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "10000000";
        // $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 3;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Seminar";
        $Kegiatan->bulan = "Maret";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "12000000";
        // $Kegiatan->kategori_id = 1;
        $Kegiatan->unit_id = 3;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Lainnya";
        $Kegiatan->bulan = "April";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "15000000";
        // $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 3;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();

        $Kegiatan = new Kegiatan();
        $Kegiatan->nama = "Tes Lainnya";
        $Kegiatan->bulan = "Mei";
        $Kegiatan->tahun = 2021;
        $Kegiatan->maksimaldana = "8000000";
        // $Kegiatan->kategori_id = 2;
        $Kegiatan->unit_id = 3;
        $Kegiatan->status = 1;
        $Kegiatan->keterangan = "Permohonan Belum Dibuat";
        $Kegiatan->created_by = 1;
        $Kegiatan->save();
    }
}
