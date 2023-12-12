<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<?php
$total = [];
$totalKuantitasi = [];
$db = \Config\Database::connect();
$ongkir = $db->table('ongkir')->where('id_ongkir', $dataUser['id_ongkir'])->get()->getRowArray();

$diskon = 0;
?>

<div class="row">
  <div class="col-12">
    <?php if ($dataTransaksi['status_transaksi'] == 'Menunggu Bukti Pembayaran') : ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i> Info!</h5>
      Silahkan lakukan pembayaran secepat mungkin, sebelum tanggal batas pembayaran.
    </div>
    <?php endif ?>

    <?php if ($dataTransaksi['status_transaksi'] == 'Menunggu Validasi Bukti Bayar') : ?>
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i> Info!</h5>
      Silahkan menunggu admin untuk memvalidasi bukti bayar anda, silahkan menghubungi toko untuk informasi lebih
      lanjut.
    </div>
    <?php endif ?>


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
            <?= $dataTransaksi['alamat']; ?><br>
            Kota/Kabupaten - Kecamatan/Desa :
            <?= $dataTransaksi['kota_kab'] . ' - ' . $dataUser['kec_desa']; ?><br>
            Alamat Pengiriman :
            <?= $dataTransaksi['alamat']; ?><br>
            Kontak :
            <?= $dataTransaksi['nomor_hp']; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Informasi Transaksi</b><br>
          <br>
          <b>ID Transaksi :</b>
          <?= $dataTransaksi['id_transaksi']; ?><br>
          <!--
          <b>Batas Pembayaran :</b>
          <?= date('Y/m/d', strtotime($dataTransaksi['batas_pembayaran'])); ?> <br>
          -->
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
              <?php if (count($dataDetail) == 0) : ?>
              <tr>
                <td colspan="7" align="center">DATA KOSONG</td>
              </tr>
              <?php endif ?>

              <?php $i = 1;
              foreach ($dataDetail as $item) : ?>
              <?php
                $total[] = $item['subtotal'];
                $totalKuantitasi[] = $item['kuantitas_produk'];
                ?>
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

      <?php
      $total_harga = array_sum($total);
      $total_bayar = $total_harga + $ongkir['biaya_ongkir'];
      $total_diskon = 0;
      $total_produk = array_sum($totalKuantitasi);

      if ($total_produk >= 10) {
        $diskon = 20;
        $total_diskon = $total_harga * (20 / 100);
        $total_bayar = ($total_harga - $total_diskon) + $ongkir['biaya_ongkir'];
      } else if ($total_produk >= 7) {
        $diskon = 10;
        $total_diskon = $total_harga * (10 / 100);
        $total_bayar = ($total_harga - $total_diskon) + $ongkir['biaya_ongkir'];
      } else if ($total_produk >= 5) {
        $diskon = 5;
        $total_diskon = $total_harga * (5 / 100);
        $total_bayar = ($total_harga - $total_diskon) + $ongkir['biaya_ongkir'];
      }
      ?>

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
          <!-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            Silahkan menyelesaikan transaksi dengan mengirim pembayaran dengan nominal <br> Rp
            <?= number_format($total_bayar, 0, ',', '.'); ?>
            ke BANK XYZ 123456789 A/N
            Novita
          </p> -->
          <p class="text-black">
            <span class="text-bold">Pesan untuk penjual</span> <br>
            <?php if ($dataTransaksi['pesan'] == '') : ?>
            Kosong
            <?php else : ?>
            <?= $dataTransaksi['pesan']; ?>
            <?php endif ?>
          </p>
        </div>
        <!-- /.col -->
        <div class="col-6">
          <p class="lead">Detail Transaksi</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Diskon:</th>
                <td>
                  <?= $diskon; ?> %
                </td>
              </tr>
              <tr>
                <th>Subtotal Harga:</th>
                <td>Rp
                  <?= number_format(array_sum($total), 0, ',', '.'); ?>
                </td>
              </tr>
              <tr>
                <th>Total Potongan Diskon:</th>
                <td>Rp
                  <?= number_format($total_diskon, 0, ',', '.'); ?>
                </td>
              </tr>
              <tr>
                <th>Total Harga:</th>
                <td>Rp
                  <?= number_format(array_sum($total) - $total_diskon, 0, ',', '.'); ?>
                </td>
              </tr>
              <tr>
                <th>Biaya Ongkir:</th>
                <td>Rp
                  <?= number_format($ongkir['biaya_ongkir'], 0, ',', '.'); ?>
                </td>
              </tr>
              <tr>
                <th>Total Bayar:</th>
                <td>Rp
                  <?= number_format($total_bayar, 0, ',', '.'); ?>
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

          <?php if ($dataTransaksi['bukti_bayar'] != null) : ?>
          <button data-toggle="modal" data-target="#upload" type="button" class="btn btn-success float-right"><i
              class="fas fa-eye"></i> Lihat Bukti Bayar
          </button>
          <?php endif ?>

          <?php if ($dataTransaksi['status_transaksi'] == 'Pesanan sedang diproses') : ?>
          <a href="<?= base_url('AdmPanel/Kirim/' . $dataTransaksi['id_transaksi']); ?>"
            class="btn btn-success float-right mr-2"><i class="fas fa-truck-pickup"></i> Kirim Pesanan</a>
          <?php endif ?>

          <?php if ($dataTransaksi['status_transaksi'] == 'Transaksi Offline') : ?>
          <?php if (count($dataDetail) != 0) : ?>
          <a href="<?= base_url('AdmPanel/Selesai/' . $dataTransaksi['id_transaksi']); ?>"
            class="btn btn-success float-right mr-2"><i class="fas fa-truck-pickup"></i> Selesaikan Pesanan</a>
          <?php endif ?>

          <button data-toggle="modal" data-target="#add" type="button" class="btn btn-success float-right mr-2">Tambah
            Produk
          </button>
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

        <?php if ($dataTransaksi['status_transaksi'] == 'Menunggu Validasi Bukti Bayar') : ?>
        <a href="<?= base_url('AdmPanel/Hapus/' . $item['id_transaksi']); ?>" class="btn btn-danger">Batalkan
          Transaksi</a>
        <a href="<?= base_url('AdmPanel/Validasi/' . $item['id_transaksi']); ?>" class="btn btn-primary">Validasi Bukti
          Bayar Ini</a>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form
        action="<?= base_url('AdmPanel/Transaksi/TambahProduk/' . $dataTransaksi['id_transaksi'] . '/' . $dataUser['id_customer']); ?>"
        method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Produk</label>
            <select name="id_produk_detail" id="" class="form-control">
              <?php foreach ($produk as $item) : ?>
              <?php $get = $db->table('produk')->where('id_produk', $item['id_produk'])->get()->getRowArray(); ?>
              <option value="<?= $item['id_produk_detail']; ?>">
                <?= $get['nama_produk'] . '/' . $item['label_warna_produk'] .
                    ' | Rp' . number_format($item['harga_produk'], 0, ',', '.') ?>
              </option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Kuantitas</label>
            <input type="number" name="qty" class="form-control" id="" value="1">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          <button class="btn btn-success" type="submit">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>