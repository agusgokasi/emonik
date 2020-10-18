<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;
use App\Unit;
use App\Fakultase;
use App\Prodi;
use App\Kegiatan;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->unit_status) abort(403);
            return $next($request);
        });
    }

    public function getUnits($id) {
        $prodis = Prodi::Where('fakultas_id', $id)->where('status', 1)->pluck("nama","id");
        return json_encode($prodis);
    }

    public function index() {
    	$fakultases = Fakultase::where('status', 1)->get();
    	$prodis = Prodi::where('status', 1)->get();
    	$units = Unit::get();
        return view('unit.index_unit', compact('units', 'fakultases', 'prodis'));
    }

    public function post(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150'],
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', 'create');
        }
        $units = new Unit();
        $units->nama = $request['nama'];
        $units->fakultas_id = $request['fakultas'];
        $units->prodi_id = $request['prodi'];
        $units->status = 1;
        $units->created_by = Auth::user()->id;
        $units->save();
        return back()->with('msg', 'Unit berhasil disubmit!');
    }

    public function update(Request $request, $id) {
        $units = Unit::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'status'=> 'required|in:1,0',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'status.required'=>'status harus diisi',
        ]);

        if ($validator->fails()) {
            // return back()->withErrors($validator)->withInput()->with('dgn', 'Unit gagal diedit, Harap periksa kesalahan!');
            return back()->withErrors($validator)->withInput()->with('error_code', $id);
        }
        $units->nama = $request['nama'];
        $units->fakultas_id = $request['fakultas'];
        $units->prodi_id = $request['prodi'];
        $units->status = $request['status'];
        $units->updated_by = Auth::user()->id;
        $units->save();
        return back()->with('msg', 'Unit berhasil diedit!');
    }

    public function destroy($id) 
    {
        $units = Unit::find($id);
        $users = User::where('unit_id', $units->id)->get();
        $kegiatans = Kegiatan::where('unit_id', $units->id)->get();
        foreach ($kegiatans as $kegiatan) {
            $kegiatan->unit_id = null;
            $kegiatan->save();
        }
        foreach ($users as $user) {
        	$user->unit_id = null;
        	$user->save();
        }
        $units->delete();
        return redirect()->action('UnitController@index')->with('msg', 'Unit berhasil dihapus!');
    }

}
