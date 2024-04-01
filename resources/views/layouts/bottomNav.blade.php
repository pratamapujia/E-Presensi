<div class="appBottomMenu rounded ">
  <a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
    <div class="col">
      <ion-icon name="home-outline"></ion-icon>
      <strong>Home</strong>
    </div>
  </a>
  <a href="/presensi/histori" class="item {{ request()->is('presensi/histori') ? 'active' : '' }}">
    <div class="col">
      <ion-icon name="document-text-outline" role="img" class="md hydrated"></ion-icon>
      <strong>Histori</strong>
    </div>
  </a>
  <a href="/presensi/create" class="item">
    <div class="col">
      <div class="action-button large">
        <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
      </div>
    </div>
  </a>
  <a href="/presensi/izin" class="item {{ request()->is('presensi/izin', 'presensi/buatizin') ? 'active' : '' }}">
    <div class="col">
      <ion-icon name="calendar-outline" role="img" class="md hydrated"></ion-icon>
      <strong>Izin</strong>
    </div>
  </a>
  <a href="/edit" class="item {{ request()->is('edit') ? 'active' : '' }}">
    <div class="col">
      <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
      <strong>Profile</strong>
    </div>
  </a>
</div>
