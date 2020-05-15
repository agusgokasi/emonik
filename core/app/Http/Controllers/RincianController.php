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

class RincianController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->permohonan_status) abort(403);
            return $next($request);
        });
    }

    public function create(Request $request, $id)
    {
        $permohonans = Permohonan::findOrFail($id);
        $validator = Validator::make($request->all(), [
        'jenisbelanja'              => 'required|min:3|max:150',
        'volume'                    => 'required|numeric|min:1|max:999',
        'biayasatuan'               => 'required|numeric|min:1|max:100000000',
        // 'biayasatuan'               => 'required|numeric|max:100000000',
        'satuan'                    => 'required|min:3|max:150',
        ],
        [
            'jenisbelanja.required'=>'jenis belanja harus diisi',
            'jenisbelanja.min'=>'jenis belanja minimal 3 huruf',
            'jenisbelanja.max'=>'jenis belanja maksimal 150 huruf',

            'volume.required'=>'volume harus diisi',
            'volume.min'=>'volume minimal 1 digit angka',
            'volume.max'=>'volume maksimal 999 digit angka',

            'biayasatuan.required'=>'biaya satuan harus diisi',
            'biayasatuan.min'=>'biaya satuan minimal Rp1',
            'biayasatuan.max'=>'biaya satuan maksimal Rp100.000.000',

            'satuan.required'=>'tempat kegiatan harus diisi',
            'satuan.min'=>'tempat kegiatan minimal 3 huruf',
            'satuan.max'=>'tempat kegiatan maksimal 150 huruf',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(['tab'=>'profile'])->with('error_code', 'create');
        }

        $rincian = new Rincian();
        $rincian->permohonan_id = $permohonans->id;
        $rincian->namapermohonan = $permohonans->nama;
        $rincian->namapermohonan = $permohonans->nama;
        $rincian->jenisbelanja = $request['jenisbelanja'];
        $rincian->biayasatuan = $request['biayasatuan'];
        $rincian->satuan = $request['satuan'];
        $rincian->volume = $request['volume'];
        $rincian->biayatotal = $request['biayasatuan'] * $request['volume'];
        $rincian->sisabiaya = $request['biayasatuan'] * $request['volume'];
        $rincian->status = 1;
        $rincian->created_by = Auth::user()->id;
        $rincian->save();

        $permohonans->totalrincian = $permohonans->totalrincian+1;
        $permohonans->biayarincian = $permohonans->biayarincian+$rincian->biayatotal;
        $permohonans->sisarincian = $permohonans->sisarincian+$rincian->biayatotal;
        $permohonans->save();

        return back()->withInput(['tab'=>'profile'])->with('msg', 'Rincian berhasil di Submit!');
    }

    public function update(Request $request, $id)
    {

        $rincians = Rincian::findOrFail($id);
        $permohonans = Permohonan::where('id', $rincians->permohonan_id)->first();


        $validator = Validator::make($request->all(), [
        'jenisbelanja'              => 'required|min:3|max:150',
        'volume'                    => 'required|numeric|min:1|max:999',
        'biayasatuan'               => 'required|numeric|min:10000|max:100000000',
        'satuan'                    => 'required|min:3|max:150',
        ],[
            'jenisbelanja.required'=>'jenis belanja harus diisi',
            'jenisbelanja.min'=>'jenis belanja minimal 3 huruf',
            'jenisbelanja.max'=>'jenis belanja maksimal 150 huruf',

            'volume.required'=>'volume harus diisi',
            'volume.min'=>'volume minimal 1 digit angka',
            'volume.max'=>'volume maksimal 999 digit angka',

            'biayasatuan.required'=>'biaya satuan harus diisi',
            'biayasatuan.min'=>'biaya satuan minimal Rp10.000',
            'biayasatuan.max'=>'biaya satuan maksimal Rp100.000.000',

            'satuan.required'=>'tempat kegiatan harus diisi',
            'satuan.min'=>'tempat kegiatan minimal 3 huruf',
            'satuan.max'=>'tempat kegiatan maksimal 150 huruf',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(['tab'=>'profile'])->with('error_code', $id);
        }

        $permohonans->biayarincian = $permohonans->biayarincian-$rincians->biayatotal;
        $permohonans->sisarincian = $permohonans->sisarincian-$rincians->biayatotal;
        $permohonans->save();

        $rincians->jenisbelanja = $request['jenisbelanja'];
        $rincians->biayasatuan = $request['biayasatuan'];
        $rincians->satuan = $request['satuan'];
        $rincians->volume = $request['volume'];
        $rincians->biayatotal = $request['biayasatuan'] * $request['volume'];
        $rincians->sisabiaya = $request['biayasatuan'] * $request['volume'];
        $rincians->status = 1;
        $rincians->updated_by = Auth::user()->id;
        $rincians->save();

        $permohonans->biayarincian = $permohonans->biayarincian+$rincians->biayatotal;
        $permohonans->sisarincian = $permohonans->sisarincian+$rincians->biayatotal;
        $permohonans->save();

        return back()->withInput(['tab'=>'profile'])->with('msg', 'Rincian Biaya berhasil di Edit!');
    }

    //Hapus Rincian
    public function destroy($id){
        $rincians = Rincian::findOrFail($id);
        $permohonans = Permohonan::where('id', $rincians->permohonan_id)->first();
        $permohonans->totalrincian = $permohonans->totalrincian-1;
        $permohonans->biayarincian = $permohonans->biayarincian-$rincians->biayatotal;
        $permohonans->sisarincian = $permohonans->sisarincian-$rincians->biayatotal;
        $permohonans->save();
        $rincians->delete();
        return back()->withInput(['tab'=>'profile'])->with('msg', 'Rincian Biaya berhasil di Hapus!');
    }

    //File Bukti
    public function fileBukti(Request $request, $id)
    {

        $rincian = Rincian::find($id);
        $permohonan = Permohonan::where('id', $rincian->permohonan_id)->first();

        $validator = Validator::make($request->all(), [
            'file'           =>  'required|mimes:pdf|max:10000kb',
            'biayaterpakai'  =>  'required|numeric|min:1|max:100000000',
        ],
        [
            'file.required'=>'file harus diisi',
            'file.mimes'=>'file berformat .pdf',
            'file.max'=>'file berukuran maksimal 10Mb',

            'biayaterpakai.required'=>'biaya terpakai harus diisi',
            'biayaterpakai.min'=>'biaya terpakai minimal Rp1',
            'biayaterpakai.max'=>'biaya terpakai maksimal Rp100.000.000',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(['tab'=>'profile'])->with('error_code', $id);
        }
        //file
        $filename = $request->file('file');
        $file = time().rand(1000,9999).'.'.$filename->getClientOriginalExtension();
        $request->file('file')->move(public_path('/file'), $file);

        $rincian->biayaterpakai = $request['biayaterpakai'];
        $rincian->sisabiaya = $rincian->sisabiaya-$request['biayaterpakai'];
        $rincian->file = $file;
        $rincian->save();

        $permohonan->danaterpakai = $permohonan->danaterpakai+$rincian->biayaterpakai;
        $permohonan->sisadana = $permohonan->sisadana-$rincian->biayaterpakai;
        $permohonan->sisarincian = $permohonan->sisarincian-$rincian->biayaterpakai;
        $permohonan->totalspj = $permohonan->totalspj+1;
        $permohonan->save();

        return back()->withInput(['tab'=>'profile'])->with('msg', 'Bukti berhasil di submit!');
    }

    //edit file bukti
    public function editBukti(Request $request, $id)
    {

        $rincian = Rincian::find($id);
        $permohonan = Permohonan::where('id', $rincian->permohonan_id)->first();

        $validator = Validator::make($request->all(), [
            'file'           =>  'nullable|mimes:pdf|max:10000kb',
            'biayaterpakai'  =>  'nullable|numeric|min:1|max:100000000',
        ],
        [
            'file.mimes'=>'file berformat .pdf',
            'file.max'=>'file berukuran maksimal 10Mb',

            'biayaterpakai.required'=>'biaya terpakai harus diisi',
            'biayaterpakai.min'=>'biaya terpakai minimal Rp1',
            'biayaterpakai.max'=>'biaya terpakai maksimal Rp100.000.000',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(['tab'=>'profile'])->with('error_code', $id);
        }

        $permohonan->danaterpakai = $permohonan->danaterpakai-$rincian->biayaterpakai;
        $permohonan->sisadana = $permohonan->sisadana+$rincian->biayaterpakai;
        $permohonan->sisarincian = $permohonan->sisarincian+$rincian->biayaterpakai;
        $permohonan->save();

        $rincian->sisabiaya = $rincian->sisabiaya+$rincian->biayaterpakai;
        $rincian->save();

        //file
        if($request->file('file')){
            $filename = $request->file('file');
            $file = time().rand(1000,9999).'.'.$filename->getClientOriginalExtension();
            $request->file('file')->move(public_path('/file'), $file);
            $rincian->file = $file;
        }

        $rincian->biayaterpakai = $request['biayaterpakai'];
        $rincian->sisabiaya = $rincian->sisabiaya-$request['biayaterpakai'];
        $rincian->save();

        $permohonan->danaterpakai = $permohonan->danaterpakai+$rincian->biayaterpakai;
        $permohonan->sisadana = $permohonan->sisadana-$rincian->biayaterpakai;
        $permohonan->sisarincian = $permohonan->sisarincian-$rincian->biayaterpakai;
        $permohonan->save();
        
        return back()->withInput(['tab'=>'profile'])->with('msg', 'Bukti berhasil di edit!');
    }

}
