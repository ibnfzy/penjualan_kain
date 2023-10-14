<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Transaksi Terbaru</div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Customer</th>
              <th>Total Produk</th>
              <th>Total Bayar</th>
              <th>Tanggal Checkout</th>
              <th>Invoice</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="6">DATA KOSONG</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">Produk Terlaris</div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Produk</th>
              <th>Total Transaksi Pada Produk Ini</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="3">DATA KOSONG</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">
        <h5 class="m-0">Informasi Toko</h5>
      </div>
      <div class="card-body">
        <h6 class="card-title">Nomor Whatsapp Toko</h6>

        <p class="card-text">

        </p>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editInformasi">Edit</a>
      </div>
    </div>

    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="m-0">Tentang Toko</h5>
      </div>
      <div class="card-body">

        <p class="card-text">

        </p>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editTentang">Edit</a>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>