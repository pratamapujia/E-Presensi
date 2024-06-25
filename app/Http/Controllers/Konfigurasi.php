<?php

namespace App\Http\Controllers;

use App\Models\SetJam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Konfigurasi extends Controller
{
    // Konfigurasi Lokasi
    public function setLokasi()
    {
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        return view('admin.konfigurasi.lokasi', compact('lok_kantor'));
    }

    public function updateLokasi(Request $request)
    {
        $koor = $request->koordinat;
        $radius = $request->radius;
        $lok = DB::table('konfigurasi_lokasi')->where('id', 1)->update([
            'koordinat' => $koor,
            'radius' => $radius,
        ]);

        if ($lok) {
            return redirect()->back()->with('pesan', 'Data berhasil Diperbarui 👍');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal Diperbarui 😭');
        }
    }

    // Konfigurasi Jam Kerja
    public function setJamKerja()
    {
        $jamKerja = DB::table('jam_kerja')->orderBy('kd_jam')->get();
        return view('admin.jam.index', compact('jamKerja'));
    }

    public function createJam()
    {
        // Generate kode Jam Baru
        $lastKode = SetJam::orderBy('kd_jam', 'desc')->first();
        if ($lastKode) {
            $kode = $lastKode->kd_jam;
            $nextKode = 'JK-' . str_pad(intval(substr($kode, 3)) + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextKode = 'JK-001';
        }
        return view('admin.jam.create', compact('nextKode'));
    }

    public function storeJam(Request $request)
    {
        // Validasi
        $validasi = Validator::make($request->all(), [
            'nama_jam' => 'required',
            'awal_jam' => 'required',
            'jam_masuk' => 'required',
            'akhir_jam' => 'required',
            'jam_pulang' => 'required',
        ], [
            'nama_jam.required' => 'Nama Jam tidak boleh kosong',
            'awal_jam.required' => 'Awal Jam tidak boleh kosong',
            'jam_masuk.required' => 'Jam Masuk tidak boleh kosong',
            'akhir_jam.required' => 'Akhir Jam tidak boleh kosong',
            'jam_pulang.required' => 'Jam Pulang tidak boleh kosong',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->withInput();
        }

        $jamKerja = new SetJam();
        $jamKerja->kd_jam = $request->kd_jam;
        $jamKerja->nama_jam = $request->nama_jam;
        $jamKerja->awal_jam = $request->awal_jam;
        $jamKerja->jam_masuk = $request->jam_masuk;
        $jamKerja->akhir_jam = $request->akhir_jam;
        $jamKerja->jam_pulang = $request->jam_pulang;

        if ($jamKerja->save()) {
            return redirect('konfigurasi/jam')->with('pesan', 'Data berhasil disimpan 👍');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal Disimpan 😭');
        }
    }
}
