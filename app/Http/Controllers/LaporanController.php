<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    protected function index()
    {
        $tahun_pelajaran = DB::table('tahun_pelajaran')
                        ->select('tahun_pelajaran')
                        ->distinct()
                        ->whereNull('deleted_at')
                        ->orderBy('tahun_pelajaran', 'ASC')
                        ->get();
        // $html = \View::make('laporan.index')->with('tahun_pelajaran', $tahun_pelajaran)->render(); //view('laporan.index', compact('tahun_pelajaran'))->render(); 
        // echo $html;
        // dd($html);
        // $mpdf = new \Mpdf\Mpdf();
        // $mpdf->WriteHTML($html);
        // echo $mpdf->Output();
        return view('laporan.index', compact('tahun_pelajaran'));


        // $pdf = PDF::loadview('laporan.index', ['tahun_pelajaran' => $tahun_pelajaran]);
        // return $pdf->stream();
    }

    protected function laporanPembayaranSpp(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date'
        ]);
        $spp = DB::table('spp')
                ->select('*', 'spp.id AS id_spp', 'spp.created_at AS tgl_dibayar')
                ->join('users', 'spp.id_petugas' , '=', 'users.id')
                ->join('siswa', 'spp.nis', '=', 'siswa.nis')
                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
                ->whereNull('spp.deleted_at')
                ->whereBetween('spp.created_at', [date('Y-m-d 00:00:00', strtotime($request->from_date)), date('Y-m-d 23:59:59', strtotime($request->to_date))])
                ->get();
        $total = DB::table('spp')
                ->select('nominal')
                ->whereNull('spp.deleted_at')
                ->whereBetween('spp.created_at', [date('Y-m-d 00:00:00', strtotime($request->from_date)), date('Y-m-d 23:59:59', strtotime($request->to_date))])
                ->sum('nominal');
        $data = [
            'spp' => $spp,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'total' => $total
        ];
       
        $pdf = PDF::loadView('laporan.pembayaran-spp', $data);
        
        if ($request->type == 'download') {
            
            return $pdf->download('Laporan-Pembayaran-Spp.pdf');
        } else if ($request->type == 'view') {
            
            return $pdf->stream('Laporan-Pembayaran-Spp.pdf');
        }
    }

    protected function laporanPembayaranSppPertahun(Request $request)
    {
        $spp = DB::table('spp')
                ->select('*', 'spp.id AS id_spp', 'spp.created_at AS tgl_dibayar')
                ->join('users', 'spp.id_petugas' , '=', 'users.id')
                ->join('siswa', 'spp.nis', '=', 'siswa.nis')
                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
                ->whereNull('spp.deleted_at')
                ->where('spp.tahun_pelajaran', $request->tahun)
                ->get();
        $total = DB::table('spp')
                ->select('nominal')
                ->whereNull('spp.deleted_at')
                ->where('spp.tahun_pelajaran', $request->tahun)
                ->sum('nominal');
        $data = [
            'spp' => $spp,
            'tahun' => $request->tahun,
            'total' => $total
        ];


        $pdf = PDF::loadView('laporan.pembayaran-spp', $data);

        if ($request->type == 'download') {
            
            return $pdf->download('Laporan-Tahun-Pelajaran-' . $request->tahun . '.pdf');
        } else if ($request->type == 'view') {
            
            return $pdf->stream('Laporan-Tahun-Pelajaran-' . $request->tahun . '.pdf');
        }
    }

    protected function laporanPembayaranSppPerbulan(Request $request)
    {
        $spp = DB::table('spp')
                ->select('*', 'spp.id AS id_spp', 'spp.created_at AS tgl_dibayar')
                ->join('users', 'spp.id_petugas' , '=', 'users.id')
                ->join('siswa', 'spp.nis', '=', 'siswa.nis')
                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
                ->whereNull('spp.deleted_at')
                ->where('spp.bulan', $request->bulan)
                ->where('spp.tahun_pelajaran', $request->tahun)
                ->get();
        $total = DB::table('spp')
                ->select('nominal')
                ->whereNull('spp.deleted_at')
                ->where('spp.bulan', $request->bulan)
                ->where('spp.tahun_pelajaran', $request->tahun)
                ->sum('nominal');
                // dd($total);
        $data = [
            'spp' => $spp,
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'total' => $total
        ];

        $pdf = PDF::loadView('laporan.pembayaran-spp', $data);

        if ($request->type == 'download') {
            
            return $pdf->download('Laporan-Tahun-Pelajaran-' . $request->tahun . '.pdf');
        } else if ($request->type == 'view') {
            
            return $pdf->stream('Laporan-Tahun-Pelajaran-' . $request->tahun . '.pdf');
        }
    }
}
