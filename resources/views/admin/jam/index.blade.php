@extends('admin.layouts.index')

@section('title')
  <title>Konfigurasi Jam Kerja</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}" />
@endsection

@section('main')
  <div class="page-heading">
    <h3>Konfigurasi Jam Kerja</h3>
  </div>
  <div class="page-content">
    {{-- Alert --}}
    <div class="flash-data" data-berhasil="{{ Session::get('pesan') }}"></div>
    <div class="flash-data" data-gagal="{{ Session::get('gagal') }}"></div>
    <div class="card">
      <div class="card-header">
        <a href="" class="btn icon icon-left btn-primary">
          <i class="fas fa-plus"></i> Tambah Data
        </a>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Jam</th>
              <th>Nama Jam</th>
              <th>Awal Jam Masuk</th>
              <th>Jam Masuk</th>
              <th>Akhir Jam Masuk</th>
              <th>Jam Pulang</th>
              <th data-sortable="false">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jamKerja as $value)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->kd_jam }}</td>
                <td>{{ $value->nama_jam }}</td>
                <td>{{ $value->awal_jam }}</td>
                <td>{{ $value->jam_masuk }}</td>
                <td>{{ $value->akhir_jam }}</td>
                <td>{{ $value->jam_pulang }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@push('adminScript')
  <script src="{{ asset('assets/admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/admin/static/js/pages/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/admin/static/datepicker/js/bootstrap-datepicker.js') }}"></script>
@endpush
