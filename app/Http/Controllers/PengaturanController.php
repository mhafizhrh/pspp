<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    protected function index()
    {
    	$siswa = null;

    	if (Auth::user()->level == 'siswa') {
    		
    		$siswa = DB::table('siswa')
    					->select('*', 'kelas.kelas AS kelas')
    					->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
    					->where('id_user', Auth::user()->id)
    					->first();
    	}

    	return view('pengaturan', compact('siswa'));
    }

    protected function update(Request $request)
    {
    	$request->validate([
    		'old_password' => 'required',
    		'new_password' => 'required|confirmed|min:8',
    		'new_password_confirmation' => 'required|min:8'
    	]);

    	// dd(password_verify($request->old_password, Auth::user()->password));
    	if (password_verify($request->old_password, Auth::user()->password)) {
    		$update = DB::table('users')
    					->where('id', Auth::user()->id)
    					->update(['password' => password_hash($request->new_password_confirmation, PASSWORD_DEFAULT)]);
    	} else {

    		return redirect(route('pengaturan'))->with('error', 'Password Saat Ini salah.');
    	}

    	return redirect('/')->with(Auth::logout());
    }
}
