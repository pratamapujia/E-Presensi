<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')
            ->join('departemen', 'karyawan.kd_departemen', '=', 'departemen.kd_departemen')
            ->get();
        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        $dept = DB::table('departemen')->get();
        return view('admin.karyawan.create', compact('dept'));
    }

    public function store(Request $request)
    {
        // Validation
        $validasi = Validator::make($request->all(), [
            'nik' => 'required|numeric|unique:karyawan,nik|digits_between:3,5',
            'nama_lengkap' => 'required|max:30',
            'jabatan' => 'required|max:20',
            'kd_departemen' => 'required',
            'no_hp' => 'required|numeric|digits_between:10,13|unique:karyawan,no_hp',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.digits_between' => 'NIK hanya minimal 3 dan maximal 5 angka',
            'nik.numeric' => 'NIK hanya boleh angka',
            'nik.unique' => 'NIK tidak boleh sama',
            'nama_lengkap.required' => 'Nama tidak boleh kosong',
            'nama_lengkap.max' => 'Nama hanya hanya maximal 30 huruf',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'jabatan.max' => 'Jabatan hanya maximal 20 huruf',
            'kd_departemen.required' => 'Departemen tidak boleh kosong',
            'no_hp.required' => 'No Hp tidak boleh kosong',
            'no_hp.unique' => 'No Hp tidak boleh sama',
            'no_hp.digits_between' => 'No Hp minimal 10 dan maximal 13 angka',
            'foto.image' => 'Yang anda masukkan bukan Image',
            'foto.mimes' => 'Format foto (jpeg, png, jpg)',
            'foto.max' => 'Ukuran foto maximal 2Mb',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->withInput();
        }

        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kd_departemen = $request->kd_departemen;
        $password = Hash::make('password');

        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kd_departemen' => $kd_departemen,
                'foto' => $foto,
                'password' => $password,
            ];

            $simpan = DB::table('karyawan')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $path = "public/uploads/karyawan/";
                    $request->file('foto')->storeAs($path, $foto);
                }
                return redirect()->to('karyawan')->with(['pesan' => 'Data berhasil disimpan 👍']);
            }
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->with(['gagal' => 'Data gagal disimpan 😭']);
        }
    }
}
