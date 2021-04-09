<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPetugasController extends Controller
{
    protected function index($keyword = null)
    {
    	$petugas = DB::table('users')->whereNull('deleted_at')->where('level', 'petugas')->orderBy('name', 'ASC')->paginate(10);
    	return view('data-petugas/index', compact('keyword', 'petugas'));
    }

    protected function redirectKeyword(Request $request)
    {
    	$keyword = $request->post('keyword');

        if ($keyword == null) {

            return redirect(route('data-petugas'));
        }

        return redirect(route('data-petugas-search', $keyword));
    }

    protected function search($keyword)
    {
    	$petugas = DB::table('users')
    	->whereNull('deleted_at')
    	->where('level', 'petugas')
    	->where(function($query) use ($keyword) {
    		$query->orWhere('name', 'LIKE', '%'.$keyword.'%')
    			  ->orWhere('email', 'LIKE', '%'.$keyword.'%');
    	})
    	->orderBy('name', 'ASC')
    	->paginate(10);

    	return view('data-petugas/index', compact('keyword', 'petugas'));
    }

    protected function edit($id)
    {
    	$petugas = DB::table('users')->whereNull('deleted_at')->where('level', 'petugas')->where('id', $id)->first();

    	if ($petugas == null) {

    		return redirect(route('data-petugas'));
    	}

    	return view('data-petugas/edit', compact('petugas'));
    }

    protected function put(Request $request)
    {
    	DB::table('users')->where('id', $request->id)->update([
    		'name' => $request->name,
    		'email' => $request->email
    	]);

    	return redirect(route('edit-data-petugas', $request->id))->with('alert', 'Data Petugas telah disimpan.');
    }

    protected function create()
    {
    	return view('data-petugas/create');
    }

    protected function store(Request $request)
    {
    	$request->validate([
    		'name' => 'required',
    		'email' => 'required',
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	$petugas = DB::table('users')->whereNotNull('deleted_at')->where('username', $request->username);

    	if ($petugas->count() >= 1) {


    		DB::table('users')->where('id', $petugas->first()->id)->update(['deleted_at' => null]);

    	} else {

    		$request->validate([
    			'username' => 'unique:users'
    		]);

    		DB::table('users')->insert([
    			'name' => $request->name,
    			'email' => $request->email,
    			'username' => $request->username,
    			'password' => password_hash($request->password, PASSWORD_DEFAULT),
    			'level' => 'petugas'
    		]);
    	}

    	return redirect(route('create-data-petugas'))->with('alert', 'Data Petugas telah ditambahkan.');
    }

    protected function destroy(Request $request)
    {
    	DB::table('users')->where('id', $request->id)->update(['deleted_at' => \Carbon\Carbon::now()]);

    	return redirect(route('data-petugas'))->with('alert', 'Data Petugas telah dihapus.');
    }
}
