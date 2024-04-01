@if ($histori->isEmpty())
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Tidak ada data pada bulan ini!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<ul class="listview image-listview">
  @foreach ($histori as $data)
    <li>
      <div class="item">
        @php
          $path = Storage::url('uploads/absensi/' . $data->foto_in);
        @endphp
        <img src="{{ url($path) }}" alt="image" class="image">
        <div class="in">
          <div>
            <b>{{ date('d-m-Y', strtotime($data->tgl_absen)) }}</b><br>
            {{-- <small class="text-muted">{{ $data->jabatan }}</small> --}}
          </div>
          <span class="badge {{ $data->jam_in < '07:00' ? 'bg-success' : 'bg-danger' }}">
            {{ $data->jam_in }}
          </span>
          <span class="badge bg-primary">{{ $data->jam_out }}</span>
        </div>
      </div>
    </li>
  @endforeach
</ul>
