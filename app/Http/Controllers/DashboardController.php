<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected function index()
    {

    	$date = date('Y');
    	$date_plus_one = $date + 1;
    	$tahun_pelajaran = $date . '-' . $date_plus_one;

    	$income['year'] = DB::table('spp')
    						->select(DB::raw('SUM(nominal) AS nominal'))
    						->where('tahun_pelajaran', $tahun_pelajaran)
    						->get();
    	$income['today'] = DB::table('spp')
    						->select(DB::raw('SUM(nominal) AS nominal'))
    						->whereDate('created_at', date('Y-m-d'))
    						->get();
    	

        // Siswa

        $siswa = DB::table('siswa')->where('id_user', Auth::user()->id)->first();

        $jumlah_siswa = DB::table('siswa')
                        ->whereNull('deleted_at')
                        ->count();
        $jumlah_petugas = DB::table('users')
                        ->whereNull('deleted_at')
                        ->where('level', 'petugas')
                        ->count();
        $jumlah_kelas = DB::table('kelas')
                        ->whereNull('deleted_at')
                        ->count();
        $pemasukan = DB::table('spp')
                        ->whereNull('deleted_at')
                        ->whereDate('created_at', date('Y-m-d'))
                        ->sum('nominal');

    	return view('dashboard', compact(
    		'jumlah_siswa',
            'jumlah_petugas',
            'jumlah_kelas',
            'pemasukan',
            'siswa'
    	));
    }
}
