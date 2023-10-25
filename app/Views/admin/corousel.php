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
              <th>Gambar</th>
              <th>Hapus</th>
            </tr>
          </thead>

          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data as $item): ?>
            <tr>
              <td>
                <?= $i++; ?>
              </td>
              <td><img src="<?= base_url('uploads/' . $item['gambar']); ?>" alt="" width="100"></td>
              <td><a href="<?= base_url('AdmPanel/Corousel/' . $item['id_corousel']); ?>"
                  class="btn btn-danger">Hapus</a>
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
        <h5 class="modal-title" id="penyerahanDesainLabel">Tambah Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdmPanel/Corousel'); ?>" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Gambar</label> <br>
            <div class="col-sm-2">
              <input type="file" name="gambar" class="form-control" id="" accept="image/*">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>