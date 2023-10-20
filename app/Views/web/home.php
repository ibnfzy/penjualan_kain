<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect();
$home = new \App\Controllers\Home;
?>
<!-- Main Slider Start -->
<div class="header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="header-slider normal-slider">
          <div class="header-slider-item">
            <img src="<?= base_url() ?>img/slider-1.jpg" alt="Slider Image" />
          </div>
          <div class="header-slider-item">
            <img src="<?= base_url() ?>img/slider-2.jpg" alt="Slider Image" />
          </div>
          <div class="header-slider-item">
            <img src="<?= base_url() ?>img/slider-3.jpg" alt="Slider Image" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Main Slider End -->

<hr>

<!-- Call to Action Start -->
<div class="call-to-action">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h1>Selamat Datang di website Pusat Sarung Tenun Mamasa</h1>
      </div>
      <div class="col-md-6">

      </div>
    </div>
  </div>
</div>
<!-- Call to Action End -->

<!-- Featured Product Start -->
<div class="featured-product product">
  <div class="container-fluid">
    <div class="section-header">
      <h1>Rekomendasi Produk</h1>
    </div>
    <div class="row align-items-center product-slider product-slider-4">
      <?php foreach ($rekom as $item): ?>

      <?php
        $get = $db->table('produk_detail')->where('id_produk', $item['id_produk'])->orderBy('RAND()')->get(1)->getRowArray();
        $getMaxHarga = $db->table('produk_detail')->selectMax('harga_produk', 'max_harga')->where('id_produk', $item['id_produk'])->get()->getRowArray();
        $getMinHarga = $db->table('produk_detail')->selectMin('harga_produk', 'min_harga')->where('id_produk', $item['id_produk'])->get()->getRowArray();

        $join = '<span>Rp</span>' . number_format($getMinHarga['min_harga'], 0, ',', '.') . '<span>-Rp</span>' . number_format($getMaxHarga['max_harga'], 0, ',', '.');
        $harga = ($getMaxHarga['max_harga'] == $getMinHarga['min_harga']) ? '<span>Rp</span>' . number_format($getMaxHarga['max_harga'], 0, ',', '.') : $join;

        $total_star = $home->review_star($item['id_produk']);
        ?>

      <div class="col-lg-3" style="max-width: 100%;">
        <div class="product-item">
          <div class="product-title">
            <a href="<?= base_url('Katalog/' . $item['id_produk']); ?>">
              <?= $item['nama_produk']; ?>
            </a>
            <div class="ratting">
              <?= $total_star; ?>
            </div>
          </div>
          <div class="product-image">
            <a href="<?= base_url('Katalog/' . $item['id_produk']); ?>">
              <img src="<?= base_url('uploads/' . $get['gambar_produk']) ?>" alt="Product Image">
            </a>
            <div class="product-action">
              <a href="<?= base_url('Katalog/' . $item['id_produk']); ?>"><i class="fa fa-eye"></i></a>
            </div>
          </div>
          <div class="product-price">
            <h3>
              <?= $harga; ?>
            </h3>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</div>
<!-- Featured Product End -->
<?= $this->endSection(); ?>