<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        // $Permissions = new Permission();
        // $Permissions->nama = "Webmaster";
        // $Permissions->view_status = true;
        // $Permissions->permission_status = true;
        // $Permissions->unit_status = true;
        // // $Permissions->kategori_status = true;
        // $Permissions->kegiatan_status = true;
        // $Permissions->exception_status = true;
        // $Permissions->permohonan_status = true;
        // $Permissions->dispo1p_status = true;
        // $Permissions->dispo2p_status = true;
        // $Permissions->dispo3p_status = true;
        // $Permissions->dispo4p_status = true;
        // $Permissions->dispo1s_status = true;
        // $Permissions->dispo2s_status = true;
        // $Permissions->status = true;
        // $Permissions->created_by = 1;
        // $Permissions->save();

        $Permissions = new Permission();
        $Permissions->nama = "Admin";
        $Permissions->view_status = true;
        $Permissions->permission_status = true;
        $Permissions->unit_status = true;
        // $Permissions->kategori_status = true;
        $Permissions->kegiatan_status = false;
        $Permissions->exception_status = true;
        $Permissions->permohonan_status = false;
        $Permissions->dispo1p_status = false;
        $Permissions->dispo2p_status = false;
        $Permissions->dispo3p_status = false;
        $Permissions->dispo4p_status = false;
        $Permissions->dispo1s_status = false;
        $Permissions->dispo2s_status = false;
        $Permissions->status = true;
        $Permissions->created_by = 1;
        $Permissions->save();

        $Permissions = new Permission();
        $Permissions->nama = "PPK";
        $Permissions->view_status = true;
        $Permissions->permission_status = false;
        $Permissions->unit_status = false;
        // $Permissions->kategori_status = false;
        $Permissions->kegiatan_status = true;
        $Permissions->exception_status = false;
        $Permissions->permohonan_status = false;
        $Permissions->dispo1p_status = false;
        $Permissions->dispo2p_status = true;
        $Permissions->dispo3p_status = false;
        $Permissions->dispo4p_status = false;
        $Permissions->dispo1s_status = false;
        $Permissions->dispo2s_status = false;
        $Permissions->status = true;
        $Permissions->created_by = 1;
        $Permissions->save();

        $Permissions = new Permission();
        $Permissions->nama = "Wakil Dekan 2";
        $Permissions->view_status = true;
        $Permissions->permission_status = false;
        $Permissions->unit_status = false;
        // $Permissions->kategori_status = false;
        $Permissions->kegiatan_status = false;
        $Permissions->exception_status = false;
        $Permissions->permohonan_status = false;
        $Permissions->dispo1p_status = true;
        $Permissions->dispo2p_status = false;
        $Permissions->dispo3p_status = false;
        $Permissions->dispo4p_status = false;
        $Permissions->dispo1s_status = false;
        $Permissions->dispo2s_status = false;
        $Permissions->status = true;
        $Permissions->created_by = 1;
        $Permissions->save();

        $Permissions = new Permission();
        $Permissions->nama = "BPP";
        $Permissions->view_status = true;
        $Permissions->permission_status = true;
        $Permissions->unit_status = true;
        // $Permissions->kategori_status = false;
        $Permissions->kegiatan_status = false;
        $Permissions->exception_status = true;
        $Permissions->permohonan_status = false;
        $Permissions->dispo1p_status = false;
        $Permissions->dispo2p_status = false;
        $Permissions->dispo3p_status = false;
        $Permissions->dispo4p_status = true;
        $Permissions->dispo1s_status = false;
        $Permissions->dispo2s_status = true;
        $Permissions->status = true;
        $Permissions->created_by = 1;
        $Permissions->save();

        $Permissions = new Permission();
        $Permissions->nama = "Kasubag";
        $Permissions->view_status = true;
        $Permissions->permission_status = false;
        $Permissions->unit_status = false;
        // $Permissions->kategori_status = false;
        $Permissions->kegiatan_status = false;
        $Permissions->exception_status = false;
        $Permissions->permohonan_status = false;
        $Permissions->dispo1p_status = false;
        $Permissions->dispo2p_status = false;
        $Permissions->dispo3p_status = true;
        $Permissions->dispo4p_status = false;
        $Permissions->dispo1s_status = true;
        $Permissions->dispo2s_status = false;
        $Permissions->status = true;
        $Permissions->created_by = 1;
        $Permissions->save();

        $Permissions = new Permission();
        $Permissions->nama = "Pemohon";
        $Permissions->view_status = false;
        $Permissions->permission_status = false;
        $Permissions->unit_status = false;
        // $Permissions->kategori_status = false;
        $Permissions->kegiatan_status = false;
        $Permissions->exception_status = false;
        $Permissions->permohonan_status = true;
        $Permissions->dispo1p_status = false;
        $Permissions->dispo2p_status = false;
        $Permissions->dispo3p_status = false;
        $Permissions->dispo4p_status = false;
        $Permissions->dispo1s_status = false;
        $Permissions->dispo2s_status = false;
        $Permissions->status = true;
        $Permissions->created_by = 1;
        $Permissions->save();
    }
}
