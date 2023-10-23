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
              <th>Total Produk</th>
              <th>Total Harga Produk</th>
              <th>Hapus</th>
              <th>Kelola Keranjang</th>
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
                <td>Rp
                  <?= number_format($item['total_bayar'], 0, ',', '.'); ?>
                </td>
                <td>
                  <a href="<?= base_url('Panel/Cart/Delete/' . $item['rowid']); ?>" class="btn btn-danger">Hapus
                    Keranjang</a>
                </td>
                <td>
                  <a href="<?= base_url('Panel/Cart/' . $item['rowid']); ?>" class="btn btn-primary"
                    onclick="alert('Data Keranjang ini akan diproses, dan tidak lagi disimpan')">Kelola</a>
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