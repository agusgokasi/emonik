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
use App\Exports\RinciansExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class HistoriController extends Controller
{
    public function index() {
    	$user = Auth::user();
    	$kegiatans = Kegiatan::where('unit_id', $user->unit_id)->where('status', 1)->where('keterangan', null)->get();
    	if(Auth::user()->permissionsGroup->view_status){
    		$permohonans = permohonan::orderBy('updated_at', 'desc')->get();
    	}else{
    		$permohonans = permohonan::where('created_by', $user->id)->orderBy('updated_at', 'desc')->get();
    	}
        return view('histori.index_histori', compact('kegiatans', 'user', 'permohonans'));
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
        return (new RinciansExport)->forId($id)->download($slug.'Rincian.xlsx');
    }
}
