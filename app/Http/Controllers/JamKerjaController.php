<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JamKerjaController extends Controller
{
    public function SetJamKerja()
    {
        $jamKerja = DB::table('jam_kerja')->orderBy('kd_jam')->get();
        return view('admin.jam.index', compact('jamKerja'));
    }
}
