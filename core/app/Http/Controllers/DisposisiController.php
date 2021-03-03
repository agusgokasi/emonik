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
use App\Notifications\SubmitPermohonan;
use App\Notifications\Dis1Permohonan;
use App\Notifications\Dis2Permohonan;
use App\Notifications\Dt2Permohonan;
use App\Notifications\Dis3Permohonan;
use App\Notifications\Dt3Permohonan;
use App\Notifications\Dp3Permohonan;
use App\Notifications\Dis4Permohonan;
use App\Notifications\SubmitSPJ;
use App\Notifications\Dis1SPJ;
use App\Notifications\Dt1SPJ;
use App\Notifications\Dis2SPJ;
use App\Notifications\Dt2SPJ;
use Illuminate\Support\Facades\Validator;

class DisposisiController extends Controller
{
    public function dis1(){
    	if (Auth::user()->permissionsGroup->dispo1p_status) {
    	$permohonans = permohonan::where('status', 1)->orderBy('updated_at', 'asc')->get();
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
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
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 2;
        $permohonan->keterangan = 'Permohonan sedang berada di PPK';
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
    	$permohonans = permohonan::where('status', 2)->orderBy('updated_at', 'asc')->get();
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
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
        $pemohon = User::where('id', $permohonan->created_by)->first();
        $validator = Validator::make($request->all(), [
        'keterangan'             => 'required|min:3|max:1000',
        'revisi'                 => 'required|mimes:pdf|max:10000kb'
        ],[
            'keterangan.required'=>'Alasan ditolak harus diisi',
            'keterangan.min'=>'Alasan ditolak minimal 3 huruf',
            'keterangan.max'=>'Alasan ditolak minimal 1000 huruf',

            'revisi.required'=>'Bukti Penolakan harus diisi',
            'revisi.mimes'=>'Bukti Penolakan berformat .pdf',
            'revisi.max'=>'Bukti Penolakan maksimal 10Mb',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $slug);
        }
        //file
        $file = $request->file('revisi');
        $revisi = $file->getClientOriginalName();
        if(Permohonan::where('revisi',$revisi)->first() !=null) {
            $revisi = time().rand(0,9).$file->getClientOriginalName();
        }
        $request->file('revisi')->move(public_path('/uploadfile/revisi'), $revisi);

        if ($permohonan->revisi) {
            if(is_file('uploadfile/revisi/'.$permohonan->revisi)){
            unlink(public_path('uploadfile/revisi/'.$permohonan->revisi));
            }
        }
        
        $permohonan->status = 9;
        $permohonan->revisi = $revisi;
        $permohonan->keterangan = $request['keterangan'];
        $permohonan->save();
        if ($pemohon->permissionsGroup->permohonan_status == 1) {
            $pemohon->notify(new Dt2Permohonan);
        }
        return redirect()->action('DisposisiController@dis2')->with('msg', 'Permohonan berhasil ditolak!');
    	}
    	return abort(403);
    }

    public function di2(Request $request, $slug) {
    	if (Auth::user()->permissionsGroup->dispo2p_status) {
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 3;
        $permohonan->keterangan = 'Permohonan sedang berada di Kasubag';
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
    	$permohonans = permohonan::where('status', 3)->orderBy('updated_at', 'asc')->get();
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        if (auth()->user()->permissionsGroup->dispo3p_status == 1) {
            foreach ($users as $user) {
                $user->unreadNotifications->where('type', 'App\Notifications\Dis2Permohonan')->markAsRead();
            }
        }
        return view('disposisi.index_disposisi', compact('permohonans'));
    	} 
    	return abort(403);
    }

    public function dt3(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo3p_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $pemohon = User::where('id', $permohonan->created_by)->first();
        $validator = Validator::make($request->all(), [
        'keterangan'              => 'required|min:3|max:1000',
        'revisi2'              => 'required|mimes:pdf|max:10000kb'
        ],[
            'keterangan.required'=>'Alasan ditolak harus diisi',
            'keterangan.min'=>'Alasan ditolak minimal 3 huruf',
            'keterangan.max'=>'Alasan ditolak minimal 1000 huruf',

            'revisi2.required'=>'Bukti Penolakan harus diisi',
            'revisi2.mimes'=>'Bukti Penolakan berformat .pdf',
            'revisi2.max'=>'Bukti Penolakan maksimal 10Mb',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', 'dt3'.$slug);
        }
        //file
        $file = $request->file('revisi2');
        $revisi2 = $file->getClientOriginalName();
        if(Permohonan::where('revisi2',$revisi2)->first() !=null) {
            $revisi2 = time().rand(0,9).$file->getClientOriginalName();
        }
        $request->file('revisi2')->move(public_path('/uploadfile/revisi2'), $revisi2);

        if ($permohonan->revisi2) {
            if(is_file('uploadfile/revisi2/'.$permohonan->revisi2)){
            unlink(public_path('uploadfile/revisi2/'.$permohonan->revisi2));
            }
        }

        $permohonan->status = 11;
        $permohonan->revisi2 = $revisi2;
        $permohonan->keterangan = $request['keterangan'];
        $permohonan->save();
        if ($pemohon->permissionsGroup->permohonan_status == 1) {
            $pemohon->notify(new Dt3Permohonan);
        }
        return redirect()->action('DisposisiController@dis3')->with('msg', 'Permohonan berhasil ditolak!');
        }
        return abort(403);
    }

    public function di3(Request $request, $slug) {
    	if (Auth::user()->permissionsGroup->dispo3p_status) {
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        $permohonan = Permohonan::where('slug',$slug)->first();
        $permohonan->status = 4;
        $permohonan->keterangan = 'Permohonan sedang berada di BPP';
        $permohonan->save();
        foreach ($users as $user) {
            if ($user->permissionsGroup->dispo4p_status == 1) {
                $user->notify(new Dis3Permohonan);
            }
        }
        return redirect()->action('DisposisiController@dis3')->with('msg', 'Permohonan berhasil dilanjutkan!');
    	}
    	return abort(403);
    }

    public function dis4(){
    	if (Auth::user()->permissionsGroup->dispo4p_status) {
    	$permohonans = permohonan::where('status', 4)->orderBy('updated_at', 'asc')->get();
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        if (auth()->user()->permissionsGroup->dispo4p_status == 1) {
            foreach ($users as $user) {
                $user->unreadNotifications->where('type', 'App\Notifications\Dis3Permohonan')->markAsRead();
            }
        }
        return view('disposisi.index_disposisi', compact('permohonans'));
    	} 
    	return abort(403);
    }

    public function dp4(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo4p_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $pemohon = User::where('id', $permohonan->created_by)->first();
        $permohonan->keterangan = 'Dana sudah tersedia, silahkan ambil dana';
        $permohonan->save();
        if ($pemohon->permissionsGroup->permohonan_status == 1) {
            $pemohon->notify(new Dp3Permohonan);
        }
        return redirect()->action('DisposisiController@dis4')->with('msg', 'Notifikasi pengambilan dana telah terkirim!');
        }
        return abort(403);
    }

    public function di4(Request $request, $slug) {
    	if (Auth::user()->permissionsGroup->dispo4p_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $user = User::where('id', $permohonan->created_by)->first();
        $permohonan->status = 5;
        $permohonan->keterangan = 'Dana diterima, segera buat spj paling lambat 1 minggu setelah dana diterima';
        $permohonan->save();
        if ($user->permissionsGroup->permohonan_status == 1) {
            $user->notify(new Dis4Permohonan);
        }
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
        $permohonans = permohonan::where('status', 6)->orderBy('updated_at', 'asc')->get();
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        if (auth()->user()->permissionsGroup->dispo1s_status == 1) {
            foreach ($users as $user) {
                $user->unreadNotifications->where('type', 'App\Notifications\SubmitSPJ')->markAsRead();
            }
        }
        return view('disposisi.index_dispj', compact('permohonans'));
        }
        return abort(403);
    }

    public function dt5(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo1s_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $pemohon = User::where('id', $permohonan->created_by)->first();
        $validator = Validator::make($request->all(), [
        'keterangan'              => 'required|min:3|max:1000',
        'spj_tolak_kas'                 => 'required|mimes:pdf|max:10000kb'
        ],[
            'keterangan.required'=>'Alasan ditolak harus diisi',
            'keterangan.min'=>'Alasan ditolak minimal 3 huruf',
            'keterangan.max'=>'Alasan ditolak minimal 1000 huruf',

            'spj_tolak_kas.required'=>'Bukti Penolakan harus diisi',
            'spj_tolak_kas.mimes'=>'Bukti Penolakan berformat .pdf',
            'spj_tolak_kas.max'=>'Bukti Penolakan maksimal 10Mb',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $slug);
        }
        //file
        $file = $request->file('spj_tolak_kas');
        $spj_tolak_kas = $file->getClientOriginalName();
        if(Permohonan::where('spj_tolak_kas',$spj_tolak_kas)->first() !=null) {
            $spj_tolak_kas = time().rand(0,9).$file->getClientOriginalName();
        }
        $request->file('spj_tolak_kas')->move(public_path('/uploadfile/spj_tolak_kas'), $spj_tolak_kas);

        if ($permohonan->spj_tolak_kas) {
            if(is_file('uploadfile/spj_tolak_kas/'.$permohonan->spj_tolak_kas)){
            unlink(public_path('uploadfile/spj_tolak_kas/'.$permohonan->spj_tolak_kas));
            }
        }

        $permohonan->status = 8;
        $permohonan->spj_tolak_kas = $spj_tolak_kas;
        $permohonan->keterangan = $request['keterangan'];
        $permohonan->save();
        if ($pemohon->permissionsGroup->permohonan_status == 1) {
            $pemohon->notify(new Dt1SPJ);
        }
        return redirect()->action('DisposisiController@dis5')->with('msg', 'SPJ berhasil ditolak!');
        }
        return abort(403);
    }

    public function di5(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo1s_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        $permohonan->status = 7;
        $permohonan->keterangan = 'spj sedang berada di BPP';
        $permohonan->save();
        foreach ($users as $user) {
            if ($user->permissionsGroup->dispo2s_status == 1) {
                $user->notify(new Dis1SPJ);
            }
        }
        return redirect()->action('DisposisiController@dis5')->with('msg', 'SPJ berhasil dilanjutkan!');
        }
        return abort(403);
    }

    public function dis6(){
        if (Auth::user()->permissionsGroup->dispo2s_status) {
        $permohonans = permohonan::where('status', 7)->orderBy('updated_at', 'asc')->get();
        $users = User::where('id', '!=', 1)->where('status', 1)->get();
        if (auth()->user()->permissionsGroup->dispo2s_status == 1) {
            foreach ($users as $user) {
                $user->unreadNotifications->where('type', 'App\Notifications\Dis1SPJ')->markAsRead();
            }
        }
        return view('disposisi.index_dispj', compact('permohonans'));
        }
        return abort(403);
    }

     public function dt6(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo2s_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $pemohon = User::where('id', $permohonan->created_by)->first();
        $validator = Validator::make($request->all(), [
        'keterangan'              => 'required|min:3|max:1000',
        'spj_tolak_bpp'           => 'required|mimes:pdf|max:10000kb'
        ],[
            'keterangan.required'=>'Alasan ditolak harus diisi',
            'keterangan.min'=>'Alasan ditolak minimal 3 huruf',
            'keterangan.max'=>'Alasan ditolak minimal 1000 huruf',

            'spj_tolak_bpp.required'=>'Bukti Penolakan harus diisi',
            'spj_tolak_bpp.mimes'=>'Bukti Penolakan berformat .pdf',
            'spj_tolak_bpp.max'=>'Bukti Penolakan maksimal 10Mb',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $slug);
        }

        $file = $request->file('spj_tolak_bpp');
        $spj_tolak_bpp = $file->getClientOriginalName();
        if(Permohonan::where('spj_tolak_bpp',$spj_tolak_bpp)->first() !=null) {
            $spj_tolak_bpp = time().rand(0,9).$file->getClientOriginalName();
        }
        $request->file('spj_tolak_bpp')->move(public_path('/uploadfile/spj_tolak_bpp'), $spj_tolak_bpp);

        if ($permohonan->spj_tolak_bpp) {
            if(is_file('uploadfile/spj_tolak_bpp/'.$permohonan->spj_tolak_bpp)){
            unlink(public_path('uploadfile/spj_tolak_bpp/'.$permohonan->spj_tolak_bpp));
            }
        }
        
        $permohonan->status = 8;
        $permohonan->spj_tolak_bpp = $spj_tolak_bpp;
        $permohonan->keterangan = $request['keterangan'];
        $permohonan->save();
        if ($pemohon->permissionsGroup->permohonan_status == 1) {
            $pemohon->notify(new Dt2SPJ);
        }
        return redirect()->action('DisposisiController@dis6')->with('msg', 'SPJ berhasil ditolak!');
        }
        return abort(403);
    } 

    public function di6(Request $request, $slug) {
        if (Auth::user()->permissionsGroup->dispo2s_status) {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $validator = Validator::make($request->all(), [
        'keterangan'              => 'required|min:3|max:1000',
        ],[
            'keterangan.required'=>'Catatan harus diisi',
            'keterangan.min'=>'Catatan minimal 3 huruf',
            'keterangan.max'=>'Catatan minimal 1000 huruf',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $slug);
        }
        if($permohonan->created_by){
            $user = User::where('id', $permohonan->created_by)->first();
            $user->tor = null;
            $user->save();
            if ($user->permissionsGroup->permohonan_status == 1) {
            $user->notify(new Dis2SPJ);
            }
        }
        $permohonan->status = 10;
        $permohonan->keterangan = $request['keterangan'];
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
