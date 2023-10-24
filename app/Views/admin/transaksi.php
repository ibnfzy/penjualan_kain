<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect(); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">

      </div>

      <div class="card-body table-responsive">
        <table id="noresponsive" class="table table-bordered text-nowrap">
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
            <?php $i = 1; ?>
            <?php foreach ($data as $item): ?>
            <?php $get = $db->table('customer')->where('id_customer', $item['id_customer'])->get()->getRowArray(); ?>
            <tr>
              <td>
                <?= $i++; ?>
              </td>
              <td>
                <?= $item['id_customer']; ?>
              </td>
              <td>
                <?= $get['fullname']; ?>
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
              <td><a href="https://wa.me/<?= $get['nomor_hp'] ?>" class="btn btn-success"><i
                    class="fab fa-whatsapp"></i> Hubungi Customer</a></td>
              <td><a href="<?= base_url('AdmPanel/Transaksi/' . $item['id_transaksi'] . '/' . $item['id_customer']); ?>"
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