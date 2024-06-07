@extends('layouts.index')
@section('title')
  <title>Buat Izin</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/static/datepicker/css/bootstrap-datepicker3.standalone.css') }}">
@endsection
@section('header')
  <div class="appHeader bg-primary text-light">
    <div class="left">
      <a href="/presensi/izin" class="headerButton goBack">
        <ion-icon name="chevron-back-outline"></ion-icon>
      </a>
    </div>
    <div class="pageTitle">Form Buat Izin</div>
    <div class="right"></div>
  </div>
  @if (Session::get('error'))
    <div class="flash-data" data-flasherror="{{ Session::get('error') }}"></div>
  @endif
@endsection
@section('main')
  <div class="container">
    <div class="section mt-2">
      <div class="card">
        <div class="card-body">
          <form action="/presensi/storeizin" method="POST" id="formIzin" class="row g-3 needs-validation" novalidate>
            @csrf
            <div class="col-6">
              <label for="tgl_izin" class="form-label">Tanggal Izin</label>
              <input type="text" class="form-control" id="tgl_izin" name="tgl_izin" required>
              <div class="invalid-feedback">
                Tanggal Izin harus diisi!
              </div>
            </div>
            <div class="col-6">
              <label for="keterangan" class="form-label">Keterangan</label>
              <select name="keterangan" id="keterangan" class="form-select" required>
                <option value="">Sakit / Izin</option>
                <option value="s">Sakit</option>
                <option value="i">Izin</option>
              </select>
              <div class="invalid-feedback">
                Pilih salah satu keterangan
              </div>
            </div>
            <div class="col-12">
              <label for="alasan" class="form-label">Alasan</label>
              <textarea name="alasan" id="alasan" cols="10" rows="5" class="form-control" required></textarea>
              <div class="invalid-feedback">
                Alasan harus diisi!
              </div>
            </div>
            <div class="col-12">
              <div class="mt-2">
                <button class="btn btn-primary btn-block">KIRIM</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('myscript')
  <script src="{{ asset('assets/admin/static/datepicker/js/bootstrap-datepicker.js') }}"></script>
  <script>
    $('#tgl_izin').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      orientation: 'bottom auto'
    });

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();

    // Sweet Alert
    const flasherror = $(".flash-data").data("flasherror");
    const Toast = Swal.mixin({
      toast: true,
      position: "top",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });
    if (flasherror) {
      Toast.fire({
        icon: "warning",
        title: flasherror,
      });
    }
  </script>
@endpush
