<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IzinController extends Controller
{
    public function index()
    {
        $izinsakit = DB::table('perizinan')
            ->join('karyawan', 'perizinan.nik', '=', 'karyawan.nik')
            ->orderBy('tgl_izin', 'desc')->get();
        return view('admin.izin.index', compact('izinsakit'));
    }

    public function update(Request $request, string $id)
    {
        $status = $request->laporan;
        $update = DB::table('perizinan')->where('id', $id)->update(['laporan' => $status]);
        if ($update) {
            return redirect()->back()->with('pesan', 'Data berhasil Diperbarui 👍');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal Diperbarui 😭');
        }
    }

    public function cancel($id)
    {
        $update = DB::table('perizinan')->where('id', $id)->update(['laporan' => 0]);
        if ($update) {
            return redirect()->back()->with('pesan', 'Data berhasil Dibatalkan 👍');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal Dibatalkan 😭');
        }
    }
}
