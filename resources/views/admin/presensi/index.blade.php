@extends('admin.layouts.index')

@section('title')
  <title>Monitoring Presensi</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/static/datepicker/css/bootstrap-datepicker3.standalone.css') }}">
@endsection

@section('main')
  <div class="page-heading">
    <h3>Master Departemen</h3>
  </div>
  <div class="page-content">
    {{-- Alert --}}
    <div class="flash-data" data-berhasil="{{ Session::get('pesan') }}"></div>
    <div class="flash-data" data-gagal="{{ Session::get('gagal') }}"></div>
    <div class="card">
      <div class="card-header">
        <div class="form-group has-icon-left">
          <label for="tanggal" class="form-label">Cari Tanggal</label>
          <div class="position-relative">
            <input type="text" class="form-control" placeholder="Masukkan Tanggal" value="{{ DATE('Y-m-d') }}" id="tanggal" name="tanggal">
            <div class="form-control-icon">
              <i class="bi bi-calendar-date"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama Karyawan</th>
              <th>Departemen</th>
              <th>Jam Masuk</th>
              <th data-sortable="false">Foto Masuk</th>
              <th>Jam Keluar</th>
              <th data-sortable="false">Foto Keluar</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody id="loadPresensi"></tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@push('adminScript')
  <script src="{{ asset('assets/admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/admin/static/js/pages/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/admin/static/datepicker/js/bootstrap-datepicker.js') }}"></script>
  <script>
    $(function() {
      $('#tanggal').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        orientation: 'bottom auto'
      });

      function loadPresensi() {
        var tanggal = $('#tanggal').val();
        $.ajax({
          type: 'POST',
          url: '/getPresensi',
          data: {
            _token: "{{ csrf_token() }}",
            tanggal: tanggal
          },
          cache: false,
          success: function(respond) {
            $("#loadPresensi").html(respond);
          }
        });
      }

      $('#tanggal').change(function(e) {
        loadPresensi();
      });

      loadPresensi();
    });
  </script>
@endpush
