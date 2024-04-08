<div class="sidebar-menu">
  <ul class="menu">
    <li class="sidebar-item {{ request()->is('panel/dashboard') ? 'active' : '' }}">
      <a href="/panel/dashboard" class="sidebar-link">
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="sidebar-title">Data Master</li>

    <li class="sidebar-item {{ request()->is('karyawan', 'karyawan/create') ? 'active' : '' }}">
      <a href="/karyawan" class="sidebar-link">
        <i class="bi bi-file-earmark-person-fill"></i>
        <span>Master Karyawan</span>
      </a>
    </li>

    <li class="sidebar-item has-sub">
      <a href="#" class="sidebar-link">
        <i class="bi bi-stack"></i>
        <span>Components</span>
      </a>

      <ul class="submenu">
        <li class="submenu-item">
          <a href="component-accordion.html" class="submenu-link">Accordion</a>
        </li>
      </ul>
    </li>
  </ul>
</div>
