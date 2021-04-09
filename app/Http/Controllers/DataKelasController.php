<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataKelasController extends Controller
{
    protected function index($keyword = null)
    {
    	$kelas = DB::table('kelas')->whereNull('deleted_at')->orderBy('kelas', 'ASC')->get();
    	return view('data-kelas/index', compact('keyword', 'kelas'));
    }

    protected function redirectKeyword(Request $request)
    {
    	$keyword = $request->post('keyword');

        if ($keyword == null) {

            return redirect(route('data-kelas'));
        }

        return redirect(route('data-kelas-search', $keyword));
    }

    protected function search($keyword)
    {
    	$kelas = DB::table('kelas')
    				->whereNull('deleted_at')
    				->where(function($query) use ($keyword) {
    					$query->orWhere('kelas', 'LIKE', '%' . $keyword . '%');
    				})
    				->orderBy('kelas', 'ASC')->get();

    	return view('data-kelas/index', compact('keyword', 'kelas'));
    }

    protected function edit($id)
    {
    	$kelas = DB::table('kelas')->whereNull('deleted_at')->where('id', $id)->first();

    	return view('data-kelas/edit', compact('kelas'));
    }

    protected function put(Request $request)
    {
    	DB::table('kelas')->where('id', $request->id)->update(['kelas' => $request->kelas, 'updated_at' => \Carbon\Carbon::now()]);

    	return redirect(route('edit-data-kelas', $request->id))->with('alert', 'Data Kelas telah disimpan.');
    }

    protected function create()
    {
    	return view('data-kelas/create');
    }

    protected function store(Request $request)
    {
    	$request->validate([
    		'kelas' => 'required'
    	]);

    	$kelas = DB::table('kelas')->whereNotNull('deleted_at')->where('kelas', $request->kelas);

    	if ($kelas->count() >= 1) {


    		DB::table('kelas')->where('id', $kelas->first()->id)->update(['deleted_at' => null]);

    	} else {

    		$request->validate([
    			'kelas' => 'unique:kelas'
    		]);
    		DB::table('kelas')->insert(['kelas' => $request->kelas]);
    	}

    	return redirect(route('create-data-kelas'))->with('alert', 'Data Kelas telah ditambahkan.');
    }

    protected function destroy(Request $request)
    {
    	DB::table('kelas')->where('id', $request->id)->update(['deleted_at' => \Carbon\Carbon::now()]);

    	return redirect(route('data-kelas'))->with('alert', 'Data Kelas telah dihapus.');
    }
}
