<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RiwayatSPP extends Controller
{
	protected function index($keyword = NULL)
	{

		if (Auth::user()->level == 'petugas') {

			$riwayatSPP = DB::table('spp')
							->select('*', 'spp.id AS id_spp', 'spp.created_at AS tgl_dibayar')
							->join('siswa', 'spp.nis', '=', 'siswa.nis')
							->join('users', 'spp.id_petugas', '=', 'users.id')
							->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
							->orderBy('spp.created_at', 'DESC')
							->where('spp.deleted_at', NULL)
							->where('spp.id_petugas', Auth::user()->id)
							->offset(0)
							->limit(100)
							->paginate(10);
		}

		if (Auth::user()->level == 'siswa') {

			$siswa = DB::table('siswa')->whereNull('deleted_at')->where('id_user', Auth::user()->id)->first();

			$riwayatSPP = DB::table('spp')
							->select('*', 'spp.id AS id_spp', 'spp.created_at AS tgl_dibayar')
							->join('siswa', 'spp.nis', '=', 'siswa.nis')
							->join('users', 'spp.id_petugas', '=', 'users.id')
							->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
							->orderBy('spp.created_at', 'DESC')
							->where('spp.deleted_at', NULL)
							->where('spp.nis', $siswa->nis)
							->offset(0)
							->limit(100)
							->paginate(10);
		}

		if (Auth::user()->level == 'admin') {

			$riwayatSPP = DB::table('spp')
							->select('*', 'spp.id AS id_spp', 'spp.created_at AS tgl_dibayar')
							->join('siswa', 'spp.nis', '=', 'siswa.nis')
							->join('users', 'spp.id_petugas', '=', 'users.id')
							->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
							->orderBy('spp.created_at', 'DESC')
							->where('spp.deleted_at', NULL)
							->offset(0)
							->limit(100)
							->paginate(10);
		}

		return view('transaksi-spp/riwayat-spp', compact('riwayatSPP', 'keyword'));
	}

	protected function redirectKeyword(Request $request) {

		$keyword = $request->post('keyword');

		if ($keyword == null) {

			return redirect(route('riwayat-spp'));
		}

		return redirect(route('riwayat-spp-search', $keyword));
	}

	protected function search($keyword)
	{
		if (Auth::user()->level == 'petugas') {

			$riwayatSPP = DB::table('spp')
								->select('*', 'spp.id AS id_spp', 'spp.created_at AS tgl_dibayar')
								->join('siswa', 'spp.nis', '=', 'siswa.nis')
								->join('users', 'spp.id_petugas', '=', 'users.id')
								->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
								->orderBy('spp.created_at', 'DESC')
								->whereNull('spp.deleted_at')
								->where('spp.id_petugas', Auth::user()->id)
								->where(function($query) use ($keyword) {
									$query->orWhere('spp.id','LIKE', '%' . $keyword . '%')
									->orWhere('siswa.nama_siswa','LIKE', '%' . $keyword . '%')
									->orWhere('kelas.kelas','LIKE', '%' . $keyword . '%')
									->orWhere('spp.tahun_pelajaran','LIKE', '%' . $keyword . '%')
									->orWhere('spp.nominal','LIKE', '%' . $keyword . '%');
								})
								->offset(0)
								->limit(100)
								->paginate(10);
		}

		if (Auth::user()->level == 'siswa') {

			$siswa = DB::table('siswa')->whereNull('deleted_at')->where('id_user', Auth::user()->id)->first();
			
			$riwayatSPP = DB::table('spp')
								->select('*', 'spp.id AS id_spp', 'spp.created_at AS tgl_dibayar')
								->join('siswa', 'spp.nis', '=', 'siswa.nis')
								->join('users', 'spp.id_petugas', '=', 'users.id')
								->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
								->orderBy('spp.created_at', 'DESC')
								->whereNull('spp.deleted_at')
								->where('spp.nis', $siswa->nis)
								->where(function($query) use ($keyword) {
									$query->orWhere('spp.id','LIKE', '%' . $keyword . '%')
									->orWhere('siswa.nama_siswa','LIKE', '%' . $keyword . '%')
									->orWhere('kelas.kelas','LIKE', '%' . $keyword . '%')
									->orWhere('spp.tahun_pelajaran','LIKE', '%' . $keyword . '%')
									->orWhere('spp.nominal','LIKE', '%' . $keyword . '%');
								})
								->offset(0)
								->limit(100)
								->paginate(10);
		} 

		if (Auth::user()->level == 'admin') {

			$riwayatSPP = DB::table('spp')
							->select('*', 'spp.id AS id_spp', 'spp.created_at AS tgl_dibayar')
							->join('siswa', 'spp.nis', '=', 'siswa.nis')
							->join('users', 'spp.id_petugas', '=', 'users.id')
							->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
							->orderBy('spp.created_at', 'DESC')
							->whereNull('spp.deleted_at')
							->where(function($query) use ($keyword) {
									$query->orWhere('spp.id','LIKE', '%' . $keyword . '%')
									->orWhere('siswa.nama_siswa','LIKE', '%' . $keyword . '%')
									->orWhere('kelas.kelas','LIKE', '%' . $keyword . '%')
									->orWhere('spp.tahun_pelajaran','LIKE', '%' . $keyword . '%')
									->orWhere('spp.nominal','LIKE', '%' . $keyword . '%');
								})
							->offset(0)
							->limit(100)
							->paginate(10);
		}

		return view('transaksi-spp/riwayat-spp', compact('riwayatSPP', 'keyword'));
	}
}
