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
use Illuminate\Support\Facades\Validator;

class ProdisController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->unit_status) abort(403);
            return $next($request);
        });
    }

    public function index() {
    	$prodis = Prodi::get();
    	$fakultases = Fakultase::where('status', 1)->get();
        return view('prodi.index_prodi', compact('prodis', 'fakultases'));
    }

    public function post(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:150', 'unique:prodis'],
            'fakultas' => 'required',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'nama.unique'=>'Prodi sudah ada',
            'fakultas.required'=>'Fakultas harus diisi',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', 'create');
        }
    	$prodis = new Prodi();
        $prodis->nama = $request['nama'];
        $prodis->fakultas_id = $request['fakultas'];
        $prodis->status = 1;
        $prodis->created_by = Auth::user()->id;
        $prodis->save();
        return back()->with('msg', 'Prodi berhasil dibuat!');
    }

    public function update(Request $request, $id) {
    	$prodis = Prodi::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'fakultas' => 'required',
            'status'=> 'required|in:1,0',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'fakultas.required'=>'Fakultas harus diisi',
            'status.required'=>'Status harus diisi',
        ]);

        if ($request->nama != $prodis->nama) {
            $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:150', 'unique:prodis'],
            ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'nama.unique'=>'Prodi sudah ada',
            ]);
        }

        if ($validator->fails()) {
            // return back()->withErrors($validator)->withInput()->with('dgn', 'Prodi gagal diedit, Harap periksa kesalahan!');
            return back()->withErrors($validator)->withInput()->with('error_code', $id);
        }
        $prodis->nama = $request['nama'];
        $prodis->fakultas_id = $request['fakultas'];
        $prodis->status = $request['status'];
        $prodis->updated_by = Auth::user()->id;
        $prodis->save();
        return back()->with('msg', 'Prodi berhasil diedit!');
    }

    public function destroy($id) 
    {
        $prodis = Prodi::find($id);
        $units = Unit::where('prodi_id', $prodis->id)->get();
        foreach ($units as $unit) {
            $unit->prodi_id = null;
            $unit->save();
        }
        $prodis->delete();
        return redirect()->action('ProdisController@index')->with('msg', 'Prodi berhasil dihapus!');
    }
}
