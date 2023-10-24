<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect(); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <button class="btn" style="background-color: orange;" data-toggle="modal" data-target="#add">Tambah
          Review</button>
      </div>

      <div class="card-body table-responsive">
        <table id="datatable" class="table table-bordered text-nowrap">
          <thead>
            <tr>
              <th>No.</th>
              <th>Produk</th>
              <th>Varian Produk</th>
              <th>Bintang</th>
              <th>Edit</th>
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
                <td><button
                    onclick="modalShow('<?= base_url('Panel/Testimoni/' . $item['id_review']) ?>', '<?= $item['id_transaksi_detail']; ?>', '<?= $item['bintang']; ?>', '<?= $item['deskripsi']; ?>')"
                    class="btn btn-primary">Edit</button>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penyerahanDesainLabel">Tambah Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Panel/Testimoni'); ?>" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Pilih Transaksi Produk</label> <br>
            <select name="id_transaksi_detail" id="id_transaksi_detail" class="form-control" required>
              <?php if ($opt == null): ?>
                <option value="" disabled>DATA KOSONG</option>
              <?php endif ?>

              <?php foreach ($opt as $item): ?>
                <option value="<?= $item['id_transaksi_detail']; ?>">
                  <?= $item['nama_produk'] . ' / ' . $item['varian']; ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Beri Bintang</label> <br>
            <select name="bintang" id="bintang" class="form-control" required>
              <option value="1">⭐</option>
              <option value="2">⭐⭐</option>
              <option value="3">⭐⭐⭐</option>
              <option value="4">⭐⭐⭐⭐</option>
              <option value="5">⭐⭐⭐⭐⭐</option>
            </select>
          </div>

          <div class="form-group">
            <label for="">Deskripsi</label> <br>
            <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-warning">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penyerahanDesainLabel">Edit Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editForm" action="#" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Pilih Transaksi Produk</label> <br>
            <select name="id_transaksi_detail" id="idDetail" class="form-control" required>
              <?php if ($data == null): ?>
                <option value="" disabled>DATA KOSONG</option>
              <?php endif ?>

              <?php foreach ($data as $item): ?>
                <?php $get = $db->table('produk')->where('id_produk', $item['id_produk'])->get()->getRowArray(); ?>
                <option value="<?= $item['id_transaksi_detail']; ?>">
                  <?= $get['nama_produk'] . ' / ' . $item['varian_produk']; ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Beri Bintang</label> <br>
            <select name="bintang" id="bintangEdit" class="form-control" required>
              <option value="1">⭐</option>
              <option value="2">⭐⭐</option>
              <option value="3">⭐⭐⭐</option>
              <option value="4">⭐⭐⭐⭐</option>
              <option value="5">⭐⭐⭐⭐⭐</option>
            </select>
          </div>

          <div class="form-group">
            <label for="">Deskripsi</label> <br>
            <textarea class="form-control" name="deskripsi" id="deskrispiEdit" cols="30" rows="10" required></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-warning">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
  function modalShow(urlaction, id_transaksi_detail, bintang, deskripsi) {
    $(`#idDetail option[value="${id_transaksi_detail}"]`).prop('selected', true)
    $(`#bintangEdit option[value="${bintang}"]`).prop('selected', true)
    $('#deskrispiEdit').val(deskripsi)
    $('#editForm').attr('action', urlaction)
    $('#edit').modal('toggle')
  }
</script>

<?= $this->endSection(); ?>