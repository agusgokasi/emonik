<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use App\Unit;
use Auth;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Redirect;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->permission_status) abort(403);
            return $next($request);
        });
    }

    public function index() {
    	$users = User::where('id', '!=', 1)->get();
        return view('user.index_user', compact('users'));
    }

    public function create() {
        $permissions = Permission::where('id', '!=', 1)->where('status', 1)->get();
        $units = Unit::get();
        return view('user.create_user', compact('permissions', 'units'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'phone' =>  ['nullable', 'digits_between:8,15'],
            'permission' =>  ['required'],
            'unit' =>  ['nullable'],
            'password' => ['required', 'string', 'min:6',],
        ],[
            'name.required'=>'Nama harus diisi',
            'name.max'=>'Nama maksimal 150 huruf',

            'phone.digits_between'=>'Nomor telepon field 8 sampai 15 digit angka',

            'email.required'=>'email harus diisi',
            'email.max'=>'email maksimal 150 karakter',
            'email.unique'=>'email sudah digunakan',

            'permission.required'=>'Permission harus diisi',

            'password.required'=>'password harus diisi',
            'password.min'=>'password minimal 6 karakter',

        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->permission_id = $request['permission'];
        $user->unit_id = $request['unit'];
        $user->password = Hash::make($request['password']);
        $user->status = 1;
        $user->created_by = Auth::user()->id;
        $user->save();

        return redirect()->action('UserController@index')->with('msg', 'User berhasil dibuat!');
    }

    public function edit($id) {
        $permissions = Permission::where('id', '!=', 1)->where('status', 1)->get();
        $units = Unit::get();
        $user = User::findOrFail($id);
        return view('user.edit_user', compact('permissions', 'units', 'user'));
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:150'],
            'phone' =>  ['nullable', 'digits_between:8,15'],
            'permission' =>  ['required'],
            'unit' =>  ['nullable'],
            'status' => ['required','in:1,0'],
            'password' => ['nullable', 'string', 'min:6',],
        ],[
            'name.required'=>'Nama harus diisi',
            'name.max'=>'Nama maksimal 150 huruf',

            'phone.digits_between'=>'Nomor telepon field 8 sampai 15 digit angka',

            'permission.required'=>'Permission harus diisi',

            'status.required'=>'statusharus diisi',

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
        $user->permission_id = $request['permission'];
        $user->unit_id = $request['unit'];
        if ($request->password != "") {
            $user->password = Hash::make($request['password']);
        }
        $user->status = $request['status'];
        $user->updated_by = Auth::user()->id;
        if ($id != 1) {
            $user->save();
            return redirect()->action('UserController@index')->with('msg', 'User berhasil diedit!');
        } else{
        return redirect()->action('UserController@index')->with('dgn', 'User tidak bisa diedit!');
        }
    }

    public function destroy($id) 
    {
        $user = User::findOrFail($id);
        if ($id != 1 && $id != Auth::user()->id) {
            User::where('permission_id', $id)->delete();
            $user->delete();
            return redirect()->action('UserController@index')->with('msg', 'User berhasil dihapus!');
        } else {
            return redirect()->action('UserController@index')->with('dgn', 'User tidak bisa dihapus!');
        }
    }
}
