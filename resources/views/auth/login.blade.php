<!doctype html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Login | Absensi Online</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 5, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/icon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="{{ asset('__manifest.json') }}">
  </head>

  <body class="bg-white">

    <!-- loader -->
    <div id="loader">
      <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

      <div class="login-form mt-1">
        <div class="section">
          <img src="{{ asset('assets/img/welcome.jpg') }}" alt="image" class="form-image">
        </div>
        <div class="section mt-1">
          <h1>Form Login</h1>
          <h4>Isi form dibawah untuk masuk ke aplikasi</h4>
        </div>
        <div class="section mt-1 mb-5">
          @php
            $alert = Session::get('pesan');
          @endphp
          @if (Session::get('pesan'))
            <div class="alert alert-outline-danger alert-dismissible fade show" role="alert">
              <strong>{{ $alert }}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <form action="/prosesLogin" method="POST">
            @csrf
            <div class="form-group boxed">
              <div class="input-wrapper">
                <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK" required>
                <i class="clear-input">
                  <ion-icon name="close-circle"></ion-icon>
                </i>
              </div>
            </div>

            <div class="form-group boxed">
              <div class="input-wrapper">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <i class="clear-input">
                  <ion-icon name="close-circle"></ion-icon>
                </i>
              </div>
            </div>

            <div class="mt-3">
              <small class="text-danger"><i class="bi bi-exclamation-triangle"></i> Jika lupa password, silahkan hubungi Admin</small>
            </div>

            <div class="form-button-group">
              <button type="submit" class="btn btn-primary btn-block btn-lg">Masuk</button>
            </div>

          </form>
        </div>
      </div>


    </div>
    <!-- * App Capsule -->

    <!-- ============== Js Files ==============  -->
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="{{ asset('assets/js/plugins/splide/splide.min.js') }}"></script>
    <!-- ProgressBar js -->
    <script src="{{ asset('assets/js/plugins/progressbar-js/progressbar.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js') }}"></script>
  </body>

</html>
