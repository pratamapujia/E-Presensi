<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PresensiController extends Controller
{
    // Bagian User Start
    public function create()
    {
        $hariIni = date('Y-m-d');
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('absensi')->where('tgl_absen', $hariIni)->where('nik', $nik)->count();
        return view('presensi.create', compact('cek'));
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_absen = date("Y-m-d");
        $jam = date("H:i:s");
        // -7.395649943836326, 112.76258229175109 Lokasi SMK Senopati
        // -7.359031769291131, 112.75287253858224 Lokasi Asli
        // -7.359706373310006, 112.75319377211852 Lokasi palsu
        $latitudeKantor = -7.395649943836326;
        $longitudeKantor = 112.76258229175109;
        $lokasi = $request->lokasi;
        $lokasiUser =   explode(",", $lokasi);
        $latitudeUser = $lokasiUser[0];
        $longitudeUser = $lokasiUser[1];
        $jarak = $this->distance($latitudeKantor, $longitudeKantor, $latitudeUser, $longitudeUser);
        $radius = round($jarak["meters"]);
        // dd($radius);

        $cek = DB::table('absensi')->where('tgl_absen', $tgl_absen)->where('nik', $nik)->count();
        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket  = "in";
        }
        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nik . "_" . date('Ymd_Hi') . "_" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
        if ($radius > 50) {
            echo "error|Anda berada di luar radius, jarak anda " . $radius . " meter dari kantor 😭|";
        } else {
            if ($cek > 0) {
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' => $lokasi,
                ];
                $update = DB::table('absensi')->where('tgl_absen', $tgl_absen)->where('nik', $nik)->update($data_pulang);
                if ($update) {
                    echo "success|Absen pulang 😎|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Absen pulang 😭|out";
                }
            } else {
                $data = [
                    'nik' => $nik,
                    'tgl_absen' => $tgl_absen,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi,
                ];
                $simpan = DB::table('absensi')->insert($data);
                if ($simpan) {
                    echo "success|Absen masuk 😎|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Absen masuk 😭|in";
                }
            }
        }
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    // Edit Profile
    public function editProfile()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('presensi.edit', compact('karyawan'));
    }

    public function updateProfile(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        if ($request->hasFile('foto')) {
            $foto = $nik . '.' . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }

        if (empty($request->password)) {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto,
            ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto,
                'password' => $password,
            ];
        }

        $update = DB::table('karyawan')->where('nik', $nik)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/karyawan";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return redirect()->back()->with(['success' => 'Data berhasil diperbarui']);
        } else {
            return redirect()->back()->with(['error' => 'Data gagal diperbarui']);
        }
    }

    public function histori()
    {
        $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('presensi.histori', compact('namaBulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;

        $histori = DB::table('absensi')
            ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_absen)="' . $tahun . '"')
            ->where('nik', $nik)->orderBy('tgl_absen')->get();

        return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataIzin = DB::table('perizinan')->where('nik', $nik)->get();
        return view('presensi.izin', compact('dataIzin'));
    }

    public function buatIzin()
    {
        return view('presensi.buatizin');
    }

    public function storeIzin(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $keterangan = $request->keterangan;
        $alasan = $request->alasan;

        $data = [
            'nik' => $nik,
            'tgl_izin' => $tgl_izin,
            'keterangan' => $keterangan,
            'alasan' => $alasan,
        ];

        $simpan = DB::table('perizinan')->insert($data);

        if ($simpan) {
            return redirect('/presensi/izin')->with(['success' => 'Data behasil dikirim']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Data gagal dikirim']);
        }
    }
    // Bagian User End

    // Bagian Admin Start
    public function monitoring()
    {
        return view('admin.presensi.index');
    }

    public function getPresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = DB::table('absensi')
            ->select('absensi.*', 'nama_lengkap', 'nama_departemen')
            ->join('karyawan', 'absensi.nik', '=', 'karyawan.nik')
            ->join('departemen', 'karyawan.kd_departemen', '=', 'departemen.kd_departemen')
            ->where('tgl_absen', $tanggal)->get();

        return view('admin.presensi.get', compact('presensi'));
    }

    public function laporan()
    {
        $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        return view('admin.laporan.index', compact('namaBulan', 'karyawan'));
    }

    public function cetakLaporan(Request $request)
    {
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $karyawan = DB::table('karyawan')->where('nik', $nik)
            ->join('departemen', 'karyawan.kd_departemen', '=', 'departemen.kd_departemen')->first();
        $absensi = DB::table('absensi')->where('nik', $nik)
            ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_absen)="' . $tahun . '"')
            ->orderBy('tgl_absen')->get();
        return view('admin.laporan.print', compact('bulan', 'tahun', 'namaBulan', 'karyawan', 'absensi'));
    }

    public function rekab()
    {
        $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('admin.laporan.rekab', compact('namaBulan'));
    }

    public function cetakRekab(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $rekab = DB::table('absensi')
            ->select('absensi.nik', 'nama_lengkap')
            ->join('karyawan', 'absensi.nik', '=', 'karyawan.nik')
            ->whereRaw('MONTH(tgl_absen) = ?', [$bulan])
            ->whereRaw('YEAR(tgl_absen) = ?', [$tahun])
            ->groupBy('absensi.nik', 'nama_lengkap');
        for ($i = 1; $i <= 31; $i++) {
            $rekab->selectRaw('MAX(IF(DAY(tgl_absen) = ' . $i . ', CONCAT(jam_in, " | ", IFNULL(jam_out, "00:00:00")), "")) as tgl_' . $i);
        }
        $rekab = $rekab->get();
        return view('admin.laporan.printRekab', compact('bulan', 'tahun', 'namaBulan', 'rekab'));
    }
    // Bagian Admin End
}
