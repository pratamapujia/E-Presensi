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
    <td>{{ $value->jam_in }}</td>
    <td>
      <div class="avatar avatar-md">
        @if (!empty($value->foto_in))
          <img src="{{ url($pathIn) }}" alt="Avatar">
        @else
          <img src="{{ asset('assets/img/default.png') }}" alt="">
        @endif
      </div>
    </td>
    <td>{{ $value->jam_out }}</td>
    <td>
      <div class="avatar avatar-md">
        @if (!empty($value->foto_out))
          <img src="{{ url($pathOut) }}" alt="Avatar">
        @else
          <img src="{{ asset('assets/img/default.png') }}" alt="">
        @endif
      </div>
    </td>
    {{-- <td>
      <a href="" type="button" class="btn icon icon-left btn-sm btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#modalEdit" id_departemen="{{ $value->id_departemen }}">
        <li class="fas fa-edit"></li> Edit
      </a>
      <form action="" method="POST" class="d-inline">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <button type="button" class="btn icon icon-left btn-danger btn-sm btn-delete">
          <li class="fas fa-trash"></li> Hapus
        </button>
      </form>
    </td> --}}
  </tr>
@endforeach
