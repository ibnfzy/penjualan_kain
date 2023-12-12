<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect(); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah Transaksi Offline</button>
      </div>

      <div class="card-body table-responsive">
        <table id="noresponsive" class="table table-bordered text-nowrap">
          <thead>
            <tr>
              <th>No.</th>
              <th>ID Customer</th>
              <th>Nama Customer</th>
              <th>Total Barang</th>
              <th>Total Harga</th>
              <th>Tanggal Checkout</th>
              <th>Status Transaksi</th>
              <th>Hubungi Customer</th>
              <th>Hapus Transaksi</th>
              <th>Invoice</th>
            </tr>
          </thead>

          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data as $item) : ?>
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
                  <?= $item['status_transaksi']; ?>
                </td>
                <td><a href="https://wa.me/<?= $get['nomor_hp'] ?>" class="btn btn-success"><i class="fab fa-whatsapp"></i> Hubungi Customer</a></td>
                <td><a href="<?= base_url('AdmPanel/Hapus/' . $item['id_transaksi']); ?>" class="btn btn-danger">Hapus</a>
                </td>
                <td><a href="<?= base_url('AdmPanel/Transaksi/' . $item['id_transaksi'] . '/' . $item['id_customer']); ?>" class="btn btn-info">Invoice</a></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdmPanel/Transaksi/Tambah'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <select name="id_customer" id="" class="form-control">
              <?php foreach ($cust as $item) : ?>
                <option value="<?= $item['id_customer']; ?>"><?= $item['fullname']; ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Pilih</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>