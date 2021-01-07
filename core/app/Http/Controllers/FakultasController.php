<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;
use App\Unit;
use App\Fakultase;
use App\Prodi;
use Illuminate\Support\Facades\Validator;

class FakultasController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->unit_status) abort(403);
            return $next($request);
        });
    }

    public function index() {
    	$fakultases = Fakultase::get();
        return view('fakultas.index_fakultas', compact('fakultases'));
    }

    public function post(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string','max:150', 'unique:fakultases'],
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'nama.unique'=>'Fakultas sudah ada',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_code', 'create');
        }
    	$fakultases = new Fakultase();
        $fakultases->nama = $request['nama'];
        $fakultases->status = 1;
        $fakultases->created_by = Auth::user()->id;
        $fakultases->save();
        return back()->with('msg', 'Fakultas berhasil disubmit!');
    }

    public function update(Request $request, $id) {
    	$fakultases = Fakultase::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'status'=> 'required|in:1,0',
        ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'status.required'=>'status harus diisi',
        ]);

        if ($request->nama != $fakultases->nama) {
            $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:150', 'unique:fakultases'],
            ],[
            'nama.required'=>'Nama harus diisi',
            'nama.max'=>'Nama maksimal 150 huruf',
            'nama.unique'=>'Fakultas sudah ada',
            ]);
        }

        if ($validator->fails()) {
            // return back()->withErrors($validator)->withInput()->with('dgn', 'Fakultas gagal diedit, Harap periksa kesalahan!');
            return back()->withErrors($validator)->withInput()->with('error_code', $id);
        }
        $fakultases->nama = $request['nama'];
        $fakultases->status = $request['status'];
        $fakultases->updated_by = Auth::user()->id;
        $fakultases->save();
        return back()->with('msg', 'Fakultas berhasil diedit!');
    }

    public function destroy($id) 
    {
        $fakultases = Fakultase::find($id);
        $prodis = Prodi::where('fakultas_id', $fakultases->id)->get();
        $units = Unit::where('fakultas_id', $fakultases->id)->get();
        foreach ($prodis as $prodi) {
            $prodi->fakultas_id = null;
            $prodi->save();
        }
        foreach ($units as $unit) {
            $unit->fakultas_id = null;
            $unit->save();
        }
        $fakultases->delete();
        return redirect()->action('FakultasController@index')->with('msg', 'Fakultas berhasil dihapus!');
    }
}
