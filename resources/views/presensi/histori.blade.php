@extends('layouts.index')
@section('header')
  <div class="appHeader bg-primary text-light">
    <div class="left">
      <a href="/dashboard" class="headerButton goBack">
        <ion-icon name="chevron-back-outline"></ion-icon>
      </a>
    </div>
    <div class="pageTitle">Histori Presensi</div>
    <div class="right"></div>
  </div>
@endsection
@section('main')
  <div class="container">
    <div class="section mt-2">
      <div class="card">
        <div class="card-body">
          <div class="row g-3">
            <div class="col-6">
              <select name="bulan" id="bulan" class="form-select">
                <option>Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                  <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>{{ $namaBulan[$i] }}</option>
                @endfor
              </select>
            </div>
            <div class="col-6">
              <select name="tahun" id="tahun" class="form-select">
                <option>Tahun</option>
                @php
                  $tahunAwal = '2023';
                  $tahunIni = date('Y');
                @endphp
                @for ($tahun = $tahunAwal; $tahun <= $tahunIni; $tahun++)
                  <option value="{{ $tahun }}" {{ date('Y') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endfor
              </select>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary btn-block" id="getData">
            <ion-icon name="search-outline"></ion-icon>
            Search
          </button>
        </div>
      </div>
    </div>
    <div class="section mt-2">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col" id="showHistori"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('myscript')
  <script>
    $(function() {
      $("#getData").click(function(e) {
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();
        $.ajax({
          type: 'POST',
          url: '/gethistori',
          data: {
            _token: '{{ csrf_token() }}',
            bulan: bulan,
            tahun: tahun,
          },
          cache: false,
          success: function(respond) {
            $('#showHistori').html(respond);
          }
        });
      });
    });
  </script>
@endpush
