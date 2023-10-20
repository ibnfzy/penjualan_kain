<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect(); ?>

<!-- Product List Start -->
<div class="product-view">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">

          <?php if ($data == null): ?>
          <div class="col-md-12" style="padding: 15px; text-align: center;">Data tidak ditemukan</div>
          <?php endif ?>

          <?php foreach ($data as $item): ?>

          <?php
            $get = $db->table('produk_detail')->where('id_produk', $item['id_produk'])->orderBy('RAND()')->get(1)->getRowArray();
            $getMaxHarga = $db->table('produk_detail')->selectMax('harga_produk', 'max_harga')->where('id_produk', $item['id_produk'])->get()->getRowArray();
            $getMinHarga = $db->table('produk_detail')->selectMin('harga_produk', 'min_harga')->where('id_produk', $item['id_produk'])->get()->getRowArray();

            $join = '<span>Rp</span>' . number_format($getMinHarga['min_harga'], 0, ',', '.') . '<span>-Rp</span>' . number_format($getMaxHarga['max_harga'], 0, ',', '.');
            $harga = ($getMaxHarga['max_harga'] == $getMinHarga['min_harga']) ? '<span>Rp</span>' . number_format($getMaxHarga['max_harga'], 0, ',', '.') : $join;
            ?>

          <div class="col-md-3">
            <div class="product-item">
              <div class="product-title">
                <a href="<?= base_url('Katalog/' . $item['id_produk']); ?>">
                  <?= $item['nama_produk']; ?>
                </a>
                <div class="ratting">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>

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

        <!-- Pagination Start -->
        <!-- <div class="col-md-12">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
              </li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav>
        </div> -->
        <!-- Pagination Start -->
      </div>
    </div>
  </div>
</div>
<!-- Product List End -->

<?= $this->endSection(); ?>