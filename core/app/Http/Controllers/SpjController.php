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
use App\Notifications\Dis4Permohonan;
use App\Notifications\SubmitSPJ;
use App\Notifications\Dt1SPJ;
use App\Notifications\Dt2SPJ;
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
    	$permohonans = permohonan::where('created_by', $user->id)->where('status', '!=' ,0)->where('status', '!=' ,1)->where('status', '!=' ,2)->where('status', '!=' ,3)->where('status', '!=' ,4)->where('status', '!=' ,9)->where('status', '!=' ,10)->where('status', '!=' ,11)->orderBy('updated_at', 'desc')->get();
        if (auth()->user()->id) {
            $user->unreadNotifications->where('type', 'App\Notifications\Dis4Permohonan')->markAsRead();
            $user->unreadNotifications->where('type', 'App\Notifications\Dt1SPJ')->markAsRead();
            $user->unreadNotifications->where('type', 'App\Notifications\Dt2SPJ')->markAsRead();
        }
        return view('spj.index_spj', compact('kegiatans', 'user', 'permohonans'));
    }

    public function show($slug) {
        $user = Auth::user();
        $permohonan = Permohonan::where('slug',$slug)->first();
        if(empty($permohonan)) abort (404);
        $rincians = Rincian::where('permohonan_id',$permohonan->id)->get();
        return view('spj.single_spj', compact('user', 'permohonan', 'rincians'));
    }

    public function submit(Request $request, $slug){
        $permohonan = Permohonan::where('slug',$slug)->first();
        $users = User::where('id', '!=', 1)->get();
        $permohonan->status = 6;
        $permohonan->keterangan = 'SPJ sedang berada di Kasubag';
        $permohonan->save();
        foreach ($users as $user) {
            if ($user->permissionsGroup->dispo1s_status == 1) {
                $user->notify(new SubmitSPJ);
            }
        }
        return redirect()->action('SpjController@index')->with('msg', 'SPJ berhasil disubmit!');
    }

}

/*
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
        $file = $request->file('filespj');
        $filespj = time().rand(1000,9999).'.'.$file->getClientOriginalExtension();
        $request->file('filespj')->move(public_path('/filespj'), $filespj);

        $permohonan->filespj = $filespj;
        $permohonan->keterangan = 'File Spj Telah Di Submit';
        $permohonan->save();

        return back()->withInput(['tab'=>'spj'])->with('msg', 'SPJ berhasil di submit!');
    }
*/