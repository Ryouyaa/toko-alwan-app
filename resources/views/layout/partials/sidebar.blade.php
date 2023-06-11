<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/">
        <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item nav-category p-0">Barang</li>
    <li class="nav-item">
      <a class="nav-link" href="/daftar-barang">
        <i class="menu-icon mdi mdi-view-grid"></i>
        <span class="menu-title">Daftar Barang</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/tambah-barang">
        <i class="menu-icon mdi mdi-view-grid-plus"></i>
        <span class="menu-title">Tambah Barang</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic">
        <i class="menu-icon mdi mdi-alert-box"></i>
        <span class="menu-title">Barang Hilang</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/barang-hilang">Daftar Barang Hilang</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Tambah Barang Hilang</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item nav-category p-0">Update Stok</li>
    <li class="nav-item">
      <a class="nav-link" href="/barang-masuk">
        <i class="menu-icon mdi mdi-inbox-arrow-down"></i>
        <span class="menu-title">Barang Masuk</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/barang-keluar">
        <i class="menu-icon mdi mdi-inbox-arrow-up"></i>
        <span class="menu-title">Barang Keluar</span>
      </a>
    </li>
    <li class="nav-item nav-category p-0">Laporan</li>
    <li class="nav-item">
      <a class="nav-link" href="#auth">
        <i class="menu-icon mdi mdi-file-chart"></i>
        <span class="menu-title">Cetak Lap. Keuangan</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#ui-basic">
        <i class="menu-icon mdi mdi-account-box"></i>
        <span class="menu-title">Laporan Karyawan</span>
      </a>
    </li>
    <li class="nav-item nav-category p-0">Admin</li>
    <li class="nav-item">
      <a class="nav-link" href="/profil">
        <i class="menu-icon mdi mdi-account-circle-outline"></i>
        <span class="menu-title">Profil Admin</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/ubah-sandi">
        <i class="menu-icon mdi  mdi-account-key mdi-textbox-password"></i>
        <span class="menu-title">Ubah Sandi</span>
      </a>
    </li>
  </ul>
</nav>