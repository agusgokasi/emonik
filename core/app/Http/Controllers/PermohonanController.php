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
use App\Permohonan;
use App\Rincian;
use App\Notifications\SubmitProker;
use App\Notifications\SubmitPermohonan;
use App\Notifications\Dis1Permohonan;
use App\Notifications\Dis2Permohonan;
use App\Notifications\Dt2Permohonan;
use App\Notifications\Dt3Permohonan;
use App\Notifications\Dp3Permohonan;
use Illuminate\Support\Facades\Validator;

class PermohonanController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->permohonan_status) abort(403);
            return $next($request);
        });
    }

    public function indexProker() {
    	$user = Auth::user();
        $units = Unit::get();
    	$kegiatans = Kegiatan::where('unit_id', $user->unit_id)->orderBy('updated_at', 'desc')->get();
        if (auth()->user()->id != 1) {
            $user->unreadNotifications->where('type', 'App\Notifications\TerimaProker')->markAsRead();
            $user->unreadNotifications->where('type', 'App\Notifications\TolakProker')->markAsRead();
        }
        return view('permohonan.proker_permohonan', compact('kegiatans', 'user', 'units'));
    }

    public function postProker(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150'],
            'bulan' => ['required', 'string','max:150'],
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
            'maksimaldana.required'=>'Usulan dana harus diisi',
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
        $kegiatans->unit_id = Auth::user()->unit_id;
        $kegiatans->status = 0;
        $kegiatans->created_by = Auth::user()->id;
        $kegiatans->save();
        return back()->with('msg', 'Proker berhasil disimpan!');
    }

    public function updateProker(Request $request, $id) {
        $kegiatans = Kegiatan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150'],
            'bulan' => ['required', 'string','max:150'],
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
        ]);
        if (!$kegiatans->status){
            $validator = Validator::make($request->all(), [
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000',
        ],[
            'maksimaldana.required'=>'Usulan dana harus diisi',
            'maksimaldana.min'=>'dana minimal Rp10.000',
            'maksimaldana.max'=>'dana maksimal Rp100.000.000.000',
        ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $id);
        }
        $kegiatans->nama = $request['nama'];
        $kegiatans->bulan = $request['bulan'];
        if (!$kegiatans->status){
            $kegiatans->maksimaldana = $request['maksimaldana'];
        }
        $kegiatans->updated_by = Auth::user()->id;
        $kegiatans->save();
        return back()->with('msg', 'Proker berhasil diedit!');
    }

    public function destroyProker($id) 
    {
        $kegiatans = Kegiatan::find($id);
        $kegiatans->delete();
        return redirect()->action('PermohonanController@indexProker')->with('msg', 'Proker berhasil dihapus!');
    }

    public function submitProker(Request $request, $id){
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        $kegiatan = Kegiatan::where('id',$id)->first();
        $kegiatan->status = 9;
        $kegiatan->keterangan = "Proker sedang di proses";
        $kegiatan->save();
        foreach ($users as $user) {
            if ($user->permissionsGroup->kegiatan_status == 1) {
                $user->notify(new SubmitProker);
            }
        }
        return redirect()->action('PermohonanController@indexProker')->with('msg', 'Proker berhasil disubmit!');
    }



    public function index() {
        $user = Auth::user();
        $kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->get();
        $permohonans = permohonan::where('created_by', $user->id)->where('status', '!=' ,5)->where('status', '!=' ,6)->where('status', '!=' ,7)->where('status', '!=' ,8)->where('status', '!=' ,10)->orderBy('updated_at', 'desc')->get();
        if (auth()->user()->id != 1) {
            $user->unreadNotifications->where('type', 'App\Notifications\Dt2Permohonan')->markAsRead();
            $user->unreadNotifications->where('type', 'App\Notifications\Dt3Permohonan')->markAsRead();
            $user->unreadNotifications->where('type', 'App\Notifications\Dp3Permohonan')->markAsRead();
        }
        return view('permohonan.index_permohonan', compact('kegiatans', 'user', 'permohonans'));
    }

    public function create() {
        if (auth()->user()->tor == null) {
        	$user = Auth::user();
        	$kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->where('keterangan', '!=' ,'Sudah Dibuat')->get();
        	return view('permohonan.create_permohonan', compact('kegiatans'));
        }
        return abort(403);
    }

    public function getProkers($id) {
        $kegiatans = Kegiatan::Where('id', $id)->where('status', 1)->pluck('maksimaldana');
        return json_encode($kegiatans);
    }

    public function store(Request $request)
    {

        
        $this->validate($request, [
            'nama'                		   => 'required|min:3|max:150',
            'kegiatan' 				 	   => 'required',
            'pemohon'                  	   => 'required|min:3|max:150',
            // 'nomorinduk'                   => 'required|min:3|max:150',
            'latarbelakang'                => 'required|min:3|max:1000',
            'tujuan'                       => 'required|min:3|max:1000',
            'ruanglingkup'                 => 'required|min:3|max:150',
            // 'tanggalkegiatan'              => 'required|date',
            'waktupencapaian'              => 'required|min:3|max:1000',
            'luaran'                       => 'required|min:3|max:1000',
            'pembiayaan'                   => 'required|min:3|max:1000',
            'filetor'                      => 'required|mimes:pdf|max:10000kb',
        ],[
            'nama.required'=>'Nama Kegiatan harus diisi',
            'nama.min'=>'Nama Kegiatan minimal 3 huruf',
            'nama.max'=>'Nama Kegiatan maksimal 150 huruf',

            'kegiatan.required'=>'Program Kerja harus diisi',

            'pemohon.required'=>'Nama Pemohon harus diisi',
            'pemohon.min'=>'Nama Pemohon minimal 3 huruf',
            'pemohon.max'=>'Nama Pemohon maksimal 150 huruf',

            // 'nomorinduk.required'=>'Nomor induk harus diisi',
            // 'nomorinduk.min'=>'Nomor induk minimal 3 angka',
            // 'nomorinduk.max'=>'Nomor induk maksimal 150 angka',

            'latarbelakang.required'=>'Latar Belakang harus diisi',
            'latarbelakang.min'=>'Latar Belakang minimal 3 huruf',
            'latarbelakang.max'=>'Latar Belakang maksimal 1000 huruf',

            'tujuan.required'=>'Tujuan / Penerima Manfaat harus diisi',
            'tujuan.min'=>'Tujuan / Penerima Manfaat minimal 3 huruf',
            'tujuan.max'=>'Tujuan / Penerima Manfaat maksimal 1000 huruf',

            'ruanglingkup.required'=>'Ruang Lingkup / Strategi Pencapaian Keluaran harus diisi',
            'ruanglingkup.min'=>'Ruang Lingkup / Strategi Pencapaian Keluaran minimal 3 huruf',
            'ruanglingkup.max'=>'Ruang Lingkup / Strategi Pencapaian Keluaran maksimal 150 huruf',

            // 'tanggalkegiatan.required'=>'Tanggal Kegiatan harus diisi',

            'waktupencapaian.required'=>'Waktu Pencapaian Keluaran harus diisi',
            'waktupencapaian.min'=>'Waktu Pencapaian Keluaran minimal 3 huruf',
            'waktupencapaian.max'=>'Waktu Pencapaian Keluaran maksimal 1000 huruf',

            'luaran.required'=>'Susunan Acara / Luaran harus diisi',
            'luaran.min'=>'Susunan Acara / Luaran minimal 3 huruf',
            'luaran.max'=>'Susunan Acara / Luaran maksimal 1000 huruf',

            'pembiayaan.required'=>'Pembiayaan / Rencana Anggaran harus diisi',
            'pembiayaan.min'=>'Pembiayaan / Rencana Anggaran minimal 3 huruf',
            'pembiayaan.max'=>'Pembiayaan / Rencana Anggaran maksimal 1000 huruf',

            'filetor.required'=>'File TOR harus diisi',
            'filetor.max'=>'File TOR maksimal 5Mb',
            'filetor.mimes'=>'File TOR harus berformat .pdf',
        ]);
        //slug
        $slug = str_slug($request->nama, '-');
        if(Permohonan::where('slug',$slug)->first() !=null) {
            $slug = $slug . '-' .time();
        }

        //file
        $file = $request->file('filetor');
        $filetor = time().rand(1000,9999).'.'.$file->getClientOriginalExtension();
        $request->file('filetor')->move(public_path('/filetor'), $filetor);

        $kegiatan = Kegiatan::where('id', $request['kegiatan'])->first();

        $permohonan = new Permohonan();
        $permohonan->nama = $request['nama'];
        $permohonan->slug = $slug;
        $permohonan->pemohon = $request['pemohon'];
        // $permohonan->nomorinduk = $request['nomorinduk'];
        $permohonan->kegiatan_id = $request['kegiatan'];
        $permohonan->totalbiaya = $kegiatan->maksimaldana;
        $permohonan->sisadana = $kegiatan->maksimaldana;
        $permohonan->latarbelakang = $request['latarbelakang'];
        $permohonan->tujuan = $request['tujuan'];
        // $permohonan->tanggalkegiatan = $request['tanggalkegiatan'];
        $permohonan->ruanglingkup = $request['ruanglingkup'];
        $permohonan->waktupencapaian = $request['waktupencapaian'];
        $permohonan->luaran = $request['luaran'];
        $permohonan->pembiayaan = $request['pembiayaan'];
        $permohonan->filetor = $filetor;
        $permohonan->status = 0;
        $permohonan->created_by = Auth::user()->id;
        $permohonan->save();

        $kegiatan->keterangan = 'Sudah Dibuat';
        $kegiatan->save();
        Auth::user()->update(['tor'=>1]);

        return redirect()->action('PermohonanController@index')->with('msg', 'Permohonan berhasil dibuat!');
    }

    public function show($slug) {
    	$user = Auth::user();
    	$permohonan = Permohonan::where('slug',$slug)->first();
    	if(empty($permohonan)) abort (404);
    	$rincians = Rincian::where('permohonan_id',$permohonan->id)->get();
        // dd($permohonan->nama);
        return view('permohonan.single_permohonan', compact('user', 'permohonan', 'rincians'));
    }

    public function edit($slug) {
    	$user = Auth::user();
    	$permohonan = Permohonan::where('slug',$slug)->first();
    	if(empty($permohonan)) abort (404);
    	$kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->where('keterangan', '!=' ,'Sudah Dibuat')->get();
        return view('permohonan.edit_permohonan', compact('permohonan', 'kegiatans'));
    }

    public function editp($slug) {
        $user = Auth::user();
        $permohonan = Permohonan::where('slug',$slug)->first();
        if(empty($permohonan)) abort (404);
        $kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->where('keterangan', '!=' ,'Sudah Dibuat')->get();
        return view('permohonan.editp_permohonan', compact('permohonan', 'kegiatans'));
    }

    public function update(Request $request, $slug)
    {

        $this->validate($request, [
            'nama'                         => 'required|min:3|max:150',
            'kegiatan'                     => 'required',
            'pemohon'                       => 'required|min:3|max:150',
            // 'nomorinduk'                   => 'required|min:3|max:150',
            'latarbelakang'                => 'required|min:3|max:1000',
            'tujuan'                       => 'required|min:3|max:1000',
            'ruanglingkup'                 => 'required|min:3|max:150',
            // 'tanggalkegiatan'              => 'required|date',
            'waktupencapaian'              => 'required|min:3|max:1000',
            'luaran'                       => 'required|min:3|max:1000',
            'pembiayaan'                   => 'required|min:3|max:1000',
            'filetor'                      => 'nullable|mimes:pdf|max:10000kb',
        ],[
            'nama.required'=>'Nama Kegiatan harus diisi',
            'nama.min'=>'Nama Kegiatan minimal 3 huruf',
            'nama.max'=>'Nama Kegiatan maksimal 150 huruf',

            'kegiatan.required'=>'Program Kerja harus diisi',

            'pemohon.required'=>'Nama Pemohon harus diisi',
            'pemohon.min'=>'Nama Pemohon minimal 3 huruf',
            'pemohon.max'=>'Nama Pemohon maksimal 150 huruf',

            // 'nomorinduk.required'=>'Nomor induk harus diisi',
            // 'nomorinduk.min'=>'Nomor induk minimal 3 angka',
            // 'nomorinduk.max'=>'Nomor induk maksimal 150 angka',

            'latarbelakang.required'=>'Latar Belakang harus diisi',
            'latarbelakang.min'=>'Latar Belakang minimal 3 huruf',
            'latarbelakang.max'=>'Latar Belakang maksimal 1000 huruf',

            'tujuan.required'=>'Tujuan / Penerima Manfaat harus diisi',
            'tujuan.min'=>'Tujuan / Penerima Manfaat minimal 3 huruf',
            'tujuan.max'=>'Tujuan / Penerima Manfaat maksimal 1000 huruf',

            'ruanglingkup.required'=>'Ruang Lingkup / Strategi Pencapaian Keluaran harus diisi',
            'ruanglingkup.min'=>'Ruang Lingkup / Strategi Pencapaian Keluaran minimal 3 huruf',
            'ruanglingkup.max'=>'Ruang Lingkup / Strategi Pencapaian Keluaran maksimal 150 huruf',

            // 'tanggalkegiatan.required'=>'Tanggal Kegiatan harus diisi',

            'waktupencapaian.required'=>'Waktu Pencapaian Keluaran harus diisi',
            'waktupencapaian.min'=>'Waktu Pencapaian Keluaran minimal 3 huruf',
            'waktupencapaian.max'=>'Waktu Pencapaian Keluaran maksimal 1000 huruf',

            'luaran.required'=>'Susunan Acara / Luaran harus diisi',
            'luaran.min'=>'Susunan Acara / Luaran minimal 3 huruf',
            'luaran.max'=>'Susunan Acara / Luaran maksimal 1000 huruf',

            'pembiayaan.required'=>'Pembiayaan / Rencana Anggaran harus diisi',
            'pembiayaan.min'=>'Pembiayaan / Rencana Anggaran minimal 3 huruf',
            'pembiayaan.max'=>'Pembiayaan / Rencana Anggaran maksimal 1000 huruf',

            'filetor.max'=>'File TOR maksimal 5Mb',
            'filetor.mimes'=>'File TOR harus berformat .pdf',
        ]);

        $permohonan = Permohonan::where('slug',$slug)->first();
        if($permohonan->kegiatan_id != $request['kegiatan']){
            $kegiatan = Kegiatan::where('id', $permohonan->kegiatan_id)->first();
            $kegiatan->keterangan = "Permohonan Belum Dibuat";
            $kegiatan->save();
        }

        $kegiatan = Kegiatan::where('id', $request['kegiatan'])->first();
        //slug
        $slug = str_slug($request->nama, '-');
        if($permohonan->slug != $slug){
	        if(Permohonan::where('slug',$slug)->first() !=null) {
	            $slug = $slug . '-' .time();
	        }
        }
        $permohonan->nama = $request['nama'];
        $permohonan->slug = $slug;
        $permohonan->pemohon = $request['pemohon'];
        // $permohonan->nomorinduk = $request['nomorinduk'];
        $permohonan->kegiatan_id = $request['kegiatan'];
        $permohonan->totalbiaya = $kegiatan->maksimaldana;
        $permohonan->sisadana = $kegiatan->maksimaldana;
        $permohonan->latarbelakang = $request['latarbelakang'];
        $permohonan->tujuan = $request['tujuan'];
        // $permohonan->tanggalkegiatan = $request['tanggalkegiatan'];
        $permohonan->ruanglingkup = $request['ruanglingkup'];
        $permohonan->waktupencapaian = $request['waktupencapaian'];
        $permohonan->luaran = $request['luaran'];
        $permohonan->pembiayaan = $request['pembiayaan'];
        if($request->file('filetor')){
        //file
        if(is_file('filetor/'.$permohonan->filetor)){
        unlink(public_path('filetor/'.$permohonan->filetor));
        }
        $file = $request->file('filetor');
        $filetor = time().rand(1000,9999).'.'.$file->getClientOriginalExtension();
        $request->file('filetor')->move(public_path('/filetor'), $filetor);
        $permohonan->filetor = $filetor;
    	}
        $permohonan->updated_by = Auth::user()->id;
        $permohonan->save();
        $kegiatan->keterangan = 'Sudah Dibuat';
        $kegiatan->save();
        // Auth::user()->update(['tor'=>1]);

        return redirect()->action('PermohonanController@show', [$slug])->with('msg', 'Permohonan berhasil diedit!');
    }

    public function destroy($slug){
        $permohonan = Permohonan::where('slug',$slug)->first();
        $kegiatan = Kegiatan::where('id', $permohonan->kegiatan_id)->first();
        if(is_file('filetor/'.$permohonan->filetor)){
        unlink(public_path('filetor/'.$permohonan->filetor));
        }
        $kegiatan->keterangan = "Permohonan Belum Dibuat";
        $kegiatan->save();
        Auth::user()->update(['tor'=>null]);
        $permohonan->delete();
        return redirect()->action('PermohonanController@index')->with('msg', 'Permohonan berhasil dihapus!');
    }

    public function submit(Request $request, $slug){
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        $permohonan = Permohonan::where('slug',$slug)->first();
        if($permohonan->status == 0){
            $permohonan->status = 1;
            $permohonan->keterangan = 'permohonan sedang berada di WD2';
            $permohonan->save();
            foreach ($users as $user) {
                if ($user->permissionsGroup->dispo1p_status == 1) {
                    $user->notify(new SubmitPermohonan);
                }
            }
        }elseif($permohonan->status == 9){
            $permohonan->status = 2;
            $permohonan->keterangan = 'permohonan sedang berada di PPK';
            $permohonan->save();
            foreach ($users as $user) {
                if ($user->permissionsGroup->dispo2p_status == 1) {
                    $user->notify(new Dis1Permohonan);
                }
            }
        }elseif($permohonan->status == 11){
            $permohonan->status = 3;
            $permohonan->keterangan = 'permohonan sedang berada di Kasubag';
            $permohonan->save();
            foreach ($users as $user) {
                if ($user->permissionsGroup->dispo3p_status == 1) {
                    $user->notify(new Dis2Permohonan);
                }
            }
        }
        
        return redirect()->action('PermohonanController@index')->with('msg', 'Permohonan berhasil disubmit!');
    }

}
