<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<?php
$varian = session()->get('jumlah_varian') ?? 1;

?>

<datalist id="colors">
  <option value="#e66465">
  <option value="#ffffff">
  <option value="#000000">
  <option value="#c5c500">
  <option value="#c54100">
  <option value="#c50000">
  <option value="#729901">
  <option value="#01995b">
  <option value="#015999">
  <option value="#012f99">
  <option value="#3d0566">
  <option value="#7b0199">
</datalist>

<div class="card">
  <div class="card-header">
    <button class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
    <button class="btn btn-info" data-toggle="modal" data-target="#varian">Tambah Varian Warna</button>
  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <form action="<?= base_url('AdmPanel/Produk/Tambah'); ?>" enctype="multipart/form-data" method="POST">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" required>
              </div>

              <div class="form-group">
                <label for="">Deskripsi Produk</label>
                <textarea name="deskripsi_produk" id="textarea" cols="30" rows="10" required></textarea>
              </div>

            </div>
          </div>

          <hr style="height: 2px; background: black;">

          <div class="row">
            <?php for ($i = 0; $i < $varian; $i++): ?>
              <?php $v = $i; ?>
              <div class="col-md-6">
                <label for="">Varian Warna
                  <?= ++$v; ?>
                </label>

                <div class="form-group">
                  <label for="">Warna Produk</label> <br>
                  <div class="col-sm-2">
                    <input type="color" name="warna_produk[<?= $i; ?>]" class="form-control" id="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="">Label Nama Warna</label> <br>
                  <input type="text" name="label[<?= $i; ?>]" class="form-control">
                </div>

                <div class="form-group">
                  <label for="">Harga Produk</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" name="harga_produk[<?= $i; ?>]">
                  </div>
                </div>

                <div class="form-group">
                  <label for="">Stok Produk</label>
                  <input type="number" name="stok_produk[<?= $i; ?>]" class="form-control" id="">
                </div>

                <div class="form-group">
                  <label for="">Gambar Produk</label>
                  <input type="file" name="gambar_produk[<?= $i; ?>]" class="form-control" accept="image/*">
                </div>
                <hr style="height: 2px; background: black;">
              </div>

            <?php endfor ?>
          </div>

          <button type="submit" class="btn btn-info">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="varian" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penyerahanDesainLabel">Tambah Varian Warna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdmPanel/Produk/Tambah/Varian'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Jumlah Varian Warna</label>
            <input type="number" class="form-control" name="jumlah_varian"
              value="<?= session()->get('jumlah_varian') ?? 1; ?>" id="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>