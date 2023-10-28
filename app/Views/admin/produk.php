<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect();
$i = 1;
?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <a href="<?= base_url('AdmPanel/Produk/Tambah'); ?>" class="btn" style="background-color: orange;">Tambah
          Data</a>
      </div>

      <div class="card-body table-responsive">
        <table id="datatable" class="table table-bordered text-nowrap">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Produk</th>
              <th>Varian Warna</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $item): ?>
            <?php $get = $db->table('produk_detail')->where('id_produk', $item['id_produk'])->get()->getResultArray(); ?>
            <tr>
              <td>
                <?= $i++; ?>
              </td>
              <td>
                <?= $item['nama_produk']; ?>
              </td>
              <td>
                <div class="row">
                  <?php foreach ($get as $node): ?>
                  <div title="<?= $node['label_warna_produk']; ?>"
                    style="height: 30px; width: 30px; border: 1px solid black; background-color: <?= $node['warna_produk'] ?>;">
                  </div>
                  <?php endforeach ?>
                </div>
              </td>
              <td>
                <button class="btn btn-info" onclick="modalVarian('<?= $item['id_produk']; ?>')">Tambah Varian</button>
                <button class="btn" style="background: orange;" onclick="modalShow('<?= $item['id_produk']; ?>')">Detail
                  Produk</button>
                <a href="<?= base_url('AdmPanel/Produk/' . $item['id_produk']); ?>" class="btn btn-primary">Edit</a>
                <a href="<?= base_url('AdmPanel/Produk/Hapus/' . $item['id_produk']); ?>"
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

<div class="modal fade" id="varian" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penyerahanDesainLabel">Detail Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdmPanel/Produk/Single'); ?>" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <input type="hidden" name="id_produk" id="id_produk">

          <div class="form-group">
            <label for="">Warna Produk</label> <br>
            <div class="col-sm-2">
              <input type="color" name="warna_produk" class="form-control" id="">
            </div>
          </div>

          <div class="form-group">
            <label for="">Label Nama Warna</label> <br>
            <input type="text" name="label" class="form-control">
          </div>

          <div class="form-group">
            <label for="">Harga Produk</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp</span>
              </div>
              <input type="number" class="form-control" name="harga_produk">
            </div>
          </div>

          <div class="form-group">
            <label for="">Stok Produk</label>
            <input type="number" name="stok_produk" class="form-control" id="">
          </div>

          <div class="form-group">
            <label for="">Gambar Produk</label>
            <input type="file" name="gambar_produk" class="form-control" accept="image/*">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button class="btn btn-warning" type="submit">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penyerahanDesainLabel">Detail Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered text-nowrap">
          <thead>
            <tr>
              <th>Warna</th>
              <th>Gambar</th>
              <th>Harga</th>
              <th>Stok</th>
            </tr>
          </thead>

          <tbody id="tbody">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
function modalVarian(id = '') {

  $('#id_produk').val(id)
  $('#varian').modal('toggle')
}

function modalShow(id = '') {

  const xmlhttp = new XMLHttpRequest();

  xmlhttp.onload = function() {
    let text = ""
    resObj = JSON.parse(this.responseText);

    const formatter = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
    });

    for (let i in resObj) {
      warna = resObj[i].warna_produk
      label = resObj[i].label_warna_produk
      gambar = '<?= base_url('uploads/') ?>' + resObj[i].gambar_produk
      dharga = resObj[i].harga_produk
      harga = formatter.format(dharga)
      stok = resObj[i].stok_produk

      text += `
      <tr>
        <td>
           <div style="height: 30px; width: 30px; border: 1px solid black; background-color: ${warna};">
           </div> ${label}
        </td>
        <td><img src="${gambar}" alt="" width="100"></td>
        <td>${harga}</td>
        <td>${stok}</td>
      </tr>
      `
    }

    document.getElementById("tbody").innerHTML = text;
    $('#detail').modal('toggle')
  }

  xmlhttp.open("GET", "<?= base_url('AdmPanel/Produk/Detail/'); ?>" + id);
  xmlhttp.send();
}
</script>

<?= $this->endSection(); ?>