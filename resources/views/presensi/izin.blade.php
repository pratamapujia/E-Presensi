@extends('layouts.index')
@section('title')
  <title>History Izin</title>
@endsection
@section('header')
  <div class="appHeader bg-primary text-light">
    <div class="left">
      <a href="/dashboard" class="headerButton goBack">
        <ion-icon name="chevron-back-outline"></ion-icon>
      </a>
    </div>
    <div class="pageTitle">Data Izin / Sakit</div>
    <div class="right"></div>
  </div>
@endsection
@section('main')
  @if (Session::get('success'))
    <div class="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
  @endif
  @if (Session::get('error'))
    <div class="flash-data" data-flasherror="{{ Session::get('error') }}"></div>
  @endif
  <div class="container">
    <div class="section mt-2 row">
      @foreach ($dataIzin as $data)
        <div class="col-6 col-sm-6 col-md-4 col-lg-3 pt-2">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-7">
                  <h5 class="card-title">
                    {{ $data->keterangan == 's' ? 'Sakit' : 'Izin' }}
                  </h5>
                </div>
                <div class="col-5 text-end">
                  @if ($data->laporan == 0)
                    <span class="badge bg-warning">Waiting</span>
                  @elseif ($data->laporan == 1)
                    <span class="badge bg-success">Disetujui</span>
                  @else
                    <span class="badge bg-danger">Ditolak</span>
                  @endif
                </div>
              </div>
              <h6 class="card-subtitle mb-2 text-muted">{{ date('d M Y', strtotime($data->tgl_izin)) }}</h6>
              <p class="card-text overflow-auto" style="height: 40px">{{ $data->alasan }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <div class="fab-button text bottom-right" style="margin-bottom: 80px">
    <a href="/presensi/buatizin" class="fab">
      <ion-icon name="add-outline"></ion-icon>
      Buat Izin
    </a>
  </div>
@endsection
@push('myscript')
  <script>
    // Sweet Alert
    const flashData = $(".flash-data").data("flashdata");
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
    if (flashData) {
      Toast.fire({
        icon: "success",
        title: flashData,
      });
    }
    if (flasherror) {
      Toast.fire({
        icon: "error",
        title: flasherror,
      });
    }
  </script>
@endpush
