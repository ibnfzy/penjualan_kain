<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a style="background-color: orange;" href="<?= base_url('AdmPanel/'); ?>" class="brand-link">
    <i class="fas fa-home pl-2"></i>
    <span class="brand-text font-weight-bolder pl-2">Admin Panel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <i class="fas fa-user pt-2 pl-3"></i>
      <div class="info">
        <a href="#" class="pl-2">Admin</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="<?= base_url('AdmPanel/Produk'); ?>" class="nav-link">
            <i class="nav-icon fab fa-dropbox"></i>
            <p>
              Produk
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('AdmPanel/Ongkir'); ?>" class="nav-link">
            <i class="nav-icon fas fa-truck"></i>
            <p>
              Ongkos Kirim
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('AdmPanel/Corousel'); ?>" class="nav-link">
            <i class="nav-icon fas fa-images"></i>
            <p>
              Slider Foto
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('AdmPanel/Transaksi'); ?>" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Transaksi
              
              <span class="badge badge-info right">
                <?= session()->get('total_transaksi'); ?>
              </span>
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('AdmPanel/Customer'); ?>" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Customer
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('AdmPanel/LaporanTransaksi'); ?>" class="nav-link">
            <i class="nav-icon fas fa-file-code"></i>
            <p>
              Laporan Transaksi
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>