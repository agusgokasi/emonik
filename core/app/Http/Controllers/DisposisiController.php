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
use App\Notifications\Dis1Permohonan;
use App\Notifications\Dis2Permohonan;
use App\Notifications\Dt2Permohonan;
use Illuminate\Support\Facades\Validator;

class DisposisiController extends Controller
{
    public function dis1(){
    	if (Auth::user()->permissionsGroup->dispo1p_status) {
    	$permohonans = permohonan::where('status', 1)->orderBy('updated_at', 'desc')->get();
        $users = User::where('id', '!=', 1)->get();
        if (auth()->user()->permissionsGroup->dispo1p_status == 1) {
            foreach ($users as $user) {
                $user->unreadNotifications->where('type', 'App\Notifications\SubmitPermohonan')->markAsRead();
            }
        }
        return view('disposisi.index_disposisi', compact('permohonans'));
    	} 
    	return abort(403);
    }

    public function di1(Request $request, $slug) {
    	if (Auth::user()->permissionsGroup->dispo1p_status) {
        $users = User::where('id', '!=', 1)->get();
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 2;
        $permohonan->keterangan = 'permohonan sedang berada di PPK';
        $permohonan->save();
        foreach ($users as $user) {
            if ($user->permissionsGroup->dispo2p_status == 1) {
                $user->notify(new Dis1Permohonan);
            }
        }
        return redirect()->action('DisposisiController@dis1')->with('msg', 'Permohonan berhasil dilanjutkan!');
    	}
    	return abort(403);
    }

    public function dis2(){
    	if (Auth::user()->permissionsGroup->dispo2p_status) {
    	$permohonans = permohonan::where('status', 2)->orderBy('updated_at', 'desc')->get();
        $users = User::where('id', '!=', 1)->get();
        if (auth()->user()->permissionsGroup->dispo2p_status == 1) {
            foreach ($users as $user) {
                $user->unreadNotifications->where('type', 'App\Notifications\Dis1Permohonan')->markAsRead();
            }
        }
        return view('disposisi.index_disposisi', compact('permohonans'));
    	}
    	return abort(403);
    }

    public function dt2(Request $request, $slug) {
    	if (Auth::user()->permissionsGroup->dispo2p_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $user = User::where('id', $permohonan->created_by)->first();
        if ($user->permissionsGroup->permohonan_status == 1) {
            $user->notify(new Dt2Permohonan);
        }
        $validator = Validator::make($request->all(), [
        'keterangan'              => 'required|min:3|max:1000',
        'revisi'                 => 'required|mimes:pdf|max:10000kb'
        ],[
            'keterangan.required'=>'Keterangan harus diisi',
            'keterangan.min'=>'Keterangan minimal 3 huruf',
            'keterangan.max'=>'Keterangan minimal 1000 huruf',

            'revisi.required'=>'Bukti Penolakan harus diisi',
            'revisi.mimes'=>'Bukti Penolakan berformat .pdf',
            'revisi.max'=>'Bukti Penolakan maksimal 10Mb',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $slug);
        }
        //file
        $file = $request->file('revisi');
        $revisi = time().rand(1000,9999).'.'.$file->getClientOriginalExtension();
        $request->file('revisi')->move(public_path('/revisi'), $revisi);

        $permohonan->status = 9;
        $permohonan->revisi = $revisi;
        $permohonan->keterangan = $request['keterangan'];
        $permohonan->save();
        return redirect()->action('DisposisiController@dis2')->with('msg', 'Permohonan berhasil ditolak!');
    	}
    	return abort(403);
    }

    public function di2(Request $request, $slug) {
    	if (Auth::user()->permissionsGroup->dispo2p_status) {
        $users = User::where('id', '!=', 1)->get();
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 3;
        $permohonan->keterangan = 'permohonan sedang berada di kasubag';
        $permohonan->save();
        foreach ($users as $user) {
            if ($user->permissionsGroup->dispo3p_status == 1) {
                $user->notify(new Dis2Permohonan);
            }
        }
        return redirect()->action('DisposisiController@dis2')->with('msg', 'Permohonan berhasil dilanjutkan!');
    	}
    	return abort(403);
    }

    public function dis3(){
    	if (Auth::user()->permissionsGroup->dispo3p_status) {
    	$permohonans = permohonan::where('status', 3)->orderBy('updated_at', 'desc')->get();
        $users = User::where('id', '!=', 1)->get();
        if (auth()->user()->permissionsGroup->dispo3p_status == 1) {
            foreach ($users as $user) {
                $user->unreadNotifications->where('type', 'App\Notifications\Dis2Permohonan')->markAsRead();
            }
        }
        return view('disposisi.index_disposisi', compact('permohonans'));
    	} 
    	return abort(403);
    }

    public function di3(Request $request, $slug) {
    	if (Auth::user()->permissionsGroup->dispo3p_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 4;
        $permohonan->keterangan = 'permohonan sudah disetujui Kasubag, silahkan ambil dana di BPP';
        $permohonan->save();
        return redirect()->action('DisposisiController@dis3')->with('msg', 'Permohonan berhasil dilanjutkan!');
    	}
    	return abort(403);
    }

    public function dis4(){
    	if (Auth::user()->permissionsGroup->dispo4p_status) {
    	$permohonans = permohonan::where('status', 4)->orderBy('updated_at', 'desc')->get();
        return view('disposisi.index_disposisi', compact('permohonans'));
    	} 
    	return abort(403);
    }

    public function di4(Request $request, $slug) {
    	if (Auth::user()->permissionsGroup->dispo4p_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 5;
        $permohonan->keterangan = 'dana diterima, segera buat spj paling lambat 1 minggu setelah dana diterima';
        $permohonan->save();
        return redirect()->action('DisposisiController@dis4')->with('msg', 'Permohonan berhasil dilanjutkan!');
    	}
    	return abort(403);
    }

    public function show($slug) {
    	$user = Auth::user();
    	$permohonan = Permohonan::where('slug',$slug)->first();
    	if(empty($permohonan)) abort (404);
    	$rincians = Rincian::where('permohonan_id',$permohonan->id)->get();
        return view('disposisi.single_disposisi', compact('user', 'permohonan', 'rincians'));
    }

    public function dis5(){
        if (Auth::user()->permissionsGroup->dispo1s_status) {
        $permohonans = permohonan::where('status', 6)->orderBy('updated_at', 'desc')->get();
        return view('disposisi.index_dispj', compact('permohonans'));
        }
        return abort(403);
    }

    public function dt5(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo1s_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $validator = Validator::make($request->all(), [
        'keterangan'              => 'required|min:3|max:1000',
        'spj_tolak_kas'                 => 'required|mimes:pdf|max:10000kb'
        ],[
            'keterangan.required'=>'Keterangan harus diisi',
            'keterangan.min'=>'Keterangan minimal 3 huruf',
            'keterangan.max'=>'Keterangan minimal 1000 huruf',

            'spj_tolak_kas.required'=>'Bukti Penolakan harus diisi',
            'spj_tolak_kas.mimes'=>'Bukti Penolakan berformat .pdf',
            'spj_tolak_kas.max'=>'Bukti Penolakan maksimal 10Mb',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $slug);
        }
        //file
        $file = $request->file('spj_tolak_kas');
        $spj_tolak_kas = time().rand(1000,9999).'.'.$file->getClientOriginalExtension();
        $request->file('spj_tolak_kas')->move(public_path('/spj_tolak_kas'), $spj_tolak_kas);

        $permohonan->status = 8;
        $permohonan->spj_tolak_kas = $spj_tolak_kas;
        $permohonan->keterangan = $request['keterangan'];
        $permohonan->save();
        return redirect()->action('DisposisiController@dis5')->with('msg', 'SPJ berhasil ditolak!');
        }
        return abort(403);
    }

    public function di5(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo1s_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 7;
        $permohonan->keterangan = 'spj sedang berada di BPP';
        $permohonan->save();
        return redirect()->action('DisposisiController@dis5')->with('msg', 'SPJ berhasil dilanjutkan!');
        }
        return abort(403);
    }

    public function dis6(){
        if (Auth::user()->permissionsGroup->dispo2s_status) {
        $permohonans = permohonan::where('status', 7)->orderBy('updated_at', 'desc')->get();
        return view('disposisi.index_dispj', compact('permohonans'));
        }
        return abort(403);
    }

    public function dt6(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo2s_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $validator = Validator::make($request->all(), [
        'keterangan'              => 'required|min:3|max:1000',
        'spj_tolak_ppk'                 => 'required|mimes:pdf|max:10000kb'
        ],[
            'keterangan.required'=>'Keterangan harus diisi',
            'keterangan.min'=>'Keterangan minimal 3 huruf',
            'keterangan.max'=>'Keterangan minimal 1000 huruf',

            'spj_tolak_ppk.required'=>'Bukti Penolakan harus diisi',
            'spj_tolak_ppk.mimes'=>'Bukti Penolakan berformat .pdf',
            'spj_tolak_ppk.max'=>'Bukti Penolakan maksimal 10Mb',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $slug);
        }
        //file
        $file = $request->file('spj_tolak_ppk');
        $spj_tolak_ppk = time().rand(1000,9999).'.'.$file->getClientOriginalExtension();
        $request->file('spj_tolak_ppk')->move(public_path('/spj_tolak_ppk'), $spj_tolak_ppk);

        $permohonan->status = 8;
        $permohonan->spj_tolak_ppk = $spj_tolak_ppk;
        $permohonan->keterangan = $request['keterangan'];
        $permohonan->save();
        return redirect()->action('DisposisiController@dis6')->with('msg', 'SPJ berhasil ditolak!');
        }
        return abort(403);
    }

    public function di6(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo2s_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        if($permohonan->created_by){
            $user = User::where('id', $permohonan->created_by)->first();
            $user->tor = null;
            $user->save();
        }
        $permohonan->status = 10;
        $permohonan->keterangan = 'spj selesai';
        $permohonan->save();
        return redirect()->action('DisposisiController@dis6')->with('msg', 'SPJ berhasil dilanjutkan!');
        }
        return abort(403);
    }

    public function spjShow($slug) {
        $user = Auth::user();
        $permohonan = Permohonan::where('slug',$slug)->first();
        if(empty($permohonan)) abort (404);
        $rincians = Rincian::where('permohonan_id',$permohonan->id)->get();
        return view('disposisi.single_dispj', compact('user', 'permohonan', 'rincians'));
    }
}
