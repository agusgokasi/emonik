<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Kegiatan;
use App\Permohonan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $proker = Kegiatan::where('status', '!=' , 1)->where('unit_id', $user->unit_id)->count();
        $kegiatan = Kegiatan::where('status', 1)->where('unit_id', $user->unit_id)->where('keterangan', 'Permohonan Belum Dibuat')->count();
        $permohonan = Permohonan::where('created_by', $user->id)->where('status', '!=' ,5)->where('status', '!=' ,6)->where('status', '!=' ,7)->where('status', '!=' ,8)->where('status', '!=' ,10)->count();
        $spj = Permohonan::where('created_by', $user->id)->where('status', '!=' ,0)->where('status', '!=' ,1)->where('status', '!=' ,2)->where('status', '!=' ,3)->where('status', '!=' ,4)->where('status', '!=' ,9)->where('status', '!=' ,10)->where('status', '!=' ,11)->count();
        $disp1 = Permohonan::where('status', 1)->count();
        $disp2 = Permohonan::where('status', 2)->count();
        $disp3 = Permohonan::where('status', 3)->count();
        $disp4 = Permohonan::where('status', 4)->count();
        $dispj1 = Permohonan::where('status', 6)->count();
        $dispj2 = Permohonan::where('status', 7)->count();
        $pproker = Kegiatan::where('status', 9)->count();
        return view('home', compact('kegiatan', 'proker', 'permohonan', 'spj', 'disp1', 'disp2', 'disp3', 'disp4', 'dispj1', 'dispj2', 'pproker'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        if($user->id == Auth::user()->id){
            return view('profile', compact('user'));
        }
        return abort('404');
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:150'],
            'phone' =>  ['nullable', 'digits_between:8,15'],
            'password' => ['nullable', 'string', 'min:6',],
        ],[
            'name.required'=>'Nama harus diisi',
            'name.max'=>'Nama maksimal 150 huruf',

            'phone.digits_between'=>'Nomor telepon field 8 sampai 15 digit angka',

            'password.min'=>'password minimal 6 karakter',

        ]);

        if ($request->email != $user->email) {
            $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            ],[
            'email.required'=>'email harus diisi',
            'email.max'=>'email maksimal 150 karakter',
            'email.unique'=>'email sudah digunakan',
            ]);
        }
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        if ($request->password != "") {
            $user->password = Hash::make($request['password']);
        }
        $user->updated_by = Auth::user()->id;
        if($user->id == Auth::user()->id){
            $user->save();
            return redirect()->action('HomeController@index')->with('msg', 'Profile berhasil diedit!');
        }
        return abort('404');
    }
}
