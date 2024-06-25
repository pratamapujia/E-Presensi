@extends('admin.layouts.index')

@section('title')
  <title>Form Tambah Jam Kerja</title>
@endsection

@section('main')
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Form Tambah Jam Kerja</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/konfigurasi/jam">Jam Kerja</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Form Tambah Jam Kerja
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="page-content">
    <div class="flash-data" data-gagal="{{ Session::get('gagal') }}"></div>
    <div class="card">
      <div class="card-header">
        <div class="media d-flex align-items-center">
          <div class="me-3">
            <h5>Jam Kerja</h5>
          </div>
          <div class="ms-auto">
            <a href="/konfigurasi/jam" class="btn icon icon-left btn-primary">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="/storeJam" class="form" method="POST">
          @csrf
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="kd_jam">Kode Jam</label>
                <input type="text" class="form-control" name="kd_jam" value="{{ $nextKode }}" readonly>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="nama_jam">Nama Jam</label>
                <input type="text" class="form-control @error('nama_jam') is-invalid @enderror" name="nama_jam" placeholder="Nama Jam" value="{{ old('nama_jam') }}">
                @error('nama_jam')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="awal_jam">Awal Jam</label>
                <input type="time" class="form-control @error('awal_jam') is-invalid @enderror" name="awal_jam" placeholder="Awal Jam" value="{{ old('awal_jam') }}">
                @error('awal_jam')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="jam_masuk">Jam Masuk</label>
                <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" name="jam_masuk" placeholder="Jam Masuk" value="{{ old('jam_masuk') }}">
                @error('jam_masuk')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="akhir_jam">Akhir Jam</label>
                <input type="time" class="form-control @error('akhir_jam') is-invalid @enderror" name="akhir_jam" placeholder="Akhir Jam" value="{{ old('akhir_jam') }}">
                @error('akhir_jam')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="jam_pulang">Jam Pulang</label>
                <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror" name="jam_pulang" placeholder="Jam Pulang" value="{{ old('jam_pulang') }}">
                @error('jam_pulang')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-6 mt-2">
              <button class="btn btn-primary icon icon-left btn-block">
                <i class="fas fa-paper-plane"></i> Simpan
              </button>
            </div>
            <div class="col-6 mt-2">
              <button type="reset" class="btn btn-secondary icon icon-left btn-block">
                <i class="fas fa-sync"></i> Reset
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
