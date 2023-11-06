<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <button class="btn" style="background-color: orange;" data-toggle="modal" data-target="#add">Tambah
          Data</button>
      </div>

      <div class="card-body table-responsive">
        <table id="datatable" class="table table-bordered text-nowrap">
          <thead>
            <tr>
              <th>No.</th>
              <th>Kota/Kabupaten</th>
              <th>Biaya Ongkir</th>
              <th>AKSI</th>
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
                <?= $item['nama_kota']; ?>
              </td>
              <td>Rp
                <?= number_format($item['biaya_ongkir'], 0, ',', '.'); ?>
              </td>
              <td>
                <button class="btn btn-info"
                  onclick="editModal('<?= $item['id_ongkir']; ?>', '<?= $item['nama_kota']; ?>', '<?= $item['biaya_ongkir']; ?>')">Edit</button>
                <a href="<?= base_url('AdmPanel/Ongkir/' . $item['id_ongkir']); ?>" class="btn btn-danger">Hapus</a>
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
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="penyerahanDesainLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdmPanel/Ongkir'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Kota / Kabupaten</label> <br>
            <div class="col-sm-12">
              <input type="text" name="nama_kota" class="form-control" id="">
            </div>
          </div>

          <div class="form-group">
            <label for="">Biaya Ongkir</label> <br>
            <div class="col-sm-12">
              <input type="number" name="biaya_ongkir" class="form-control" id="" value="0">
            </div>
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
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="penyerahanDesainLabel">Ubah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdmPanel/Ongkir/Edit'); ?>" method="post">
        <input type="hidden" name="id_ongkir" id="id_ongkir">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Kota / Kabupaten</label> <br>
            <div class="col-sm-12">
              <input type="text" name="nama_kota" class="form-control" id="nama_kota">
            </div>
          </div>

          <div class="form-group">
            <label for="">Biaya Ongkir</label> <br>
            <div class="col-sm-12">
              <input type="number" name="biaya_ongkir" class="form-control" id="biaya_ongkir">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-warning">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
function editModal(id, nama_kota, biaya_ongkir) {
  $('#id_ongkir').val(id)
  $('#nama_kota').val(nama_kota)
  $('#biaya_ongkir').val(biaya_ongkir)
  $('#edit').modal('toggle')
}
</script>

<?= $this->endSection(); ?>