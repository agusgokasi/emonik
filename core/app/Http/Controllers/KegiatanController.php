<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;
use App\Kategori;
use App\Kegiatan;
use App\Unit;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->kegiatan_status) abort(403);
            return $next($request);
        });
    }

    public function index() {
    	$kegiatans = Kegiatan::orderBy('updated_at', 'desc')->get();
    	$kategoris = Kategori::where('status', 1)->get();
    	$units = Unit::where('status', 1)->get();
        return view('kegiatan.index_kegiatan', compact('kegiatans', 'kategoris', 'units'));
    }

    public function post(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150'],
            'bulan' => ['required', 'string','max:150'],
            'kategori' => 'required',
            'unit' => 'required',
        	'maksimaldana' => 'required|numeric|min:10000|max:100000000000',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
            'kategori.required'=>'Kategori harus diisi',
            'unit.required'=>'Unit harus diisi',
            'maksimaldana.required'=>'Maksimal dana harus diisi',
            'maksimaldana.min'=>'dana minimal Rp10.000',
            'maksimaldana.max'=>'dana maksimal Rp100.000.000.000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', 'create');
        }
    	$kegiatans = new Kegiatan();
        $kegiatans->nama = $request['nama'];
        $kegiatans->bulan = $request['bulan'];
        $kegiatans->maksimaldana = $request['maksimaldana'];
        $kegiatans->kategori_id = $request['kategori'];
        $kegiatans->unit_id = $request['unit'];
        $kegiatans->status = 1;
        $kegiatans->created_by = Auth::user()->id;
        $kegiatans->save();
        return back()->with('msg', 'Kegiatan berhasil disubmit!');
    }

    public function update(Request $request, $id) {
    	$kegiatans = Kegiatan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150'],
            'bulan' => ['required', 'string','max:150'],
            'kategori' => 'required',
            'unit' => 'required',
        	'maksimaldana' => 'required|numeric|min:10000|max:100000000000',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
            'kategori.required'=>'Kategori harus diisi',
            'unit.required'=>'Unit harus diisi',
            'maksimaldana.required'=>'Maksimal dana harus diisi',
            'maksimaldana.min'=>'dana minimal Rp10.000',
            'maksimaldana.max'=>'dana maksimal Rp100.000.000.000',
        ]);

        if ($validator->fails()) {
            // return back()->withErrors($validator)->withInput()->with('dgn', 'Kegiatan gagal diedit, Harap periksa kesalahan!');
            return back()->withErrors($validator)->withInput()->with('error_code', $id);
        }
        $kegiatans->nama = $request['nama'];
        $kegiatans->bulan = $request['bulan'];
        $kegiatans->maksimaldana = $request['maksimaldana'];
        $kegiatans->kategori_id = $request['kategori'];
        $kegiatans->unit_id = $request['unit'];
        $kegiatans->status = $request['status'];
        $kegiatans->updated_by = Auth::user()->id;
        $kegiatans->save();
        return back()->with('msg', 'Kegiatan berhasil diedit!');
    }

    public function destroy($id) 
    {
        $kegiatans = Kegiatan::find($id);
        $kegiatans->delete();
        return redirect()->action('KegiatanController@index')->with('msg', 'Kegiatan berhasil dihapus!');
    }
}
