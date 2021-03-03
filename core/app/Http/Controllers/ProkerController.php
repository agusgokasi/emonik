<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Auth;
use File;
use DataTables;
use Illuminate\Http\Request;
use Redirect;
use App\Kegiatan;
use App\Unit;
use App\Permohonan;
use App\Rincian;
use App\Notifications\SubmitProker;
use Illuminate\Support\Facades\Validator;

class ProkerController extends Controller
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
        $tahuns = Kegiatan::where('status', 1)->groupBy('tahun')->orderBy('tahun', 'desc')->pluck("tahun");
        if (auth()->user()->id) {
            $user->unreadNotifications->where('type', 'App\Notifications\TerimaProker')->markAsRead();
            // $user->unreadNotifications->where('type', 'App\Notifications\TolakProker')->markAsRead();
        }
        return view('proker.kegiatan', compact('tahuns'));
    }

    public function apiKegiatan(Request $request) {
    	$user = Auth::user();
        if(request()->ajax()){
            if(!empty($request->tahun)){
                $data = Kegiatan::where('status', 1)->where('unit_id', $user->unit_id)->where('tahun', $request->tahun)->orderBy('updated_at', 'desc')->get();
            }else{
                $data = Kegiatan::where('status', 1)->where('unit_id', $user->unit_id)->orderBy('updated_at', 'desc')->get();
            }
        }
        
        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('maksimaldana', function ($model) {
                    return 'Rp'.format_uang($model->maksimaldana);
                })
                ->editColumn('unit_id', function ($model) {
                    
                    if (!$model->unit_id) {
                        return 'Tidak Punya Unit';
                    }else{
                        return $model->unit->nama;
                    }
                })
                ->editColumn('status', function ($model) {
                    
                    if ($model->status==1) {
                        return '<center><i class="fa fa-check text-success"></i></center>';
                    }elseif ($model->status==9) {
                        return '<center><i class="fa fa-hourglass-half text-primary inline"></i></center>';
                    }else{
                        return '<center><i class="fa fa-times text-danger inline"></i></center>';
                    }
                })
                ->editColumn('keterangan', function ($model) {
                    
                    if (!$model->keterangan) {
                        return 'Proker Belum Disubmit';
                    }else{
                        return $model->keterangan;
                    }
                })
                ->rawColumns(['status'])
                ->toJson();
    }

    public function indexProker() {
    	$user = Auth::user();
    	$kegiatans = Kegiatan::where('status', '!=' , 1)->where('unit_id', $user->unit_id)->orderBy('updated_at', 'desc')->get();
        if (auth()->user()->id) {
            // $user->unreadNotifications->where('type', 'App\Notifications\TerimaProker')->markAsRead();
            $user->unreadNotifications->where('type', 'App\Notifications\TolakProker')->markAsRead();
        }
        return view('proker.proker', compact('kegiatans'));
    }

    public function postProker(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150'],
            'bulan' => ['required', 'string','max:150'],
            'tahun' => ['required', 'numeric'],
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000000',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
            'tahun.required'=>'Tahun harus diisi',
            'maksimaldana.required'=>'Usulan dana harus diisi',
            'maksimaldana.min'=>'dana minimal Rp10.000',
            'maksimaldana.max'=>'dana maksimal Rp100.000.000.000.000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', 'create');
        }
        $kegiatans = new Kegiatan();
        $kegiatans->nama = $request['nama'];
        $kegiatans->bulan = $request['bulan'];
        $kegiatans->tahun = $request['tahun'];
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
            'tahun' => ['required', 'numeric'],
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
            'tahun.required'=>'Tahun harus diisi',
        ]);
        if (!$kegiatans->status){
            $validator = Validator::make($request->all(), [
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000000',
        ],[
            'maksimaldana.required'=>'Usulan dana harus diisi',
            'maksimaldana.min'=>'dana minimal Rp10.000',
            'maksimaldana.max'=>'dana maksimal Rp100.000.000.000.000',
        ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', $id);
        }
        $kegiatans->nama = $request['nama'];
        $kegiatans->bulan = $request['bulan'];
        $kegiatans->tahun = $request['tahun'];
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
        return redirect()->action('ProkerController@indexProker')->with('msg', 'Proker berhasil dihapus!');
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
        return redirect()->action('ProkerController@indexProker')->with('msg', 'Proker berhasil disubmit!');
    }


}
