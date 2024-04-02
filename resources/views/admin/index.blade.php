@extends('admin.layouts.index')
@section('title')
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/iconly.css') }}">
@endsection
@section('main')
  <div class="page-heading">
    <h3>Dashboard</h3>
    {{-- <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.html">Dashboard</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Layout Vertical Navbar
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div> --}}
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card">
          <div class="card-body px-4 py-4-5">
            <div class="row">
              <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                <div class="stats-icon purple mb-2">
                  <i class="iconly-boldShow"></i>
                </div>
              </div>
              <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                <h6 class="text-muted font-semibold">Profile Views</h6>
                <h6 class="font-extrabold mb-0">112.000</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
