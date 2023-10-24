<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<?php
$total = [];
?>

<div class="row">
  <div class="col-12">

    <!-- Main content -->
    <div class="invoice p-3 mb-3">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h4>
            <i class="fas fa-globe"></i> HALAMAN INVOICE / DETAIL TRANSAKSI.
            <small class="float-right">Tanggal Checkout:
              <?= date('Y/m/d', strtotime($dataTransaksi['tgl_checkout'])) ?>
            </small>
          </h4>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dikirim dari
          <address>
            <strong>PUSAT SARUNG TENUN MAMASA </strong><br>
            SULAWESI BARAT<br>
            <?= $dataToko['alamat']; ?><br>
            Kontak :
            <?= $dataToko['kontak']; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Informasi Penerima
          <address>
            <strong>
              <?= $dataUser['fullname']; ?>
            </strong><br>
            Alamat Lengkap :
            <?= $dataUser['alamat']; ?><br>
            Kota/Kabupaten :
            <?= $dataUser['kota_kab']; ?><br>
            Kecamatan/Desa :
            <?= $dataUser['kec_desa']; ?><br>
            Kontak :
            <?= $dataUser['nomor_hp']; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Informasi Transaksi</b><br>
          <br>
          <b>ID Transaksi :</b>
          <?= $dataTransaksi['id_transaksi']; ?><br>
          <b>Batas Pembayaran :</b>
          <?= date('Y/m/d', strtotime($dataTransaksi['batas_pembayaran'])); ?> <br>
          <b>Status Transaksi : </b>
          <?= $dataTransaksi['status_transaksi']; ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>ID PRODUK</th>
                <th>NAMA PRODUK</th>
                <th>VARIAN PRODUK</th>
                <th>KUANTITAS</th>
                <th>HARGA PRODUK</th>
                <th>SUBTOTAL</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($dataDetail as $item): ?>
              <?php $total[] = $item['subtotal']; ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= $item['id_produk']; ?>
                </td>
                <td>
                  <?= $item['nama_produk']; ?>
                </td>
                <td>
                  <?= $item['label_varian']; ?>
                </td>
                <td>
                  <?= $item['kuantitas_produk']; ?>
                </td>
                <td>Rp
                  <?= number_format($item['harga_produk'], 0, ',', '.'); ?>
                </td>
                <td>Rp
                  <?= number_format($item['subtotal'], 0, ',', '.') ?>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
          <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            Silahkan menyelesaikan transaksi dengan mengirim pembayaran dengan nominal <br> Rp
            <?= $total_bayar = number_format(array_sum($total) + 40000, 0, ',', '.'); ?>
            ke BANK XYZ 123456789 A/N
            Novita
          </p>
        </div>
        <!-- /.col -->
        <div class="col-6">
          <p class="lead">Detail Transaksi</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total Harga:</th>
                <td>Rp
                  <?= number_format(array_sum($total), 0, ',', '.'); ?>
                </td>
              </tr>
              <tr>
                <th>Biaya Ongkir:</th>
                <td>Rp
                  <?= number_format(40000, 0, ',', '.'); ?>
                </td>
              </tr>
              <tr>
                <th>Total Bayar:</th>
                <td>Rp
                  <?= $total_bayar; ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-12">
          <a href="#" onclick="window.print()" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

          <?php if ($dataTransaksi['bukti_bayar'] != null): ?>
          <button data-toggle="modal" data-target="#upload" type="button" class="btn btn-success float-right"><i
              class="fas fa-eye"></i> Lihat Bukti Bayar
          </button>
          <?php endif ?>

          <?php if ($dataTransaksi['status_transaksi'] == 'Pesanan sedang diproses'): ?>
          <a href="<?= base_url('AdmPanel/Kirim/'.$dataTransaksi['id_transaksi']) ;?>"
            class="btn btn-success float-right mr-2"><i class="fas fa-truck-pickup"></i> Kirim Pesanan</a>
          <?php endif ?>
        </div>
      </div>
    </div>
    <!-- /.invoice -->
  </div><!-- /.col -->
</div>

<!-- Modal -->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalLabel">Bukti Bayar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="img-fluid" src="<?= base_url('uploads/' . $dataTransaksi['bukti_bayar']); ?>" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <?php if ($dataTransaksi['status_transaksi'] == 'Menunggu Validasi Bukti Bayar'): ?>
        <a href="<?= base_url('AdmPanel/Validasi/' . $item['id_transaksi']); ?>" class="btn btn-primary">Validasi Bukti
          Bayar Ini</a>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>