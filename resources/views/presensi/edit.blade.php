@extends('layouts.index')
@section('title')
  <title>Edit Profile</title>
@endsection
@section('header')
  <div class="appHeader bg-primary text-light">
    <div class="left">
      <a href="/dashboard" class="headerButton goBack">
        <ion-icon name="chevron-back-outline"></ion-icon>
      </a>
    </div>
    <div class="pageTitle">Edit Profile</div>
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
    <div class="section mt-2">
      <div class="card">
        <div class="card-body">
          <form action="/presensi/{{ $karyawan->nik }}/updateprofile" class="row g-3" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
              <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" value="{{ $karyawan->nama_lengkap }}" name="nama_lengkap" autocomplete="off">
            </div>
            <div class="col-6">
              <label for="no_hp" class="form-label">No Hp</label>
              <input type="text" class="form-control" value="{{ $karyawan->no_hp }}" name="no_hp" placeholder="No. HP" autocomplete="off">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <label for="foto" class="form-label">Foto</label>
              <input type="file" name="foto" id="fileuploadInput" class="form-control" accept=".png, .jpg, .jpeg">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">
                <ion-icon name="refresh-outline"></ion-icon>
                Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
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
