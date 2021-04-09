<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EntriDataSPPController extends Controller
{
    protected function index()
    {
    	return view('transaksi-spp/entri-data-spp');
    }

    protected function cariDataSiswa(Request $request)
    {
    	$nis = $request->post('nis');
    	$data_siswa = DB::table('siswa')->select('nama_siswa', 'kelas')->join('kelas', 'siswa.id_kelas', '=','kelas.id')->where('siswa.nis', $nis)->get();
    	$tahun_pelajaran = DB::table('tahun_pelajaran')
    					->select('tahun_pelajaran')
    					->distinct()
    					->orderBy('tahun_pelajaran', 'ASC')
    					->get();
    	$merge = [
    		'tahun_pelajaran' => $tahun_pelajaran,
    		'data_siswa' => $data_siswa
    	];

    	if (count($data_siswa) <= 0) {

    		return ['error' => 404, 'message' => 'Siswa dengan NIS ['.$nis.'] tidak dapat ditemukan.'];
    	} else {

	    	return $merge;
	    }
    }

    protected function dataSPPSiswa(Request $request)
    {
    	$tahun_pelajaran = $request->post('tahun_pelajaran');
    	$nis = $request->post('nis');
    	$level = $request->post('level');

    	$data_spp = DB::table('spp')
                        ->select('*', 'spp.created_at AS tgl_dibayar')
    					->join('users', 'spp.id_petugas', '=', 'users.id')
    					->where('spp.tahun_pelajaran', $tahun_pelajaran)
    					->where('spp.nis', $nis)	
    					->get();

    	return view('transaksi-spp/data-spp-siswa', compact(
    		'data_spp',
    		'nis',
    		'tahun_pelajaran',
    		'level'
    	));
    }

    protected function bayarSPPSiswa(Request $request)
    {
    	DB::table('spp')->insert([
    		'id_petugas' => Auth::user()->id,
    		'nis' => $request->post('nis'),
    		'bulan' => $request->post('bulan'),
    		'tahun_pelajaran' => $request->post('tahun_pelajaran'),
    		'nominal' => $request->post('nominal')
    	]);

    	return response()->json(true);
    }

    protected function dataTahunPelajaran()
    {
    	$tahun_pelajaran = DB::table('tahun_pelajaran')
    					->select('id', 'tahun_pelajaran')
    					->distinct()
    					->orderBy('tahun_pelajaran', 'ASC')
    					->get();

    	return view('transaksi-spp/data-tahun-pelajaran', compact('tahun_pelajaran'));
    }

    protected function setTahunPelajaran(Request $request)
    {
    	$tahun_pelajaran = $request->post('tahun_pelajaran');

	}

    protected function deleteTahunPelajaran(Request $request)
    {
    	$id = $request->post('id');

    	DB::table('tahun_pelajaran')->where('id', $id)->delete();

    	return redirect()->back()->with('alert', 'Tahun Pelajaran telah dihapus.');
    }
    
    protected function tambahTahunPelajaran()
    {
    	return view('transaksi-spp/form-tambah-tahun-pelajaran');
    }

    protected function postTahunPelajaran(Request $request)
    {
    	$request->validate([
    		'tahun_pelajaran1' => 'required',
    		'tahun_pelajaran2' => 'required'
    	]);

    	$tahun_pelajaran = DB::table('tahun_pelajaran')
    				->where('tahun_pelajaran', $request->post('tahun_pelajaran1') . '/' . $request->post('tahun_pelajaran2'))
    				->get();

    	if (count($tahun_pelajaran) >= 1) {

    		return redirect()->back()->with('alert', 'Tahun Pelajaran sudah ada. Silahkan cek kembali.');
    	}

    	DB::table('tahun_pelajaran')->insert([
    		'tahun_pelajaran' => $request->post('tahun_pelajaran1') . '/' . $request->post('tahun_pelajaran2')
    	]);

    	return redirect()->back()->with('alert', 'Tahun Pelajaran Baru telat dibuat.');
    }
}
