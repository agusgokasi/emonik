<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;
// use App\Kategori;
use App\Kegiatan;
use App\Unit;
use App\Notifications\SubmitProker;
use App\Notifications\TerimaProker;
use App\Notifications\TolakProker;
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
    	$kegiatans = Kegiatan::where('status', 1)->orderBy('updated_at', 'desc')->get();
    	// $kategoris = Kategori::where('status', 1)->get();
    	// $units = Unit::where('status', 1)->get();
        return view('kegiatan.index_kegiatan', compact('kegiatans'));
    }

    public function proker() {
        $user = Auth::user();
        $kegiatans = Kegiatan::where('status', 9)->orderBy('updated_at', 'desc')->get();
        if (auth()->user()->id != 1) {
            $user->unreadNotifications->where('type', 'App\Notifications\SubmitProker')->markAsRead();
        }
        return view('kegiatan.index_proker', compact('kegiatans'));
    }

    public function terima(Request $request, $id) {
        $kegiatans = Kegiatan::findOrFail($id);
        $user = User::where('id', $kegiatans->created_by)->first();
        $validator = Validator::make($request->all(), [
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000',
        ],[
            'maksimaldana.required'=>'Maksimal dana harus diisi',
            'maksimaldana.min'=>'dana minimal Rp10.000',
            'maksimaldana.max'=>'dana maksimal Rp100.000.000.000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $id);
        }
        $kegiatans->maksimaldana = $request['maksimaldana'];
        $kegiatans->status = 1;
        $kegiatans->updated_by = Auth::user()->id;
        $kegiatans->keterangan = "Permohonan Belum Dibuat";
        $kegiatans->save();
        if ($user->permissionsGroup->permohonan_status == 1) {
            $user->notify(new TerimaProker);
        }
        return back()->with('msg', 'Proker berhasil diterima!');
    }

    public function tolak(Request $request, $id) {
        $kegiatans = Kegiatan::findOrFail($id);
        $user = User::where('id', $kegiatans->created_by)->first();
        $validator = Validator::make($request->all(), [
        'keterangan'              => 'required|min:3|max:1000',
        ],[
            'keterangan.required'=>'Alasan Penolakan harus diisi',
            'keterangan.min'=>'Alasan Penolakan minimal 3 huruf',
            'keterangan.max'=>'Alasan Penolakan minimal 1000 huruf',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', 'tolak'.$id);
        }
        $kegiatans->status = 0;
        $kegiatans->updated_by = Auth::user()->id;
        $kegiatans->keterangan = $request['keterangan'];
        $kegiatans->save();
        if ($user->permissionsGroup->permohonan_status == 1) {
            $user->notify(new TolakProker);
        }
        return back()->with('msg', 'Proker berhasil ditolak!');
    }
}

/*
    public function post(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150'],
            'bulan' => ['required', 'string','max:150'],
            // 'kategori' => 'required',
            'unit' => 'required',
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
            // 'kategori.required'=>'Kategori harus diisi',
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
        // $kegiatans->kategori_id = $request['kategori'];
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
            // 'kategori' => 'required',
            'unit' => 'required',
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
            // 'kategori.required'=>'Kategori harus diisi',
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
        // $kegiatans->kategori_id = $request['kategori'];
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
    */ 