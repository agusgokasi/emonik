<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Auth;
use File;
use DataTables;
use Illuminate\Http\Request;
use Redirect;
use App\Kategori;
use App\Kegiatan;
use App\Unit;
use App\Permohonan;
use App\Rincian;
use App\Exports\RinciansExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\Dis2SPJ;
use Illuminate\Support\Facades\Validator;

class HistoriController extends Controller
{
    public function backup_index() {
    	$user = Auth::user();
    	$kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->where('keterangan', null)->get();
    	if(Auth::user()->permissionsGroup->view_status){
    		$permohonans = Permohonan::orderBy('updated_at', 'desc')->get();
    	}else{
    		$permohonans = Permohonan::where('created_by', $user->id)->orderBy('updated_at', 'desc')->get();
            if (auth()->user()->id) {
                $user->unreadNotifications->where('type', 'App\Notifications\Dis2SPJ')->markAsRead();
            }
    	}
        return view('histori.index_histori', compact('kegiatans', 'user', 'permohonans'));
    }

    public function index() {
        $user = Auth::user();
        if (Auth::user()->permissionsGroup->permohonan_status){
            if (auth()->user()->id) {
                    $user->unreadNotifications->where('type', 'App\Notifications\Dis2SPJ')->markAsRead();
                }
        }
        return view('histori.index_histori', compact('user'));
    }

    public function apiHistori(Request $request) {
        $user = Auth::user();
        if(request()->ajax()){
            if(!empty($request->from_date)){
                $from_date = date('Y-m-d', strtotime($request->from_date));
                $to_date = date('Y-m-d', strtotime($request->to_date));
                if(Auth::user()->permissionsGroup->view_status){
                    $data = Permohonan::whereBetween('created_at', [$from_date, $to_date])->orWhereBetween('updated_at', [$from_date, $to_date])->orderBy('updated_at', 'desc')->get();
                }else{
                    $data = Permohonan::where('created_by', $user->id)->whereBetween('created_at', [$from_date, $to_date])->orWhereBetween('updated_at', [$from_date, $to_date])->orderBy('updated_at', 'desc')->get();
                }
            }else{
                if(Auth::user()->permissionsGroup->view_status){
                    $data = Permohonan::orderBy('updated_at', 'desc')->get();
                }else{
                    $data = Permohonan::where('created_by', $user->id)->orderBy('updated_at', 'desc')->get();
                }
            }
        }
        
        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('nama', function ($model) {
                    return '<small>'.$model->nama.'</small>';
                })
                ->editColumn('pemohon', function ($model) {
                    return '<small>'.$model->pemohon.'</small>';
                })
                ->editColumn('created_at', function ($model) {
                    // return $model->created_at ? with($model->created_at)->format('d-m-Y') : '';
                    return '<small>'.date('d-m-Y', strtotime($model->created_at)).'</small>';
                })
                ->editColumn('updated_at', function ($model) {
                    // return $model->updated_at ? with($model->updated_at)->format('d-m-Y') : '';
                    return '<small>'.date('d-m-Y', strtotime($model->updated_at)).'</small>';
                })
                ->editColumn('status', function ($model) {
                    
                    if ($model->status==10) {
                        return '<small><center>Selesai</center></small>';
                    }else{
                        return '<small><center>Diproses</center></small>';
                    }
                })
                ->editColumn('keterangan', function ($model) {
                    
                    if (!$model->keterangan) {
                        return '<small><center>-</center></small>';
                    }else{
                        return '<small>'.$model->keterangan.'</small>';
                    }
                })
                ->addColumn('detail', function (Permohonan $permohonan) {
                    return view('histori._btn_detail', compact('permohonan'));
                })
                ->rawColumns(['nama', 'pemohon', 'created_at', 'updated_at', 'status', 'keterangan'])
                ->toJson();
    }

    public function show($slug) {
    	$user = Auth::user();
    	$permohonan = Permohonan::where('slug',$slug)->first();
    	if(empty($permohonan)) abort (404);
    	$rincians = Rincian::where('permohonan_id',$permohonan->id)->get();
        return view('histori.single_histori', compact('user', 'permohonan', 'rincians'));
    }

    //export excel
    public function export($slug) 
    {
        $permohonan = Permohonan::where('slug',$slug)->first();
        $id = $permohonan->id;
        // $rincians = $export->where('permohonan_id',$permohonan->id)->get();
        // return Excel::download($export::query()->whereYear('created_at', $this->year), 'rincians.xlsx');
        // return Excel::download($export, 'rincians.xlsx');
        // return Excel::download(new RinciansExport, 'rincians.xlsx');
        return (new RinciansExport)->forId($id)->download($slug.' Laporan.xlsx');
    }
}
