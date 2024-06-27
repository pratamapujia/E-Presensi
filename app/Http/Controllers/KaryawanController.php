<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = DB::table('karyawan')
            ->orderBy('karyawan.updated_at', 'DESC')
            ->join('departemen', 'karyawan.kd_departemen', '=', 'departemen.kd_departemen')
            ->get();
        return view('admin.karyawan.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dept = DB::table('departemen')->get();
        return view('admin.karyawan.create', compact('dept'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $karyawan = new Karyawan();
        $karyawan->nik = $request->nik;
        $karyawan->nama_lengkap = $request->nama_lengkap;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->kd_departemen = $request->kd_departemen;
        $karyawan->password = Hash::make('password');

        if ($request->hasFile('foto')) {
            $karyawan->foto = $request->nik . "." . $request->file('foto')->getClientOriginalExtension();
            $path = "public/uploads/karyawan/";
            // Lakukan cropping
            $manager = new ImageManager(Driver::class);
            $croppedImage = $manager->read($request->file('foto'));
            $croppedImage->cover(300, 300, 'top-center')->save(storage_path('app/' . $path . $karyawan->foto));
        } else {
            $karyawan->foto = null;
        }

        if ($karyawan->save()) {
            // if ($request->hasFile('foto')) {
            // }
            return redirect()->route('karyawan.index')->with('pesan', 'Data berhasil disimpan 👍');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal Disimpan 😭');
        }
        // try {
        //     $data = [
        //         'nik' => $nik,
        //         'nama_lengkap' => $nama_lengkap,
        //         'jabatan' => $jabatan,
        //         'no_hp' => $no_hp,
        //         'kd_departemen' => $kd_departemen,
        //         'foto' => $foto,
        //         'password' => $password,
        //     ];

        //     $simpan = DB::table('karyawan')->insert($data);
        //     if ($simpan) {
        //         if ($request->hasFile('foto')) {
        //             $path = "public/uploads/karyawan/";
        //             $request->file('foto')->storeAs($path, $foto);
        //         }
        //         return redirect()->route('karyawan.index')->with('pesan', 'Data berhasil disimpan 👍');
        //     }
        // } catch (\Throwable $th) {
        //     // dd($th);
        //     return redirect()->back()->with(['gagal' => 'Data gagal disimpan 😭']);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dept = DB::table('departemen')->get();
        $data = DB::table('karyawan')->where('nik', $id)->first();
        return view('admin.karyawan.edit', compact('dept', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required|max:30',
            'jabatan' => 'required|max:20',
            'kd_departemen' => 'required',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama tidak boleh kosong',
            'nama_lengkap.max' => 'Nama hanya hanya maximal 30 huruf',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'jabatan.max' => 'Jabatan hanya maximal 20 huruf',
            'kd_departemen.required' => 'Departemen tidak boleh kosong',
            'no_hp.required' => 'No Hp tidak boleh kosong',
            'no_hp.digits_between' => 'No Hp minimal 10 dan maximal 13 angka',
            'foto.image' => 'Yang anda masukkan bukan Image',
            'foto.mimes' => 'Format foto (jpeg, png, jpg)',
            'foto.max' => 'Ukuran foto maximal 2Mb',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->withInput();
        }

        $karyawan = Karyawan::find($id);
        $karyawan->nik = $request->nik;
        $karyawan->nama_lengkap = $request->nama_lengkap;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->kd_departemen = $request->kd_departemen;
        $karyawan->password = Hash::make('password');
        $old_foto = $request->old_foto;

        if ($request->hasFile('foto')) {
            $karyawan->foto = $request->nik . "." . $request->file('foto')->getClientOriginalExtension();
            $path = "public/uploads/karyawan/";
            $pathOld = "public/uploads/karyawan/" . $old_foto;
            Storage::delete($pathOld);
            // Lakukan cropping
            $manager = new ImageManager(Driver::class);
            $croppedImage = $manager->read($request->file('foto'));
            $croppedImage->cover(300, 300, 'top-center')->save(storage_path('app/' . $path . $karyawan->foto));
        } else {
            $karyawan->foto = $old_foto;
        }

        if ($karyawan->update()) {
            // if ($request->hasFile('foto')) {
            //     $path = "public/uploads/karyawan/";
            //     $request->file('foto')->storeAs($path, $karyawan->foto);
            // }
            return redirect()->route('karyawan.index')->with('pesan', 'Data berhasil Diperbarui 👍');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal Diperbarui 😭');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = Karyawan::find($id);
        if ($karyawan->delete()) {
            return redirect()->route('karyawan.index')->with('pesan', 'Data berhasil Dihapus 👍');
        } else {
            return redirect()->route('karyawan.index')->with('gagal', 'Data gagal Dihapus 😭');
        }
    }
}
