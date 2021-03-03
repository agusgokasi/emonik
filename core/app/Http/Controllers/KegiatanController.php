<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Auth;
use File;
use DataTables;
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
        $tahuns = Kegiatan::where('status', 1)->groupBy('tahun')->orderBy('tahun', 'desc')->pluck("tahun");
        $units = Unit::where('status', 1)->get();
        return view('kegiatan.index_kegiatan', compact('kegiatans', 'tahuns', 'units'));
    }

    public function apiKegiatan(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->tahun)){
                $data = Kegiatan::where('status', 1)->where('tahun', $request->tahun)->orderBy('updated_at', 'desc')->get();
            }else{
                $data = Kegiatan::where('status', 1)->orderBy('updated_at', 'desc')->get();
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
                ->addColumn('options', function (Kegiatan $kegiatan) {
                    $units = Unit::where('status', 1)->get();
                    return view('kegiatan._btn_options', compact('kegiatan', 'units'));
                })
                ->rawColumns(['status', 'options'])
                ->toJson();
    }

    public function post(Request $request) {
       $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150'],
            'bulan' => ['required', 'string','max:150'],
            'tahunform' => ['required', 'numeric'],
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000000',
            'unit' => ['required', 'string','max:150'],
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
            'tahunform.required'=>'Tahun harus diisi',
            'maksimaldana.required'=>'Usulan dana harus diisi',
            'maksimaldana.min'=>'dana minimal Rp10.000',
            'maksimaldana.max'=>'dana maksimal Rp100.000.000.000.000',
            'unit.required'=>'Unit harus diisi',
            'unit.max'=>'Unit maksimal 150 huruf',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', 'create');
        }
        $kegiatans = new Kegiatan();
        $kegiatans->nama = $request['nama'];
        $kegiatans->bulan = $request['bulan'];
        $kegiatans->tahun = $request['tahunform'];
        $kegiatans->maksimaldana = $request['maksimaldana'];
        $kegiatans->unit_id = $request['unit'];
        $kegiatans->status = 1;
        $kegiatans->keterangan = "Permohonan Belum Dibuat";
        $kegiatans->created_by = Auth::user()->id;
        $kegiatans->save();
        return back()->with('msg', 'Kegiatan berhasil disimpan!');
    }

    public function update(Request $request, $id) {
        $kegiatans = Kegiatan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150'],
            'bulan' => ['required', 'string','max:150'],
            'tahunform' => ['required', 'numeric'],
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000000',
            'unit' => ['required', 'string','max:150'],
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'bulan.required'=>'Bulan harus diisi',
            'bulan.max'=>'Bulan maksimal 150 huruf',
            'tahunform.required'=>'Tahun harus diisi',
            'maksimaldana.required'=>'Usulan dana harus diisi',
            'maksimaldana.min'=>'dana minimal Rp10.000',
            'maksimaldana.max'=>'dana maksimal Rp100.000.000.000.000',
            'unit.required'=>'Unit harus diisi',
            'unit.max'=>'Unit maksimal 150 huruf',
        ]);

        if ($validator->fails()) {
            // return back()->withErrors($validator)->withInput()->with('dgn', 'Kegiatan gagal diedit, Harap periksa kesalahan!');
            return back()->withErrors($validator)->withInput()->with('error_code', $id);
            // return response()->json(['error'=>$validator->errors()->all()]);
        }
        $kegiatans->nama = $request['nama'];
        $kegiatans->bulan = $request['bulan'];
        $kegiatans->tahun = $request['tahunform'];
        $kegiatans->maksimaldana = $request['maksimaldana'];
        $kegiatans->unit_id = $request['unit'];
        $kegiatans->updated_by = Auth::user()->id;
        $kegiatans->save();
        return back()->with('msg', 'Kegiatan berhasil diedit!');
        // return response()->json(['success'=>'Kegiatan berhasil diedit!']);
    }

    public function destroy($id) 
    {
        $kegiatans = Kegiatan::find($id);
        $kegiatans->delete();
        return redirect()->action('KegiatanController@index')->with('msg', 'Kegiatan berhasil dihapus!');
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
            'maksimaldana' => 'required|numeric|min:10000|max:100000000000000',
        ],[
            'maksimaldana.required'=>'Maksimal dana harus diisi',
            'maksimaldana.min'=>'dana minimal Rp10.000',
            'maksimaldana.max'=>'dana maksimal Rp100.000.000.000.000',
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