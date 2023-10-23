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
              <th>Total Bayar</th>
              <th>Tanggal Checkout</th>
              <th>Batas Pembayaran</th>
              <th>Status Transaksi</th>
              <th>Invoice</th>
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
              <td><a href="<?= base_url('Panel/Transaksi/' . $item['id_transaksi']); ?>"
                  class="btn btn-danger">Invoice</a></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>