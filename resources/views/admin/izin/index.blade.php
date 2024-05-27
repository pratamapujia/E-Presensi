@extends('admin.layouts.index')

@section('title')
  <title>Izin / Sakit</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}" />
@endsection

@section('main')
  <div class="page-heading">
    <h3>Data Izin / Sakit</h3>
  </div>
  <div class="page-content">
    {{-- Alert --}}
    <div class="flash-data" data-berhasil="{{ Session::get('pesan') }}"></div>
    <div class="flash-data" data-gagal="{{ Session::get('gagal') }}"></div>
    <div class="card">
      {{-- <div class="card-header">
        <div class="form-group has-icon-left">
          <label for="tanggal" class="form-label">Cari Tanggal</label>
          <div class="position-relative">
            <input type="text" class="form-control" placeholder="Masukkan Tanggal" value="{{ DATE('Y-m-d') }}" id="tanggal" name="tanggal">
            <div class="form-control-icon">
              <i class="bi bi-calendar-date"></i>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>No.</th>
              <th>Tanggal</th>
              <th>NIK</th>
              <th>Nama Karyawan</th>
              <th>Jabatan</th>
              <th>Keterangan</th>
              <th>Alasan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($izinsakit as $d)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ DATE('d F Y', strtotime($d->tgl_izin)) }}</td>
                <td>{{ $d->nik }}</td>
                <td>{{ $d->nama_lengkap }}</td>
                <td>{{ $d->jabatan }}</td>
                <td>{{ $d->keterangan == 'i' ? 'Izin' : 'Sakit' }}</td>
                <td>{{ $d->alasan }}</td>
                <td>
                  @if ($d->laporan == 1)
                    <span class="badge bg-success">Disetujui</span>
                  @elseif ($d->laporan == 2)
                    <span class="badge bg-danger">Ditolak</span>
                  @else
                    <span class="badge bg-warning">Waiting</span>
                  @endif
                </td>
                <td>
                  @if ($d->laporan == 0)
                    <button type="button" class="btn btn-sm btn-primary icon icon-left" data-bs-toggle="modal" data-bs-target="#editModal-{{ $d->id }}">
                      <i class="bi bi-pencil-square"></i> Edit
                    </button>
                  @else
                    <form action="/izin/{{ $d->id }}/cancel" method="POST" class="d-inline" id="cancelForm-{{ $d->id }}">
                      @csrf
                      <button type="button" class="btn btn-sm btn-light icon icon-left cancel-btn text-danger" data-id="{{ $d->id }}">
                        <i class="bi bi-trash"></i> Batal
                      </button>
                    </form>
                  @endif
                </td>
              </tr>
              <!-- Edit Modal -->
              <div class="modal fade" id="editModal-{{ $d->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $d->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel-{{ $d->id }}">Edit Laporan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/izin/{{ $d->id }}/update" method="POST">
                      @csrf
                      {{-- @method('PUT') --}}
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="laporan-{{ $d->id }}">Laporan</label>
                          <select class="form-control" id="laporan-{{ $d->id }}" name="laporan">
                            <option value="0" {{ $d->laporan == 0 ? 'selected' : '' }}>Waiting</option>
                            <option value="1" {{ $d->laporan == 1 ? 'selected' : '' }}>Disetujui</option>
                            <option value="2" {{ $d->laporan == 2 ? 'selected' : '' }}>Ditolak</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@push('adminScript')
  <script src="{{ asset('assets/admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/admin/static/js/pages/simple-datatables.js') }}"></script>
  <script>
    document.querySelectorAll('.cancel-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.dataset.id;
        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Status akan dibatalkan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Batalkan!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById(`cancelForm-${id}`).submit();
          }
        });
      });
    });
  </script>
@endpush
