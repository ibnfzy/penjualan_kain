<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-header">
    <button class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <form action="<?= base_url('AdmPanel/Produk/' . $id); ?>" enctype="multipart/form-data" method="POST">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" value="<?= $data['nama_produk']; ?>"
                  required>
              </div>

              <div class="form-group">
                <label for="">Deskripsi Produk</label>
                <textarea name="deskripsi_produk" id="textarea" cols="30" rows="10"
                  required><?= $data['deskripsi_produk']; ?></textarea>
              </div>

            </div>
          </div>

          <hr style="height: 2px; background: black;">

          <div class="row">
            <?php $i = 0; ?>
            <?php foreach ($detail as $item): ?>
            <?php $v = $i; ?>
            <div class="col-md-6">
              <label for="">Varian Warna
                <?= ++$v; ?>
              </label>

              <input type="hidden" name="id_detail[<?= $i; ?>]" value="<?= $item['id_produk_detail']; ?>">

              <div class="form-group">
                <label for="">Warna Produk</label> <br>
                <div class="col-sm-2">
                  <input type="color" name="warna_produk[<?= $i; ?>]" class="form-control" id=""
                    value="<?= $item['warna_produk']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="">Label Nama Warna</label> <br>
                <input type="text" name="label[<?= $i; ?>]" class="form-control"
                  value="<?= $item['label_warna_produk']; ?>">
              </div>

              <div class="form-group">
                <label for="">Harga Produk</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="number" class="form-control" name="harga_produk[<?= $i; ?>]"
                    value="<?= $item['harga_produk']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="">Stok Produk</label>
                <input type="number" name="stok_produk[<?= $i; ?>]" class="form-control" id=""
                  value="<?= $item['stok_produk']; ?>">
              </div>

              <div class="form-group">
                <label for="">Gambar Produk</label>
                <input type="file" name="gambar_produk[<?= $i; ?>]" class="form-control" accept="image/*">
              </div>
              <hr style="height: 2px; background: black;">
            </div>
            <?php $i++; ?>
            <?php endforeach ?>
          </div>

          <button type="submit" class="btn btn-info">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>