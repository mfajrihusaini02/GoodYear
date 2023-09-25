<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="#" class="app-brand-link">
      <span class="app-brand-logo">
        <img src="logo.png" alt="" style="width: 50px;">
      </span>
      <span class="app-brand-text demo menu-text fw-bold">Goodyear</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <?php if (in_groups('Admin')) : ?>
      <!-- Dashboards -->
      <li class="menu-item">
        <a href="dashboard" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboard">Dashboard</div>
        </a>
      </li>
      <!-- Dashboards -->

      <!-- Master Data menu start -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-server"></i>
          <div data-i18n="Master Data">Master Data</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="daftar_karyawan" class="menu-link">
              <div data-i18n="Karyawan">Karyawan</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="daftar_pengguna" class="menu-link">
              <div data-i18n="Pengguna">Pengguna</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="daftar_sertifikat" class="menu-link">
              <div data-i18n="Sertifikat">Sertifikat</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="daftar_divisi" class="menu-link">
              <div data-i18n="Divisi">Divisi</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="daftar_jabatan" class="menu-link">
              <div data-i18n="Jabatan">Jabatan</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="daftar_role" class="menu-link">
              <div data-i18n="Role">Role</div>
            </a>
          </li>
        </ul>
      </li>

      <!-- Pengguna menu start -->
      <li class="menu-item">
        <a href="karyawan" class="menu-link">
          <i class="menu-icon tf-icons ti ti-user"></i>
          <div data-i18n="View Karyawan">View Karyawan</div>
        </a>
      </li>
      <!-- Pengguna menu start -->
    <?php endif ?>

    <?php if (in_groups('Manager')) : ?>
      <!-- Dashboards -->
      <li class="menu-item">
        <a href="dashboard" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboard">Dashboard</div>
        </a>
      </li>
      <!-- Dashboards -->

      <!-- Pengguna menu start -->
      <li class="menu-item">
        <a href="karyawan" class="menu-link">
          <i class="menu-icon tf-icons ti ti-user"></i>
          <div data-i18n="View Karyawan">View Karyawan</div>
        </a>
      </li>
      <!-- Pengguna menu start -->
    <?php endif ?>

    <?php if (in_groups('User')) : ?>
      <!-- Dashboards -->
      <li class="menu-item">
        <a href="dashboard" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboard">Dashboard</div>
        </a>
      </li>
      <!-- Dashboards -->
    <?php endif ?>
  </ul>
</aside>