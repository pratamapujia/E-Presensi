@extends('admin.layouts.index')

@section('title')
  <title>Master Karyawan</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}" />
@endsection

@section('main')
  <div class="page-heading">
    <h3>Master Karyawan</h3>
  </div>
  <div class="page-content">
    {{-- Alert --}}
    <div class="flash-data" data-berhasil="{{ Session::get('pesan') }}"></div>
    <div class="flash-data" data-gagal="{{ Session::get('gagal') }}"></div>
    <div class="card">
      <div class="card-header">
        <a href="{{ route('karyawan.create') }}" class="btn icon icon-left btn-primary">
          <i class="fas fa-plus"></i> Tambah Data
        </a>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>No</th>
              <th data-sortable="false">Foto</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>No. Hp</th>
              <th>Departemen</th>
              <th data-sortable="false">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($karyawan as $value)
              @php
                $path = Storage::url('uploads/karyawan/' . $value->foto);
              @endphp
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  <div class="avatar avatar-md">
                    @if (!empty($value->foto))
                      <img src="{{ url($path) }}" alt="Avatar">
                    @else
                      <img src="{{ asset('assets/img/default.png') }}" alt="">
                    @endif
                  </div>
                </td>
                <td>{{ $value->nik }}</td>
                <td>{{ $value->nama_lengkap }}</td>
                <td>{{ $value->jabatan }}</td>
                <td>{{ $value->no_hp }}</td>
                <td>{{ $value->nama_departemen }}</td>
                <td>
                  <a href="{{ route('karyawan.edit', $value->nik) }}" class="btn icon icon-left btn-sm btn-warning">
                    <li class="fas fa-edit"></li> Edit
                  </a>
                  <form action="{{ route('karyawan.destroy', $value->nik) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <button type="button" class="btn icon icon-left btn-danger btn-sm btn-delete">
                      <li class="fas fa-trash"></li> Hapus
                    </button>
                  </form>
                </td>
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
@endpush
