@extends('layouts.index')

@section('title')
  <title>Presensi</title>
@endsection

@section('header')
  <div class="appHeader bg-primary text-light">
    <div class="left">
      <a href="javascript:;" class="headerButton goBack">
        <ion-icon name="chevron-back-outline"></ion-icon>
      </a>
    </div>
    <div class="pageTitle">Presensi</div>
  </div>

  <style>
    .webcam-capture,
    .webcam-capture video {
      display: inline-block;
      width: 100% !important;
      margin: auto;
      max-height: 400px;
      height: auto !important;
    }

    @media only screen and (min-width: 1200px) {
      #map {
        height: 100%;
      }
    }

    @media only screen and (max-width: 1200px) {
      #map {
        height: 100%;
      }
    }

    @media only screen and (max-width: 768px) {
      #map {
        height: 200px;
      }
    }

    @media only screen and (max-width: 480px) {
      #map {
        height: 100px;
      }
    }
  </style>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection

@section('main')
  <div class="container">
    <div class="section mt-2 mb-2">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <input type="hidden" id="lokasi">
              <div class="webcam-capture"></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div id="map"></div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          @if ($cek > 0)
            <button id="takeAbsen" class="btn btn-danger btn-block">
              <ion-icon name="camera-outline"></ion-icon> Absen Pulang
            </button>
          @else
            <button id="takeAbsen" class="btn btn-primary btn-block">
              <ion-icon name="camera-outline"></ion-icon> Absen Masuk
            </button>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@push('myscript')
  <script>
    Webcam.set({
      height: 400,
      width: 640,
      image_format: 'jpeg',
      jpeg_quality: 80,

    });
    Webcam.attach('.webcam-capture');

    var lokasi = document.getElementById('lokasi');
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successCallback, errorCallback)
    }

    function successCallback(position) {
      lokasi.value = position.coords.latitude + ',' + position.coords.longitude;
      var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
      var lokasi_kantor = "{{ $lok_kantor->koordinat }}";
      var radius = "{{ $lok_kantor->radius }}"
      var lok = lokasi_kantor.split(',');
      var lat = lok[0];
      var long = lok[1];
      L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
      }).addTo(map);
      var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
      var circle = L.circle([lat, long], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: radius,
      }).addTo(map);
    }

    function errorCallback() {

    }

    $("#takeAbsen").click(function(e) {
      Webcam.snap(function(uri) {
        image = uri;
      });
      var lokasi = $("#lokasi").val();
      $.ajax({
        type: "POST",
        url: "/presensi/store",
        data: {
          _token: "{{ csrf_token() }}",
          image: image,
          lokasi: lokasi,
        },
        cache: false,
        success: function(response) {
          var status = response.split('|');
          if (status[0] == 'success') {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            Toast.fire({
              icon: 'success',
              title: 'Berhasil ! ' + status[1],
            })
            setTimeout("location.href='/dashboard'", 3100);
          } else {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            Toast.fire({
              icon: 'error',
              title: 'Gagal ! ' + status[1],
            })
          }
        }
      });
    });
  </script>
@endpush
