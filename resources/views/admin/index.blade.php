@extends('admin.layouts.index')
@section('title')
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/iconly.css') }}"> --}}
@endsection
@section('main')
  <div class="page-heading">
    <h3>Dashboard</h3>
    {{-- <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.html">Dashboard</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Layout Vertical Navbar
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div> --}}
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-6 col-sm-6 col-md-6 col-lg-3">
        <div class="card">
          <div class="card-body px-4 py-4-5">
            <div class="row">
              <div class="col-12 col-sm-4 col-md-4 col-lg-5 d-flex justify-content-start ">
                <div class="stats-icon bg-primary mb-2">
                  <i class="fas fa-fingerprint"></i>
                </div>
              </div>
              <div class="col-12 col-sm-8 col-md-8 col-lg-7">
                <h6 class="text-muted font-semibold">Kehadiran</h6>
                <h6 class="font-extrabold mb-0">{{ $rekapPresensi->jmlHadir }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-sm-6 col-md-6 col-lg-3">
        <div class="card">
          <div class="card-body px-4 py-4-5">
            <div class="row">
              <div class="col-12 col-sm-4 col-md-4 col-lg-5 d-flex justify-content-start ">
                <div class="stats-icon bg-danger mb-2">
                  <i class="fas fa-user-slash"></i>
                </div>
              </div>
              <div class="col-12 col-sm-8 col-md-8 col-lg-7">
                <h6 class="text-muted font-semibold">Keterlambatan</h6>
                <h6 class="font-extrabold mb-0">{{ $rekapPresensi->jmlTerlambat }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-sm-6 col-md-6 col-lg-3">
        <div class="card">
          <div class="card-body px-4 py-4-5">
            <div class="row">
              <div class="col-12 col-sm-4 col-md-4 col-lg-5 d-flex justify-content-start ">
                <div class="stats-icon bg-secondary mb-2">
                  <i class="fas fa-clipboard-list"></i>
                </div>
              </div>
              <div class="col-12 col-sm-8 col-md-8 col-lg-7">
                <h6 class="text-muted font-semibold">Izin</h6>
                <h6 class="font-extrabold mb-0">{{ $rekapIzin->izin != null ? $rekapIzin->izin : 0}}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-sm-6 col-md-6 col-lg-3">
        <div class="card">
          <div class="card-body px-4 py-4-5">
            <div class="row">
              <div class="col-12 col-sm-4 col-md-4 col-lg-5 d-flex justify-content-start ">
                <div class="stats-icon bg-warning mb-2">
                  <i class="fas fa-notes-medical"></i>
                </div>
              </div>
              <div class="col-12 col-sm-8 col-md-8 col-lg-7">
                <h6 class="text-muted font-semibold">Sakit</h6>
                <h6 class="font-extrabold mb-0">{{ $rekapIzin->sakit != null ? $rekapIzin->sakit : 0}}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
