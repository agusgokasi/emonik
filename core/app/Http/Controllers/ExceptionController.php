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

class ExceptionController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user()->permission_id;
            $Permission = Permission::where('id', $this->user)->first();
            if(!$Permission->exception_status) abort(403);
            return $next($request);
        });
    }

    public function index() {
    	$users = User::where('status', 1)->whereHas('permissionsGroup', function ($query) {$query->where('permohonan_status', 1);})->orderBy('updated_at', 'desc')->get();
        return view('exception.index_exception', compact('users'));
    }

    public function buka($id) 
    {
        $user = User::findOrFail($id);
        $user->tor = null;
        $user->updated_by = Auth::user()->id;
        $user->save();
        return redirect()->action('ExceptionController@index')->with('msg', 'User akses telah buka!');
    }
}
