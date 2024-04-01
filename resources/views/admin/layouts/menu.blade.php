<div class="sidebar-menu">
  <ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ request()->is('admin-dashboard') ? 'active' : '' }}">
      <a href="/admin-dashboard" class="sidebar-link">
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
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
