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
use Illuminate\Support\Facades\Validator;

class SpjController extends Controller
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
    	$permohonans = permohonan::where('created_by', $user->id)->where('status', '!=' ,0)->where('status', '!=' ,1)->where('status', '!=' ,2)->where('status', '!=' ,3)->where('status', '!=' ,4)->where('status', '!=' ,9)->orderBy('updated_at', 'desc')->get();
        return view('spj.index_spj', compact('kegiatans', 'user', 'permohonans'));
    }

    public function show($slug) {
        $user = Auth::user();
        $permohonan = Permohonan::where('slug',$slug)->first();
        if(empty($permohonan)) abort (404);
        $rincians = Rincian::where('permohonan_id',$permohonan->id)->get();
        return view('spj.single_spj', compact('user', 'permohonan', 'rincians'));
    }

    public function submitFile(Request $request, $slug)
    {
        $permohonan = Permohonan::where('slug',$slug)->first();
        if(empty($permohonan)) abort (404);

        $validator = Validator::make($request->all(), [
            'filespj'=>'required|mimes:pdf|max:10000kb',
        ],[
            'filespj.required'=>'file spj harus diisi',
            'filespj.mimes'=>'file spj harus berformat .pdf',
            'filespj.max'=>'file spj maksimal berukuran 10Mb'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(['tab'=>'spj'])->with('error_code', 'spj');
        }
        //file
        $file = $request->file('filespj');
        $filespj = time().rand(1000,9999).'.'.$file->getClientOriginalExtension();
        $request->file('filespj')->move(public_path('/filespj'), $filespj);

        $permohonan->filespj = $filespj;
        $permohonan->keterangan = 'File Spj Telah Di Submit';
        $permohonan->save();

        return back()->withInput(['tab'=>'spj'])->with('msg', 'SPJ berhasil di submit!');
    }

    public function submit(Request $request, $slug){
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 6;
        $permohonan->keterangan = 'spj sedang berada di Kasubag';
        $permohonan->save();
        return redirect()->action('SpjController@index')->with('msg', 'SPJ berhasil disubmit!');
    }
}
