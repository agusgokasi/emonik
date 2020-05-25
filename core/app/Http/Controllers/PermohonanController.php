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
use App\Permohonan;
use App\Rincian;
use App\Notifications\SubmitPermohonan;
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

    public function index() {
    	$user = Auth::user();
    	$kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->where('keterangan', null)->get();
    	$permohonans = permohonan::where('created_by', $user->id)->where('status', '!=' ,5)->where('status', '!=' ,6)->where('status', '!=' ,7)->where('status', '!=' ,8)->where('status', '!=' ,10)->orderBy('updated_at', 'desc')->get();
        if (auth()->user()->id != 1) {
            $user->unreadNotifications->where('type', 'App\Notifications\Dt2Permohonan')->markAsRead();
            $user->unreadNotifications->where('type', 'App\Notifications\Dt3Permohonan')->markAsRead();
            $user->unreadNotifications->where('type', 'App\Notifications\Dp3Permohonan')->markAsRead();
        }
        return view('permohonan.index_permohonan', compact('kegiatans', 'user', 'permohonans'));
    }

    public function indexkategori() {
    	$user = Auth::user();
    	$kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->get();
        return view('permohonan.kategori_permohonan', compact('kegiatans', 'user'));
    }

    public function create() {
        if (auth()->user()->tor == null) {
        	$user = Auth::user();
        	$kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->where('keterangan', null)->get();
        	return view('permohonan.create_permohonan', compact('kegiatans'));
        }
        return abort(403);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nama'                		   => 'required|min:3|max:150',
            'kegiatan' 				 	   => 'required',
            'pemohon'                  	   => 'required|min:3|max:150',
            'nomorinduk'                   => 'required|min:3|max:150',
            'latarbelakangkegiatan'        => 'required|min:3|max:1000',
            'tujuankegiatan'               => 'required|min:3|max:1000',
            'tempatkegiatan'               => 'required|min:3|max:150',
            'tanggalkegiatan'              => 'required|date',
            'pesertakegiatan'              => 'required|min:3|max:1000',
            'strategipencapaiankeluaran'   => 'required|min:3|max:1000',
            'susunanpanitia'               => 'required|min:3|max:1000',
            'filetor'                      => 'required|mimes:pdf|max:10000kb',
        ],[
            'nama.required'=>'Nama Permohonan harus diisi',
            'nama.min'=>'Nama Permohonan minimal 3 huruf',
            'nama.max'=>'Nama Permohonan maksimal 150 huruf',

            'kegiatan.required'=>'Kategori harus diisi',

            'pemohon.required'=>'Nama Pemohon harus diisi',
            'pemohon.min'=>'Nama Pemohon minimal 3 huruf',
            'pemohon.max'=>'Nama Pemohon maksimal 150 huruf',

            'nomorinduk.required'=>'Nomor induk harus diisi',
            'nomorinduk.min'=>'Nomor induk minimal 3 angka',
            'nomorinduk.max'=>'Nomor induk maksimal 150 angka',

            'latarbelakangkegiatan.required'=>'Latar Belakang Kegiatan harus diisi',
            'latarbelakangkegiatan.min'=>'Latar Belakang Kegiatan minimal 3 huruf',
            'latarbelakangkegiatan.max'=>'Latar Belakang Kegiatan maksimal 1000 huruf',

            'tujuankegiatan.required'=>'Tujuan Kegiatan harus diisi',
            'tujuankegiatan.min'=>'Tujuan Kegiatan minimal 3 huruf',
            'tujuankegiatan.max'=>'Tujuan Kegiatan maksimal 1000 huruf',

            'tempatkegiatan.required'=>'Tempat Kegiatan harus diisi',
            'tempatkegiatan.min'=>'Tempat Kegiatan minimal 3 huruf',
            'tempatkegiatan.max'=>'Tempat Kegiatan maksimal 150 huruf',

            'tanggalkegiatan.required'=>'Tanggal Kegiatan harus diisi',

            'pesertakegiatan.required'=>'Peserta Kegiatan harus diisi',
            'pesertakegiatan.min'=>'Peserta Kegiatan minimal 3 huruf',
            'pesertakegiatan.max'=>'Peserta Kegiatan maksimal 1000 huruf',

            'strategipencapaiankeluaran.required'=>'Strategi Pencapaian Keluaran harus diisi',
            'strategipencapaiankeluaran.min'=>'Strategi Pencapaian Keluaran minimal 3 huruf',
            'strategipencapaiankeluaran.max'=>'Strategi Pencapaian Keluaran maksimal 1000 huruf',

            'susunanpanitia.required'=>'Susunan Panitia harus diisi',
            'susunanpanitia.min'=>'Susunan Panitia minimal 3 huruf',
            'susunanpanitia.max'=>'Susunan Panitia maksimal 1000 huruf',

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
        $permohonan->nomorinduk = $request['nomorinduk'];
        $permohonan->kegiatan_id = $request['kegiatan'];
        $permohonan->totalbiaya = $kegiatan->maksimaldana;
        $permohonan->sisadana = $kegiatan->maksimaldana;
        $permohonan->latarbelakangkegiatan = $request['latarbelakangkegiatan'];
        $permohonan->tujuankegiatan = $request['tujuankegiatan'];
        $permohonan->tanggalkegiatan = $request['tanggalkegiatan'];
        $permohonan->tempatkegiatan = $request['tempatkegiatan'];
        $permohonan->pesertakegiatan = $request['pesertakegiatan'];
        $permohonan->strategipencapaiankeluaran = $request['strategipencapaiankeluaran'];
        $permohonan->susunanpanitia = $request['susunanpanitia'];
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
        return view('permohonan.single_permohonan', compact('user', 'permohonan', 'rincians'));
    }

    public function edit($slug) {
    	$user = Auth::user();
    	$permohonan = Permohonan::where('slug',$slug)->first();
    	if(empty($permohonan)) abort (404);
    	$kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->where('keterangan', null)->get();
        return view('permohonan.edit_permohonan', compact('user', 'permohonan', 'kegiatans'));
    }

    public function update(Request $request, $slug)
    {

        $this->validate($request, [
            'nama'                		   => 'required|min:3|max:150',
            'kegiatan' 				 	   => 'required',
            'pemohon'                  	   => 'required|min:3|max:150',
            'nomorinduk'                   => 'required|min:3|max:150',
            'latarbelakangkegiatan'        => 'required|min:3|max:1000',
            'tujuankegiatan'               => 'required|min:3|max:1000',
            'tempatkegiatan'               => 'required|min:3|max:150',
            'tanggalkegiatan'              => 'required|date',
            'pesertakegiatan'              => 'required|min:3|max:1000',
            'strategipencapaiankeluaran'   => 'required|min:3|max:1000',
            'susunanpanitia'               => 'required|min:3|max:1000',
            'filetor'                      => 'nullable|mimes:pdf|max:10000kb',
        ],[
            'nama.required'=>'Nama Permohonan harus diisi',
            'nama.min'=>'Nama Permohonan minimal 3 huruf',
            'nama.max'=>'Nama Permohonan maksimal 150 huruf',

            'kegiatan.required'=>'Kategori harus diisi',

            'pemohon.required'=>'Nama Pemohon harus diisi',
            'pemohon.min'=>'Nama Pemohon minimal 3 huruf',
            'pemohon.max'=>'Nama Pemohon maksimal 150 huruf',

            'nomorinduk.required'=>'Nomor induk harus diisi',
            'nomorinduk.min'=>'Nomor induk minimal 3 angka',
            'nomorinduk.max'=>'Nomor induk maksimal 150 angka',

            'latarbelakangkegiatan.required'=>'Latar Belakang Kegiatan harus diisi',
            'latarbelakangkegiatan.min'=>'Latar Belakang Kegiatan minimal 3 huruf',
            'latarbelakangkegiatan.max'=>'Latar Belakang Kegiatan maksimal 1000 huruf',

            'tujuankegiatan.required'=>'Tujuan Kegiatan harus diisi',
            'tujuankegiatan.min'=>'Tujuan Kegiatan minimal 3 huruf',
            'tujuankegiatan.max'=>'Tujuan Kegiatan maksimal 1000 huruf',

            'tempatkegiatan.required'=>'Tempat Kegiatan harus diisi',
            'tempatkegiatan.min'=>'Tempat Kegiatan minimal 3 huruf',
            'tempatkegiatan.max'=>'Tempat Kegiatan maksimal 150 huruf',

            'tanggalkegiatan.required'=>'Tanggal Kegiatan harus diisi',

            'pesertakegiatan.required'=>'Peserta Kegiatan harus diisi',
            'pesertakegiatan.min'=>'Peserta Kegiatan minimal 3 huruf',
            'pesertakegiatan.max'=>'Peserta Kegiatan maksimal 1000 huruf',

            'strategipencapaiankeluaran.required'=>'Strategi Pencapaian Keluaran harus diisi',
            'strategipencapaiankeluaran.min'=>'Strategi Pencapaian Keluaran minimal 3 huruf',
            'strategipencapaiankeluaran.max'=>'Strategi Pencapaian Keluaran maksimal 1000 huruf',

            'susunanpanitia.required'=>'Susunan Panitia harus diisi',
            'susunanpanitia.min'=>'Susunan Panitia minimal 3 huruf',
            'susunanpanitia.max'=>'Susunan Panitia maksimal 1000 huruf',

            'filetor.max'=>'File TOR maksimal 5Mb',
            'filetor.mimes'=>'File TOR harus berformat .pdf',
        ]);

        $permohonan = Permohonan::where('slug',$slug)->first();

        $kegiatan = Kegiatan::where('id', $permohonan->kegiatan_id)->first();
        $kegiatan->keterangan = null;
        $kegiatan->save();

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
        $permohonan->nomorinduk = $request['nomorinduk'];
        $permohonan->kegiatan_id = $request['kegiatan'];
        $permohonan->totalbiaya = $kegiatan->maksimaldana;
        $permohonan->latarbelakangkegiatan = $request['latarbelakangkegiatan'];
        $permohonan->tujuankegiatan = $request['tujuankegiatan'];
        $permohonan->tanggalkegiatan = $request['tanggalkegiatan'];
        $permohonan->tempatkegiatan = $request['tempatkegiatan'];
        $permohonan->pesertakegiatan = $request['pesertakegiatan'];
        $permohonan->strategipencapaiankeluaran = $request['strategipencapaiankeluaran'];
        $permohonan->susunanpanitia = $request['susunanpanitia'];
        if($request->file('filetor')){
        //file
        $file = $request->file('filetor');
        $filetor = time().rand(1000,9999).'.'.$file->getClientOriginalExtension();
        $request->file('filetor')->move(public_path('/filetor'), $filetor);
        $permohonan->filetor = $filetor;
    	}
        $permohonan->updated_by = Auth::user()->id;
        $permohonan->save();
        $kegiatan->keterangan = 'Sudah Dibuat';
        $kegiatan->save();
        Auth::user()->update(['tor'=>1]);

        return redirect()->action('PermohonanController@show', [$slug])->with('msg', 'Permohonan berhasil diedit!');
    }

    public function destroy($slug){
        $permohonan = Permohonan::where('slug',$slug)->first();
        $kegiatan = Kegiatan::where('id', $permohonan->kegiatan_id)->first();
        $kegiatan->keterangan = null;
        $kegiatan->save();
        Auth::user()->update(['tor'=>null]);
        $permohonan->delete();
        return redirect()->action('PermohonanController@index')->with('msg', 'Permohonan berhasil dihapus!');
    }

    public function submit(Request $request, $slug){
        $users = User::where('id', '!=', 1)->get();
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 1;
        $permohonan->keterangan = 'permohonan sedang berada di WD2';
        $permohonan->save();
        foreach ($users as $user) {
            if ($user->permissionsGroup->dispo1p_status == 1) {
                $user->notify(new SubmitPermohonan);
            }
        }
        return redirect()->action('PermohonanController@index')->with('msg', 'Permohonan berhasil disubmit!');
    }

}
