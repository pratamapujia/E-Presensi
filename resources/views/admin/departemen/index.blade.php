@extends('admin.layouts.index')

@section('title')
  <title>Master Departemen</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}" />
@endsection

@section('main')
  <div class="page-heading">
    <h3>Master Departemen</h3>
  </div>
  <div class="page-content">
    {{-- Alert --}}
    <div class="flash-data" data-berhasil="{{ Session::get('pesan') }}"></div>
    <div class="flash-data" data-gagal="{{ Session::get('gagal') }}"></div>
    <div class="card">
      <div class="card-header">
        <a href="" type="button" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#modalInput">
          <i class="fas fa-plus"></i> Tambah Data
        </a>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Departemen</th>
              <th>Nama Departemen</th>
              <th data-sortable="false">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dep as $value)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->kd_departemen }}</td>
                <td>{{ $value->nama_departemen }}</td>
                <td>
                  <a href="" type="button" class="btn icon icon-left btn-sm btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#modalEdit" id_departemen="{{ $value->id_departemen }}">
                    <li class="fas fa-edit"></li> Edit
                  </a>
                  <form action="{{ route('departemen.destroy', $value->id_departemen) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <button type="button" class="btn icon icon-left btn-danger btn-sm btn-delete">
                      <li class="fas fa-trash"></li> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- Modal Input --}}
  <div class="modal modal-borderless fade text-left" id="modalInput" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Departemen</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form action="{{ route('departemen.store') }}" class="form needs-validation" method="POST" novalidate>
          @csrf
          <div class="modal-body">
            <label for="kd_departemen">Kode Departemen</label>
            <div class="form-group">
              <input id="kd_departemen" type="text" placeholder="Kode Departemen" name="kd_departemen" class="form-control @error('kd_departemen') is-invalid @enderror"
                value="{{ old('kd_departemen') }}" required>
              @error('kd_departemen')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <label for="nama_departemen">Nama Departemen</label>
            <div class="form-group">
              <input id="nama_departemen" type="text" placeholder="Nama Departemen" name="nama_departemen" class="form-control @error('nama_departemen') is-invalid @enderror"
                value="{{ old('nama_departemen') }}" required>
              @error('nama_departemen')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary icon icon-left btn-sm-block">
              <i class="fas fa-sync"></i> Reset
            </button>
            <button class="btn btn-primary icon icon-left btn-sm-block">
              <i class="fas fa-paper-plane"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Modal Edit --}}
  <div class="modal modal-borderless fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Departemen</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div id="loadFormEdit"></div>
      </div>
    </div>
  </div>
@endsection

@push('adminScript')
  <script src="{{ asset('assets/admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/admin/static/js/pages/simple-datatables.js') }}"></script>
  <script>
    $(document).ready(function() {
      @if ($errors->any())
        $('#modalInput').modal('show');
      @endif
    });

    $(function() {
      $('.btnEdit').click(function() {
        var id_departemen = $(this).attr('id_departemen');
        $.ajax({
          type: 'POST',
          url: '/departemen/edit',
          cache: false,
          data: {
            _token: "{{ csrf_token() }}",
            id_departemen: id_departemen,
          },
          success: function(respond) {
            $('#loadFormEdit').html(respond);
          }
        });
      });
    });
  </script>
@endpush
