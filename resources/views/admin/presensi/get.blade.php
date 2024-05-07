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
@foreach ($presensi as $value)
  @php
    $pathIn = Storage::url('uploads/absensi/' . $value->foto_in);
    $pathOut = Storage::url('uploads/absensi/' . $value->foto_out);
  @endphp
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $value->nik }}</td>
    <td>{{ $value->nama_lengkap }}</td>
    <td>{{ $value->nama_departemen }}</td>
    <td>
      @if ($value->jam_in >= '07:00')
        <span class="badge bg-warning">{{ $value->jam_in }}</span>
      @else
        <span class="badge bg-success ">{{ $value->jam_in }}</span>
      @endif
    </td>
    <td>
      <div class="avatar avatar-lg">
        @if (!empty($value->foto_in))
          <img src="{{ url($pathIn) }}" alt="Avatar">
        @else
          <img src="{{ asset('assets/img/default.png') }}" alt="">
        @endif
      </div>
    </td>
    <td>
      @if ($value->jam_out != null)
        <span class="badge bg-danger ">{{ $value->jam_out }}</span>
      @else
        <span class="badge bg-danger">Belum Absen Pulang</span>
      @endif
    </td>
    <td>
      <div class="avatar avatar-lg">
        @if (!empty($value->foto_out))
          <img src="{{ url($pathOut) }}" alt="Avatar">
        @else
          <img src="{{ asset('assets/img/default.png') }}" alt="">
        @endif
      </div>
    </td>
    <td>
      @php
        $jamTerlambat = selisih('07:00:00', $value->jam_in);
      @endphp
      @if ($value->jam_in >= '07:00')
        <span class="badge bg-warning">Terlambat | {{ $jamTerlambat }}</span>
      @else
        <span class="badge bg-success ">Tepat Waktu</span>
      @endif
    </td>
  </tr>
@endforeach
