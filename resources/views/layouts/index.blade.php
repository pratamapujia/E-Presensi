<!doctype html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    @yield('title')
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 5, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo2.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo2.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="{{ asset('__manifest.json') }}">
  </head>

  <body>

    <!-- loader -->
    <div id="loader">
      <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Header -->
    @yield('header')
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">
      @yield('main')
      {{-- <div class="section mt-3 mb-3">
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-end">
            <div>
              <h6 class="card-subtitle">Discover</h6>
              <h5 class="card-title mb-0 d-flex align-items-center justify-content-between">
                Dark Mode
              </h5>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodecontent">
              <label class="form-check-label" for="darkmodecontent"></label>
            </div>
          </div>
        </div>
      </div> --}}

      <!-- app footer -->
      {{-- <div class="appFooter">
        <img src="assets/img/logo.png" alt="icon" class="footer-logo mb-2">
        <div class="footer-title">
          Copyright © Mobilekit <span class="yearNow"></span>. All Rights Reserved.
        </div>
        <div>Mobilekit is PWA ready Mobile UI Kit Template.</div>
        Great way to start your mobile websites and pwa projects.

        <div class="mt-2">
          <a href="#" class="btn btn-icon btn-sm btn-facebook">
            <ion-icon name="logo-facebook"></ion-icon>
          </a>
          <a href="#" class="btn btn-icon btn-sm btn-twitter">
            <ion-icon name="logo-twitter"></ion-icon>
          </a>
          <a href="#" class="btn btn-icon btn-sm btn-linkedin">
            <ion-icon name="logo-linkedin"></ion-icon>
          </a>
          <a href="#" class="btn btn-icon btn-sm btn-instagram">
            <ion-icon name="logo-instagram"></ion-icon>
          </a>
          <a href="#" class="btn btn-icon btn-sm btn-whatsapp">
            <ion-icon name="logo-whatsapp"></ion-icon>
          </a>
          <a href="#" class="btn btn-icon btn-sm btn-secondary goTop">
            <ion-icon name="arrow-up-outline"></ion-icon>
          </a>
        </div>

      </div> --}}
      <!-- * app footer -->

    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    @include('layouts.bottomNav')
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    {{-- <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarPanel">
      <div class="offcanvas-body">
        <!-- profile box -->
        <div class="profileBox">
          <div class="image-wrapper">
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="imaged rounded">
          </div>
          <div class="in">
            <strong>Julian Gruber</strong>
            <div class="text-muted">
              <ion-icon name="location"></ion-icon>
              California
            </div>
          </div>
          <a href="#" class="close-sidebar-button" data-bs-dismiss="offcanvas">
            <ion-icon name="close"></ion-icon>
          </a>
        </div>
        <!-- * profile box -->
      </div>
      <!-- sidebar buttons -->
      <div class="sidebar-buttons">
        <a href="#" class="button">
          <ion-icon name="log-out-outline"></ion-icon>
        </a>
      </div>
      <!-- * sidebar buttons -->
    </div> --}}
    <!-- * App Sidebar -->

    <!-- ============== Js Files ==============  -->
    @include('layouts.script')

  </body>

</html>
