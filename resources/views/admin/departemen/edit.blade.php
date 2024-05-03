<form action="{{ route('departemen.update', $dep->id_departemen) }}" class="form needs-validation" method="POST" novalidate>
  @csrf
  <input type="hidden" name="_method" value="put">
  <div class="modal-body">
    <label for="kd_departemen">Kode Departemen</label>
    <div class="form-group">
      <input id="kd_departemen" type="text" placeholder="Kode Departemen" name="kd_departemen" class="form-control @error('kd_departemen') is-invalid @enderror"
        value="{{ old('kd_departemen', $dep->kd_departemen) }}" required>
      @error('kd_departemen')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <label for="nama_departemen">Nama Departemen</label>
    <div class="form-group">
      <input id="nama_departemen" type="text" placeholder="Nama Departemen" name="nama_departemen" class="form-control @error('nama_departemen') is-invalid @enderror"
        value="{{ old('nama_departemen', $dep->nama_departemen) }}" required>
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
