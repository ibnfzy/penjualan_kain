<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">

      </div>

      <div class="card-body table-responsive">
        <table id="datatable" class="table table-bordered text-nowrap">
          <thead>
            <tr>
              <th>No.</th>
              <th>Total Barang</th>
              <th>Total Harga</th>
              <th>Tanggal Checkout</th>
              <th>Batas Pembayaran</th>
              <th>Status Transaksi</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data as $item): ?>
            <tr>
              <td>
                <?= $i++; ?>
              </td>
              <td>
                <?= $item['total_produk']; ?>
              </td>
              <td>Rp.
                <?= number_format($item['total_bayar'], 0, ',', '.'); ?>
              </td>
              <td>
                <?= date('d M Y', strtotime($item['tgl_checkout'])); ?>
              </td>
              <td>
                <?= date('d M Y', strtotime($item['batas_pembayaran'])); ?>
              </td>
              <td>
                <?= $item['status_transaksi']; ?>
              </td>
              <td>

                <a href="<?= base_url('Panel/Hapus/' . $item['id_transaksi']); ?>" class="btn btn-danger">Hapus
                  Transaksi</a>

                <a href="<?= base_url('Panel/Transaksi/' . $item['id_transaksi']); ?>" class="btn btn-info">Invoice</a>

                <?php if ($item['status_transaksi'] == 'Pesanan sedang menuju lokasi pemesan'): ?>
                <a href="<?= base_url('Panel/Konfirmasi/' . $item['id_transaksi']); ?>"
                  class="btn btn-primary">Konfirmasi
                  Pesanan Diterima</a>
                <?php endif ?>

                <?php if ($item['status_transaksi'] == 'Pesanan berhasil diterima oleh pemesan'): ?>
                <a href="#" class="btn btn-primary"><i class="fas fa-star"></i> Berikan Testimoni</a>
                <?php endif ?>

              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>