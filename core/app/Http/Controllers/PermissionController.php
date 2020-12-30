<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->permission_status) abort(403);
            return $next($request);
        });
    }

    public function index() {
    	$users = User::where('id', '!=', 1)->get();
        $permissions = Permission::where('id', '!=', 1)->get();
        return view('permission.index_permission', compact('users', 'permissions'));
    }

    public function create() {
        return view('permission.create_permission');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nama'              => 'required|min:3|max:150',
            'view_status'       => 'required|in:1,0',
            'permission_status'      => 'required|in:1,0',
            'unit_status'      => 'required|in:1,0',
            // 'kategori_status'      => 'required|in:1,0',
            'kegiatan_status'   => 'required|in:1,0',
            'exception_status'   => 'required|in:1,0',
            'permohonan_status'         => 'required|in:1,0',
            'dispo1p_status'         => 'required|in:1,0',
            'dispo2p_status'         => 'required|in:1,0',
            'dispo3p_status'         => 'required|in:1,0',
            'dispo4p_status'         => 'required|in:1,0',
            'dispo1s_status'         => 'required|in:1,0',
            'dispo2s_status'         => 'required|in:1,0',
            // 'status'         => 'required|in:1,0',
        ],[
            'nama.required'=>'Nama Permission harus diisi',
            'nama.min'=>'Nama Permission minimal 3 huruf',
            'nama.max'=>'Nama Permission maksimal 150 huruf',
            'view_status.required'=>'Membaca Data harus diisi',
            'permission_status.required'=>'CRUD User & permission harus diisi',
            'unit_status.required'=>'CRUD Unit harus diisi',
            // 'kategori_status.required'=>'CRUD Kategori harus diisi',
            'kegiatan_status.required'=>'CRUD Kegiatan harus diisi',
            'exception_status.required'=>'Membuka Pengajuan Pemohon harus diisi',
            'permohonan_status.required'=>'CRUD Permohonan & SPJ harus diisi',
            'dispo1p_status.required'=>'Disposisi 1 Permohonan harus diisi',
            'dispo2p_status.required'=>'Disposisi 2 Permohonan harus diisi',
            'dispo3p_status.required'=>'Disposisi 3 Permohonan harus diisi',
            'dispo4p_status.required'=>'Disposisi 4 Permohonan harus diisi',
            'dispo1s_status.required'=>'Disposisi 1 SPJ harus diisi',
            'dispo2s_status.required'=>'Disposisi 2 SPJ harus diisi',
            // 'status.required'=>'statusharus diisi',
        ]);

        $Permissions = new Permission();
        $Permissions->nama = $request['nama'];
        $Permissions->view_status = $request['view_status'];
        $Permissions->permission_status = $request['permission_status'];
        $Permissions->unit_status = $request['unit_status'];
        // $Permissions->kategori_status = $request['kategori_status'];
        $Permissions->kegiatan_status = $request['kegiatan_status'];
        $Permissions->exception_status = $request['exception_status'];
        $Permissions->permohonan_status = $request['permohonan_status'];
        $Permissions->dispo1p_status = $request['dispo1p_status'];
        $Permissions->dispo2p_status = $request['dispo2p_status'];
        $Permissions->dispo3p_status = $request['dispo3p_status'];
        $Permissions->dispo4p_status = $request['dispo4p_status'];
        $Permissions->dispo1s_status = $request['dispo1s_status'];
        $Permissions->dispo2s_status = $request['dispo2s_status'];
        $Permissions->status = 1;
        $Permissions->created_by = Auth::user()->id;
        $Permissions->save();

        return redirect()->action('PermissionController@index')->with('msg', 'Permission berhasil dibuat!');
    }

    public function edit($id) {
    	$permission = Permission::findOrFail($id);
        return view('permission.edit_permission', compact('permission'));
    }

    public function update(Request $request, $id)
    {
    	$Permissions = Permission::findOrFail($id);
    	// dd($permissions);
        $this->validate($request, [
            'nama'              => 'required|min:3|max:150',
            'view_status'       => 'required|in:1,0',
            'permission_status'      => 'required|in:1,0',
            'unit_status'      => 'required|in:1,0',
            // 'kategori_status'      => 'required|in:1,0',
            'kegiatan_status'   => 'required|in:1,0',
            'exception_status'   => 'required|in:1,0',
            'permohonan_status'         => 'required|in:1,0',
            'dispo1p_status'         => 'required|in:1,0',
            'dispo2p_status'         => 'required|in:1,0',
            'dispo3p_status'         => 'required|in:1,0',
            'dispo4p_status'         => 'required|in:1,0',
            'dispo1s_status'         => 'required|in:1,0',
            'dispo2s_status'         => 'required|in:1,0',
            'status'         => 'required|in:1,0',
        ],[
            'nama.required'=>'Nama Permission harus diisi',
            'nama.min'=>'Nama Permission minimal 3 huruf',
            'nama.max'=>'Nama Permission maksimal 150 huruf',
            'view_status.required'=>'Membaca Data harus diisi',
            'permission_status.required'=>'CRUD User & permission harus diisi',
            'unit_status.required'=>'CRUD Unit harus diisi',
            // 'kategori_status.required'=>'CRUD Kategori harus diisi',
            'kegiatan_status.required'=>'CRUD Kegiatan harus diisi',
            'exception_status.required'=>'Membuka Pengajuan Pemohon harus diisi',
            'permohonan_status.required'=>'CRUD Permohonan & SPJ harus diisi',
            'dispo1p_status.required'=>'Disposisi 1 Permohonan harus diisi',
            'dispo2p_status.required'=>'Disposisi 2 Permohonan harus diisi',
            'dispo3p_status.required'=>'Disposisi 3 Permohonan harus diisi',
            'dispo4p_status.required'=>'Disposisi 4 Permohonan harus diisi',
            'dispo1s_status.required'=>'Disposisi 1 SPJ harus diisi',
            'dispo2s_status.required'=>'Disposisi 2 SPJ harus diisi',
            'status.required'=>'statusharus diisi',
        ]);
        $Permissions->nama = $request['nama'];
        $Permissions->view_status = $request['view_status'];
        $Permissions->permission_status = $request['permission_status'];
        $Permissions->unit_status = $request['unit_status'];
        // $Permissions->kategori_status = $request['kategori_status'];
        $Permissions->kegiatan_status = $request['kegiatan_status'];
        $Permissions->exception_status = $request['exception_status'];
        $Permissions->permohonan_status = $request['permohonan_status'];
        $Permissions->dispo1p_status = $request['dispo1p_status'];
        $Permissions->dispo2p_status = $request['dispo2p_status'];
        $Permissions->dispo3p_status = $request['dispo3p_status'];
        $Permissions->dispo4p_status = $request['dispo4p_status'];
        $Permissions->dispo1s_status = $request['dispo1s_status'];
        $Permissions->dispo2s_status = $request['dispo2s_status'];
        $Permissions->status = $request['status'];
        $Permissions->updated_by = Auth::user()->id;
        if ($id != 1 && $id != Auth::user()->permission_id) {
            $Permissions->save();
            return redirect()->action('PermissionController@index')->with('msg', 'Permission berhasil diedit!');
        } else {
        return redirect()->action('PermissionController@index')->with('dgn', 'Permission tidak bisa diedit!');
        }

    }

    public function destroy($id) 
    {
        $Permissions = Permission::find($id);
        if ($id != 1 && $id != Auth::user()->permission_id) {
            User::where('permission_id', $id)->delete();
            $Permissions->delete();
            return redirect()->action('PermissionController@index')->with('msg', 'Permission berhasil dihapus!');
        } else {
            return redirect()->action('PermissionController@index')->with('dgn', 'Permission tidak bisa dihapus!');
        }
    }
}
