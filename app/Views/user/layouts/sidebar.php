<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a style="background-color: orange;" href="index3.html" class="brand-link">
    <i class="fas fa-home pl-2"></i>
    <span class="brand-text font-weight-bolder pl-2">Pelanggan Panel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <i class="fas fa-user pt-2 pl-3"></i>
      <div class="info">
        <a href="#" class="pl-2">
          <?= session()->get('fullname_customer'); ?>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= base_url('Panel/Transaksi'); ?>" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Transaksi
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('Panel/Cart'); ?>" class="nav-link">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              Keranjang
              <span class="badge badge-info right">
                <?= session()->get('total_keranjang'); ?>
              </span>
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('Panel/Testimoni'); ?>" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Testimoni
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url(); ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Halaman Utama
            </p>
          </a>
        </li>

        <li class="nav-item bg-success">
          <a href="#" class="nav-link">
            <i class="nav-icon fab fa-whatsapp"></i>
            <p>
              Hubungi Toko
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>