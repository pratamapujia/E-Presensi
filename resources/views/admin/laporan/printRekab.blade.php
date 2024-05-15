<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
      @page {
        size: A4
      }

      .title {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1.2rem;
        font-weight: bold;
      }

      .tblData {
        margin-top: 50px;
      }

      .tblData td {
        padding: 5px;
      }

      .tblPresensi {
        width: 100%;
        margin-top: 25px;
        border-collapse: collapse;
      }

      .tblPresensi tr th {
        border: 1px solid #353535;
        padding: 8px;
        font-size: 10px;
        background-color: sandybrown;
      }

      .tblPresensi tr td {
        border: 1px solid #353535;
        padding: 2px;
        font-size: 10px;
        text-align: center;
      }
    </style>
  </head>

  <!-- Set "A5", "A4" or "A3" for class name -->
  <!-- Set also "landscape" if you need -->

  <body class="A4 landscape">
    @php
      function selisih($jam_masuk, $jam_keluar)
      {
          [$h, $m, $s] = explode(':', $jam_masuk);
          $dtAwal = mktime($h, $m, $s, '1', '1', '1');
          [$h, $m, $s] = explode(':', $jam_keluar);
          $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
          $dtSelisih = $dtAkhir - $dtAwal;
          $totalmenit = $dtSelisih / 60;
          $jam = explode('.', $totalmenit / 60);
          $sisamenit = $totalmenit / 60 - $jam[0];
          $sisamenit2 = $sisamenit * 60;
          $jml_jam = $jam[0];
          return $jml_jam . ':' . round($sisamenit2);
      }
    @endphp

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

      <!-- Write HTML just like a web page -->
      <table style="width: 100%">
        <tr>
          <td style="width: 100px"><img src="{{ asset('assets/img/logo2.png') }}" alt="logo" height="80"></td>
          <td>
            <span class="title">Laporan Presensi Karyawan <br>
              Periode {{ $namaBulan[$bulan] }} {{ $tahun }}<br>
              PT. Pratama Jaya <br></span>
            <span><i>Jl. Tropodo I Barat No. 319B, Kecamatan Waru, Kabupaten Sidoarjo</i></span>
          </td>
        </tr>
      </table>
      <table class="tblPresensi">
        <tr>
          <th rowspan="2">Nik</th>
          <th rowspan="2">Nama Karyawan</th>
          <th colspan="31">Tanggal</th>
          <th rowspan="2">TH</th>
          <th rowspan="2">TT</th>
        </tr>
        <tr>
          @for ($i = 1; $i <= 31; $i++)
            <th>{{ $i }}</th>
          @endfor
        </tr>
        @foreach ($rekab as $data)
          <tr>
            <td>{{ $data->nik }}</td>
            <td>{{ $data->nama_lengkap }}</td>
            @php
              $tHadir = 0;
              $tTerlambat = 0;
            @endphp
            @for ($i = 1; $i <= 31; $i++)
              @php
                $tgl = 'tgl_' . $i;
                $hadir = !empty($data->$tgl) ? explode('|', $data->$tgl) : ['', ''];
                $tHadir += !empty($data->$tgl) ? 1 : 0;
                $tTerlambat += $hadir[0] > '07:00:00' ? 1 : 0;
              @endphp
              <td>
                <span style="color:{{ $hadir[0] > '07:00:00' ? 'red' : '' }} ">{{ $hadir[0] }}</span><br>
                <span>{{ $hadir[1] }}</span>
              </td>
            @endfor
            <td>{{ $tHadir }}</td>
            <td>{{ $tTerlambat }}</td>
          </tr>
        @endforeach
      </table>

      <table width="100%" style="margin-top: 100px">
        <tr>
          <td colspan="2" style="text-align: right; padding-right: 10%">Surabaya, {{ DATE('d M Y') }}</td>
        </tr>
        <tr>
          <td style="text-align: center; vertical-align: bottom;" height="100px">
            <span><u>Puji Istiani</u></span><br>
            <span><b>Manager HRD</b></span>
          </td>
          <td style="text-align: center; text-; vertical-align: bottom;" height="100px">
            <span><u>Budi Yanto</u></span><br>
            <span><b>Direktur</b></span>
          </td>
        </tr>
      </table>

    </section>

  </body>

</html>
