@extends('layouts.index')
@section('title')
  <title>Dashboard</title>
@endsection
@section('header')
  <div class="appHeader bg-primary">
    {{-- <div class="left">
      <a href="#" class="headerButton" data-bs-toggle="offcanvas" data-bs-target="#sidebarPanel">
        <ion-icon name="menu-outline"></ion-icon>
      </a>
    </div> --}}
    <div class="pageTitle">
      Dashboard
    </div>
    <div class="right">
      <a href="/prosesLogout" class="btn btn-danger ">
        <ion-icon name="log-out-outline"></ion-icon>
        LogOut
      </a>
    </div>
  </div>
@endsection
@section('main')
  <div class="container">
    {{-- Profile --}}
    <div class="section mt-2">
      <div class="profile-head">
        <div class="avatar">
          @if (!empty(Auth::guard('karyawan')->user()->foto))
            @php
              $path = Storage::url('uploads/karyawan/' . Auth::guard('karyawan')->user()->foto);
            @endphp
            <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded">
          @else
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
          @endif
        </div>
        <div class="in">
          <h3 class="name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h3>
          <h5 class="subtext">{{ Auth::guard('karyawan')->user()->jabatan }}</h5>
        </div>
      </div>
    </div>
    {{-- Presensi --}}
    <div class="section mt-2">
      <div class="row">
        <div class="col-6">
          <div class="card bg-success mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                @if ($presensiHariIni != null)
                  @php
                    $path = Storage::url('uploads/absensi/' . $presensiHariIni->foto_in);
                  @endphp
                  <img src="{{ url($path) }}" alt="Foto In" class="img-fluid rounded-start">
                @else
                  <img src="{{ asset('assets/img/icon/photo.png') }}" class="img-fluid rounded-start" alt="Camera">
                @endif
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Masuk</h5>
                  <p class="card-text">{{ $presensiHariIni != null ? $presensiHariIni->jam_in : 'Belum Absen Masuk' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="card bg-warning mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                @if ($presensiHariIni != null && $presensiHariIni->jam_out != null)
                  @php
                    $path = Storage::url('uploads/absensi/' . $presensiHariIni->foto_out);
                  @endphp
                  <img src="{{ url($path) }}" alt="Foto Out" class="img-fluid rounded-start">
                @else
                  <img src="{{ asset('assets/img/icon/photo.png') }}" class="img-fluid rounded-start" alt="Camera">
                @endif
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Pulang</h5>
                  <p class="card-text">{{ $presensiHariIni != null && $presensiHariIni->jam_out != null ? $presensiHariIni->jam_out : 'Belum Absen Pulang' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Info Presensi --}}
    <div class="section mt-2">
      <h2>Rekap absensi bulan {{ $namaBulan[$bulanIni] }} tahun {{ $tahunIni }}</h2>
      <div class="row">
        <div class="col-3">
          <div class="card">
            <div class="card-body comment-block">
              <div class="item">
                <div class="avatar">
                  <ion-icon name="accessibility-outline" class="text-primary fs-1"></ion-icon>
                </div>
                <div class="in">
                  <div class="comment-header">
                    <h4 class="title">Jumlah Hadir</h4>
                  </div>
                  <div class="text">
                    Bulan Ini : <span class="badge rounded-pill bg-danger">{{ $rekapPresensi->jmlHadir }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body comment-block">
              <div class="item">
                <div class="avatar">
                  <ion-icon name="alarm-outline" class="text-danger fs-1"></ion-icon>
                </div>
                <div class="in">
                  <div class="comment-header">
                    <h4 class="title">Jumlah Terlambat</h4>
                  </div>
                  <div class="text">
                    Bulan Ini : <span class="badge rounded-pill bg-danger">{{ $rekapPresensi->jmlTerlambat }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body comment-block">
              <div class="item">
                <div class="avatar">
                  <ion-icon name="newspaper-outline" class="text-success fs-1"></ion-icon>
                </div>
                <div class="in">
                  <div class="comment-header">
                    <h4 class="title">Jumlah Izin</h4>
                  </div>
                  <div class="text">
                    Bulan Ini : <span class="badge rounded-pill bg-danger">{{ $rekapIjin->izin }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body comment-block">
              <div class="item">
                <div class="avatar">
                  <ion-icon name="medkit-outline" class="text-warning fs-1"></ion-icon>
                </div>
                <div class="in">
                  <div class="comment-header">
                    <h4 class="title">Jumlah Sakit</h4>
                  </div>
                  <div class="text">
                    Bulan Ini : <span class="badge rounded-pill bg-danger">{{ $rekapIjin->sakit }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Laporan --}}
    <div class="section mt-2 mb-2">
      <div class="card mt-2">
        {{-- Tab --}}
        <ul class="nav nav-tabs capsuled" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#tab1" role="tab">
              <ion-icon name="calendar"></ion-icon>
              Bulan Ini
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab2" role="tab">
              <ion-icon name="podium"></ion-icon>
              Leaderboard
            </a>
          </li>
        </ul>
        {{-- Body Tab --}}
        <div class="tab-content mt-1">
          <div class="tab-pane fade show active" id="tab1" role="tabpanel">
            <div class="table-responsive">
              <table class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($historiBulanIni as $data)
                    <tr>
                      <td><ion-icon name="finger-print-outline" class="fs-2"></ion-icon></td>
                      <td>{{ date('d-M-Y', strtotime($data->tgl_absen)) }}</td>
                      <td><span class="badge {{ $data->jam_in < '07:00' ? 'badge-success' : 'badge-warning' }}">{{ $data->jam_in }}</span></td>
                      <td>
                        <span class="badge badge-danger">
                          {{ $presensiHariIni != null && $data->jam_out != null ? $data->jam_out : 'Belum Absen Pulang' }}
                        </span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="tab2" role="tabpanel">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($leaderboard as $data)
                    <tr>
                      <td>
                        <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="image" class="imaged w32 rounded">
                      </td>
                      <td>{{ $data->nama_lengkap }}</td>
                      <td>{{ $data->jabatan }}</td>
                      <td>
                        <span class="badge {{ $data->jam_in < '07:00' ? 'bg-success' : 'bg-warning' }}">
                          {{ $data->jam_in }}
                        </span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
