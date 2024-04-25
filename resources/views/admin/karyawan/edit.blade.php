@extends('admin.layouts.index')

@section('title')
  <title>Form Edit Data</title>
@endsection

@section('main')
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Form Edit Data</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/karyawan">Master Karyawan</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Form Edit Data
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
            <h5>Master Karyawan</h5>
          </div>
          <div class="ms-auto">
            <a href="/karyawan" class="btn icon icon-left btn-primary">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('karyawan.update', $data->nik) }}" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="_method" value="put">
          <input type="hidden" name="old_foto" value="{{ $data->foto }}">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" name="nik" value="{{ $data->nik }}">
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="Nama Lengkap"
                  value="{{ old('nama_lengkap', $data->nama_lengkap) }}">
                @error('nama_lengkap')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" placeholder="Jabatan" value="{{ old('jabatan', $data->jabatan) }}">
                @error('jabatan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="no_hp">No. Hp</label>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="No. Hp" value="{{ old('no_hp', $data->no_hp) }}">
                @error('no_hp')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="kd_departemen">Nama Departemen</label>
                <select name="kd_departemen" id="kd_departemen" class="form-select @error('kd_departemen') is-invalid @enderror">
                  <option value="">Pilih Departemen</option>
                  @foreach ($dept as $value)
                    <option value="<?= $value->kd_departemen ?>" <?= old('kd_departemen', $data->kd_departemen) == $value->kd_departemen ? 'selected' : null ?>><?= $value->nama_departemen ?></option>
                    {{-- @if (old('kd_departemen') == $value->kd_departemen)
                      <option value="{{ $value->kd_departemen }}" selected>{{ $value->nama_departemen }}</option>
                    @else
                      <option value="{{ $value->kd_departemen }}">{{ $value->nama_departemen }}</option>
                    @endif --}}
                    {{-- <option {{ old('kd_depertemen', $value->kd_departemen) == $value->kd_departemen ? 'selected' : '' }} value="{{ $value->kd_departemen }}">{{ $value->nama_departemen }}</option> --}}
                  @endforeach
                </select>
                @error('kd_departemen')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" placeholder="Foto">
                @error('foto')
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
