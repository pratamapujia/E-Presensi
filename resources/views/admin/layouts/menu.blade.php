<div class="sidebar-menu">
  <ul class="menu">
    <li class="sidebar-item {{ request()->is('panel/dashboard') ? 'active' : '' }}">
      <a href="/panel/dashboard" class="sidebar-link">
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="sidebar-item {{ request()->is('monitoring', 'monitoring/*') ? 'active' : '' }} ">
      <a href="/monitoring" class="sidebar-link">
        <i class="bi bi-graph-up"></i>
        <span>Monitoring Presensi</span>
      </a>
    </li>
    <li class="sidebar-item has-sub {{ request()->is('karyawan', 'karyawan/*', 'departemen', 'departemen/*') ? 'active' : '' }}">
      <a href="#" class="sidebar-link">
        <i class="bi bi-database-fill-gear"></i>
        <span>Master Data</span>
      </a>
      <ul class="submenu">
        <li class="submenu-item {{ request()->is('karyawan', 'karyawan/*') ? 'active' : '' }}">
          <a href="/karyawan" class="submenu-link">Karyawan</a>
        </li>
        <li class="submenu-item {{ request()->is('departemen', 'departemen/*') ? 'active' : '' }}">
          <a href="/departemen" class="submenu-link">Departemen</a>
        </li>
      </ul>
    </li>
    <li class="sidebar-item has-sub {{ request()->is('laporan/*') ? 'active' : '' }}">
      <a href="#" class="sidebar-link">
        <i class="bi bi-file-earmark-break-fill"></i>
        <span>Laporan</span>
      </a>
      <ul class="submenu">
        <li class="submenu-item {{ request()->is('laporan/absensi') ? 'active' : '' }}">
          <a href="/laporan/absensi" class="submenu-link">Absensi</a>
        </li>
        <li class="submenu-item {{ request()->is('') ? 'active' : '' }}">
          <a href="" class="submenu-link">Rekap Absensi</a>
        </li>
      </ul>
    </li>
  </ul>
</div>
