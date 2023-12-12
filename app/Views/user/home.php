<?= $this->extend('user/base'); ?>
<?= $this->section('content'); ?>
<?php
$total = count($selesai);
$jenis = 'Pelanggan';

if ($total <= 1) {
  $jenis = 'Pelanggan';
} else if ($total <= 5) {
  $jenis = 'Pelanggan Lama';
} else if ($total <= 10) {
  $jenis = 'Pelanggan Loyal';
}
?>
<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box shadow">
      <span class="info-box-icon bg-info"><i class="fas fa-tag"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Transaksi Selesai</span>
        <span class="info-box-number">
          <?= count($selesai); ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box shadow">
      <span class="info-box-icon bg-success"><i class="fas fa-tag"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Transaksi Belum Selesai</span>
        <span class="info-box-number">
          <?= count($belum); ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>
<?= $this->endSection(); ?>