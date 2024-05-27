@extends('admin.layouts.index')

@section('title')
  <title>Konfigurasi Lokasi Kantor</title>
@endsection

@section('main')
  <div class="page-heading">
    <h3>Konfigurasi Lokasi Kantor</h3>
  </div>
  <div class="page-content">
    {{-- Alert --}}
    <div class="flash-data" data-berhasil="{{ Session::get('pesan') }}"></div>
    <div class="flash-data" data-gagal="{{ Session::get('gagal') }}"></div>
    <div class="card">
      <div class="card-header">
        <form action="/konfigurasi/updateLokasi" method="POST">
          @csrf
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group has-icon-left">
                <label for="koordinat" class="form-label">Koordinat</label>
                <div class="position-relative">
                  <input type="text" class="form-control" value="{{ $lok_kantor->koordinat }}" id="koordinat" name="koordinat">
                  <div class="form-control-icon">
                    <i class="bi bi-geo-alt"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="form-group has-icon-left">
                <label for="radius" class="form-label">Radius</label>
                <div class="position-relative">
                  <input type="text" class="form-control" value="{{ $lok_kantor->radius }}" id="radius" name="radius">
                  <div class="form-control-icon">
                    <i class="bi bi-geo-fill"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary icon icon-left btn-block"><i class="fas fa-refresh"></i> Update Lokasi</button>
        </form>
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
