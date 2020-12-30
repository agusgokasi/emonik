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
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{/*

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->kategori_status) abort(403);
            return $next($request);
        });
    }

    public function index() {
    	$kategoris = Kategori::get();
        return view('kategori.index_kategori', compact('kategoris'));
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
    	$kategoris = new Kategori();
        $kategoris->nama = $request['nama'];
        $kategoris->status = 1;
        $kategoris->created_by = Auth::user()->id;
        $kategoris->save();
        return back()->with('msg', 'Kategori berhasil disubmit!');
    }

    public function update(Request $request, $id) {
    	$kategoris = Kategori::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'status'=> 'required|in:1,0',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'status.required'=>'status harus diisi',
        ]);

        if ($validator->fails()) {
            // return back()->withErrors($validator)->withInput()->with('dgn', 'Kategori gagal diedit, Harap periksa kesalahan!');
            return back()->withErrors($validator)->withInput()->with('error_code', $id);
        }
        $kategoris->nama = $request['nama'];
        $kategoris->status = $request['status'];
        $kategoris->updated_by = Auth::user()->id;
        $kategoris->save();
        return back()->with('msg', 'Kategori berhasil diedit!');
    }

    public function destroy($id) 
    {
        $kategoris = Kategori::find($id);
        $kegiatans = Kegiatan::where('kategori_id', $kategoris->id)->get();
        foreach ($kegiatans as $kegiatan) {
            $kegiatan->kategori_id = null;
            $kegiatan->save();
        }
        $kategoris->delete();
        return redirect()->action('KategoriController@index')->with('msg', 'Kategori berhasil dihapus!');
    }
*/
}
