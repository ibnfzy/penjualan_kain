<?php
$db = \Config\Database::connect();
$ongkir = $db->table('ongkir')->get()->getResultArray();
$toko = $db->table('informasi_toko')->where('id_toko', 1)->get()->getRowArray();
?>
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

        <div class="nav-item">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#updatePassword">
            <i class="nav-icon fas fa-key"></i>
            <p>
              Ganti Password
            </p>
          </a>
        </div>

        <div class="nav-item">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#updateInformasi">
            <i class="nav-icon fas fa-truck"></i>
            <p>
              Ganti Informasi Pengiriman
            </p>
          </a>
        </div>

        <li class="nav-item bg-success">
          <a href="https://wa.me/<?= $toko['kontak']; ?>" target="_blank" rel="noreferrer" class="nav-link">
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

<div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="uploadLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="penyerahanDesainLabel">Update Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Panel/UpdatePassword'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Password Lama</label> <br>
            <div class="col-sm-12">
              <input type="password" name="old" id="" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label for="">Password Baru</label> <br>
            <div class="col-sm-12">
              <input type="password" name="new" id="" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label for="">Konfirmasi Password Baru</label> <br>
            <div class="col-sm-12">
              <input type="password" name="conf" id="" class="form-control">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-warning">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="updateInformasi" tabindex="-1" role="dialog" aria-labelledby="uploadLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="penyerahanDesainLabel">Update Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Panel/UpdateInformasi'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Kota/Kabupaten</label> <br>
            <div class="col-sm-12">
              <select name="id_ongkir" id="" class="form-control">
                <?php foreach ($ongkir as $item): ?>
                  <option <?= ($item['id_ongkir'] == session()->get('id_ongkir')) ? 'selected' : '' ?>
                    value="<?= $item['id_ongkir']; ?>">
                    <?= $item['nama_kota'] ?>
                  </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="">Kecamatan/Desa</label> <br>
            <div class="col-sm-12">
              <input type="text" name="kec_desa" id="" class="form-control" value="<?= session()->get('kec_desa'); ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="">Alamat Lengkap</label> <br>
            <div class="col-sm-12">
              <input type="text" name="alamat" id="" class="form-control" value="<?= session()->get('alamat'); ?>">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-warning">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>