@extends('admin.layouts.index')
@section('title')
  <title>Laporan Rekab Absensi</title>
@endsection

@section('main')
  <div class="page-heading">
    <h3>Laporan Rekab Absensi</h3>
  </div>
  <div class="page-content">
    <div class="card">
      <div class="card-body">
        <form action="/cetakRekab" target="_blank" method="POST">
          @csrf
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="bulan" class="form-label">Bulan</label>
                <select name="bulan" id="bulan" class="form-select">
                  <option value=""> --Pilih Bulan-- </option>
                  @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ DATE('m') == $i ? 'selected' : '' }}>{{ $namaBulan[$i] }}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="tahun" class="form-label">Tahun</label>
                <select name="tahun" id="tahun" class="form-select">
                  <option value="null"> --Pilih Tahun-- </option>
                  @php
                    $tahunMulai = 2022;
                    $tahunSekarang = DATE('Y');
                  @endphp
                  @for ($tahun = $tahunMulai; $tahun <= $tahunSekarang; $tahun++)
                    <option value="{{ $tahun }}" {{ DATE('Y') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" name="btnCetak" class="btn btn-primary icon icon-left"><i class="fas fa-print"></i> Cetak</button>
              <button type="submit" name="btnExcel" class="btn btn-success icon icon-left"><i class="fas fa-download"></i> Download Excel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection