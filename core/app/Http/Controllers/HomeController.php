<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

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
        return view('home');
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

            'password.min'=>'email maksimal 6 karakter',

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
