<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index()
    {
        $hariIni = date('Y-m-d');
        $bulanIni = date('m') * 1;
        $tahunIni = date('Y');
        $nik = Auth::guard('karyawan')->user()->nik;

        $presensiHariIni = DB::table('absensi')
            ->where('nik', $nik)
            ->where('tgl_absen', $hariIni)
            ->first();

        $historiBulanIni = DB::table('absensi')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_absen)="' . $bulanIni . '"')
            ->whereRaw('YEAR(tgl_absen)="' . $tahunIni . '"')
            ->orderBy('tgl_absen')
            ->get();

        $rekapPresensi = DB::table('absensi')
            ->selectRaw('COUNT(nik) as jmlHadir, SUM(IF(jam_in > "07:00",1,0)) as jmlTerlambat')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_absen)="' . $bulanIni . '"')
            ->whereRaw('YEAR(tgl_absen)="' . $tahunIni . '"')
            ->first();

        $leaderboard = DB::table('absensi')
            ->join('karyawan', 'absensi.nik', '=', 'karyawan.nik')
            ->where('tgl_absen', $hariIni)
            ->orderBy('jam_in')
            ->get();

        $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $rekapIjin = DB::table('perizinan')
            ->selectRaw('SUM(IF(keterangan="i",1,0)) as izin, SUM(IF(keterangan="s",1,0)) as sakit ')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_izin)="' . $bulanIni . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahunIni . '"')
            ->where('laporan', 1)
            ->first();


        return view('index', compact('presensiHariIni', 'historiBulanIni', 'namaBulan', 'bulanIni', 'tahunIni', 'rekapPresensi', 'leaderboard', 'rekapIjin'));
    }
}
