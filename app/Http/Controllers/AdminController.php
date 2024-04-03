<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $hariIni = date('Y-m-d');

        $rekapPresensi = DB::table('absensi')
            ->selectRaw('COUNT(nik) as jmlHadir, SUM(IF(jam_in > "07:00",1,0)) as jmlTerlambat')
            ->where('tgl_absen', $hariIni)
            ->first();

        $rekapIzin = DB::table('perizinan')
            ->selectRaw('SUM(IF(keterangan="i",1,0)) as izin, SUM(IF(keterangan="s",1,0)) as sakit ')
            ->where('tgl_izin', $hariIni)
            ->where('laporan', 1)
            ->first();
        return view('admin.index', compact('rekapPresensi','rekapIzin'));
    }
}
