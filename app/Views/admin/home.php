<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="row">
  <div class="col-lg-8">
    <!-- <div class="card">
      <div class="card-header">
        <div class="card-title">Transaksi Terbaru</div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>No.</th>
              <th>ID Customer</th>
              <th>Nama Customer</th>
              <th>Total Barang</th>
              <th>Total Bayar</th>
              <th>Tanggal Checkout</th>
              <th>Batas Pembayaran</th>
              <th>Status Transaksi</th>
              <th>Hubungi Customer</th>
              <th>Invoice</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="9">DATA KOSONG</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> -->

    <div class="card card-warning card-outline">
      <div class="card-header">
        <div class="card-title">Produk Terlaris</div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Produk</th>
              <th>Total Transaksi Pada Produk Ini</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($plaris == null): ?>
            <tr>
              <td colspan="3">DATA KOSONG</td>
            </tr>
            <?php endif ?>

            <?php $i = 1;
            foreach ($plaris as $item): ?>
            <tr>
              <td>
                <?= $i++; ?>
              </td>
              <td>
                <?= $item['nama_produk']; ?>
              </td>
              <td>
                <?= $item['total_transaksi']; ?>
              </td>
            </tr>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card card-warning">
      <div class="card-header">
        <h5 class="m-0">Informasi Toko</h5>
      </div>
      <div class="card-body">
        <h6 class="card-title">Nomor Whatsapp Toko</h6>

        <p class="card-text">

          +
          <?= $toko['kontak']; ?>

        </p>

        <h6 class="card-title">Alamat Toko</h6>

        <p class="card-text">

          <?= $toko['alamat']; ?>

        </p>
        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editInformasi">Edit</a>
      </div>
    </div>

    <div class="card card-warning">
      <div class="card-header">
        <h5 class="m-0">Tentang Toko</h5>
      </div>
      <div class="card-body">

        <p class="card-text">
          <?= $toko['tentang']; ?>
        </p>
        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editTentang">Edit</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editTentang" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="penyerahanDesainLabel">Edit Tentang Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdmPanel/UpadateTentang'); ?>" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Tentang</label> <br>
            <div class="col-sm-12">
              <textarea name="tentang" class="form-control" id="" cols="30"
                rows="10"><?= $toko['tentang']; ?></textarea>
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

<div class="modal fade" id="editInformasi" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="penyerahanDesainLabel">Edit Informasi Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdmPanel/UpadateInformasi'); ?>" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nomor Whatsapp Toko</label> <br>
            <div class="input-group col-sm-12">
              <div class="input-group-prepend">
                <span class="input-group-text">+</span>
              </div>
              <input type="text" class="form-control" name="kontak" id="kontak" value="<?= $toko['kontak']; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="">Alamat Toko</label>
            <div class="col-sm-12">
              <textarea name="alamat" class="form-control" id="" cols="30" rows="10"><?= $toko['alamat']; ?></textarea>
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

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
kontak = document.getElementById('kontak')

Inputmask('6289999999999').mask(kontak)
</script>

<?= $this->endSection(); ?>