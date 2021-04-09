<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataSiswaController extends Controller
{
    protected function index($keyword = NULL)
    {
    	$kelas = DB::table('kelas')->select(DB::raw('*, SUBSTRING(kelas, 4) AS jurusan'))->orderBy('jurusan', 'ASC')->get();
    	$siswa = DB::table('siswa')
                                ->select('kelas.kelas', 'siswa.nama_siswa', 'siswa.nis')
                                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
                                ->whereNull('siswa.deleted_at')
                                ->orderBy('nis', 'ASC')
                                ->offset(0)
                                ->limit(100)
                                ->paginate(20);
    	return view('data-siswa/index', compact(
    		'kelas',
    		'siswa',
            'keyword'
    	));
    }

    protected function redirectKeyword(Request $request)
    {
        $keyword = $request->post('keyword');

        if ($keyword == null) {

            return redirect(route('data-siswa'));
        }

        return redirect(route('data-siswa-search', $keyword));
    }

    protected function search($keyword)
    {
        $siswa = DB::table('siswa')
                                ->select('kelas.kelas', 'siswa.nama_siswa', 'siswa.nis')
                                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
                                ->whereNull('siswa.deleted_at')
                                ->where(function($query) use ($keyword) {
                                    $query->orWhere('siswa.nis','LIKE', '%' . $keyword . '%')
                                    ->orWhere('siswa.nama_siswa','LIKE', '%' . $keyword . '%')
                                    ->orWhere('kelas.kelas','LIKE', '%' . $keyword . '%');
                                })
                                ->offset(0)
                                ->limit(100)
                                ->paginate(20);
        return view('data-siswa/index', compact('siswa', 'keyword'));
    }

    protected function tambahDataSiswa()
    {
        $kelas = DB::table('kelas')->select('id', 'kelas')->whereNull('deleted_at')->get();
    	return view('data-siswa/form-tambah', compact('kelas'));
    }

    protected function postDataSiswa(Request $request)
    {

    	$request->validate([
    		'nis' => 'required|unique:siswa|max:100',
    		'nis' => 'required|max:100',
    		'nama_siswa' => 'required|max:200',
    		'kelas' => 'required',
    		'alamat' => 'required|max:200',
    		'no_telp' => 'max:100',
            'username' => 'required',
            'password' => 'required'
    	]);

        $id_user = DB::table('users')->insertGetId([
            'name' => $request->nama_siswa,
            'email' => $request->username . '@pspp.com',
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'level' => 'siswa'
        ]);

    	DB::table('siswa')->insert([
            'id_user' => $id_user,
    		'nis' => $request->post('nis'),
    		'nis' => $request->post('nis'),
    		'nama_siswa' => $request->post('nama_siswa'),
    		'id_kelas' => $request->post('kelas'),
    		'alamat' => $request->post('alamat'),
    		'no_telp' => $request->post('no_telp')
    	]);

    	return redirect('data-siswa/tambah')->with('alert', 'Data siswa telah ditambahkan.');
    }

    protected function editDataSiswa($nis)
    {
        $kelas = DB::table('kelas')
                        ->select('id', 'kelas')
                        ->whereNull('deleted_at')
                        ->get();
        $siswa = DB::table('siswa')
                        ->select('nis', 'nama_siswa', 'id_kelas')
                        ->whereNull('deleted_at')
                        ->where('nis', $nis)
                        ->first();
        // dd($siswa);
        if ($siswa == null) {

            return redirect(route('data-siswa'));
        }
        return view('data-siswa/form-edit', compact(
            'nis',
            'kelas',
            'siswa'
        ));
    }

    protected function putDataSiswa(Request $request)
    {
        $siswa = DB::table('siswa')
                        ->select('nis', 'nama_siswa', 'id_kelas')
                        ->whereNull('deleted_at')
                        ->where('nis', $request->nis)
                        ->first();
        // dd($siswa);
        if ($siswa == null) {

            return redirect(route('data-siswa'));
        }

        DB::table('siswa')
                ->where('nis', $request->nis)
                ->update([
                    'nama_siswa' => $request->nama_siswa,
                    'id_kelas' => $request->id_kelas
                ]);
        return redirect()->back()->with('alert', 'Data Siswa telah disimpan.');
    }

    protected function deleteDataSiswa(Request $request)
    {
        // dd($request);
        DB::table('siswa')
                ->where('nis', $request->nis)
                ->update(['deleted_at' => \Carbon\Carbon::now()]);

        return redirect()->back()->with('alert', 'Data Siswa telah dihapus.');
    }
}
