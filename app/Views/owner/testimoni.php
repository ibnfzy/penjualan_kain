<?= $this->extend('owner/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect(); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        Table Testimoni
      </div>

      <div class="card-body table-responsive">
        <table id="datatable" class="table table-bordered text-nowrap">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Customer</th>
              <th>Produk</th>
              <th>Varian Produk</th>
              <th>Bintang</th>
              <th>Lihat Produk</th>
            </tr>
          </thead>

          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data as $item): ?>
            <?php $get = $db->table('produk')->where('id_produk', $item['id_produk'])->get()->getRowArray(); ?>
            <tr>
              <td>
                <?= $i++; ?>
              </td>
              <td>
                <?= $get['nama_produk']; ?>
              </td>
              <td>
                <?= $item['varian_produk']; ?>
              </td>
              <td>
                <?php for ($i = 0; $i < $item['bintang']; $i++): ?>
                ⭐
                <?php endfor; ?>
              </td>
              <td>
                <a href="<?= base_url('Katalog/' . $item['id_produk']); ?>" class="btn btn-info"><i
                    class="fas fa-eye"></i> Lihat</a>
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