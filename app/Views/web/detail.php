<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<?php
$db = \Config\Database::connect();

$detailProduk = $db->table('produk_detail')->where('id_produk', $data['id_produk'])->get()->getResultArray();

$getFirst = $db->table('produk_detail')->where('id_produk', $data['id_produk'])->get()->getFirstRow('array');

$home = new \App\Controllers\Home;
$star = $home->review_star($data['id_produk']);
$total_star = $home->total_review($data['id_produk']);
$review = $home->review($data['id_produk']);
$pbagi = count($review);

?>

<!-- Product Detail Start -->
<div class="product-detail">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="col-md-9">
          <div class="product-detail-top">
            <div class="row align-items-center">
              <div class="col-md-5">
                <div class="product-slider-single normal-slider">
                  <?php foreach ($detailProduk as $item): ?>
                  <img src="<?= base_url('uploads/' . $item['gambar_produk']) ?>" alt="Product Image">
                  <?php endforeach ?>

                </div>
                <div class="product-slider-single-nav normal-slider">
                  <?php foreach ($detailProduk as $item): ?>
                  <div class="slider-nav-img"><img src="<?= base_url('uploads/' . $item['gambar_produk']) ?>"
                      alt="Product Image"></div>
                  <?php endforeach ?>

                </div>
              </div>
              <form action="<?= base_url('Cart/Add'); ?>" method="POST">
                <input type="hidden" name="id_produk_detail" id="id_produk_detail"
                  value="<?= $getFirst['id_produk_detail']; ?>">
                <div class="">
                  <div class="product-content">
                    <div class="title">
                      <h2>
                        <?= $data['nama_produk']; ?>
                      </h2>
                    </div>
                    <div class="ratting">
                      <?= $star; ?>
                      (
                      <?= $total_star; ?> )
                    </div>
                    <div class="price">
                      <h4>Price:</h4>
                      <p id="price"> Rp
                        <?= number_format($getFirst['harga_produk'], 2, ',', '.'); ?>
                      </p>
                    </div>
                    <div class="price">
                      <h4>Stok:</h4>
                      <p id="stok">
                        <?= $getFirst['stok_produk']; ?>
                      </p>
                    </div>
                    <div class="quantity">
                      <h4>Kuantitas:</h4>
                      <div class="qty">
                        <button class="btn-minus"><i class="fa fa-minus"></i></button>
                        <input type="text" value="1" name="qty">
                        <button class="btn-plus"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <!-- <div class="p-size">
                                    <h4>Size:</h4>
                                    <div class="btn-group btn-group-sm">
                                      <button type="button" class="btn">S</button>
                                      <button type="button" class="btn">M</button>
                                      <button type="button" class="btn">L</button>
                                      <button type="button" class="btn">XL</button>
                                    </div>
                                  </div> -->
                    <div class="p-color">
                      <h4>Variasi Warna:</h4>
                      <div class="btn-group btn-group-sm">
                        <?php foreach ($detailProduk as $item): ?>
                        <button type="button" class="btn warna" id="<?= $item['id_produk_detail']; ?>">
                          <div
                            style="height: 30px; width: 30px; border: 1px solid black; background-color: <?= $item['warna_produk'] ?>;">
                          </div>
                          <?= $item['label_warna_produk']; ?>
                        </button>
                        <?php endforeach ?>
                      </div>
                    </div>
                    <div class="action">
                      <button type="submit" class="btn"><i class="fa fa-shopping-cart"></i>Tambah Ke keranjang</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row product-detail-bottom">
          <div class="col-lg-12">
            <ul class="nav nav-pills nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#description">Deskripsi Produk</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#reviews">Reviews (
                  <?= $total_star; ?> )
                </a>
              </li>
            </ul>

            <div class="tab-content">

              <div id="description" class="container tab-pane active">
                <!-- <h4>Product description</h4> -->
                <?= $data['deskripsi_produk']; ?>
              </div>

              <div id="reviews" class="container tab-pane fade">

                <?php foreach ($review as $item): ?>
                <?php $getcustomer = $db->table('customer')->where('id_customer', $item['id_customer'])->get()->getRowArray(); ?>
                <div class="reviews-submitted">
                  <div class="reviewer">
                    <?= $getcustomer['fullname']; ?> - <span>
                      <?= $item['insert_datetime']; ?>
                    </span>
                  </div>
                  <div class="ratting">
                    <?php for ($i = 0; $i < $item['bintang']; $i++): ?>
                    <i class="fa fa-star"></i>
                    <?php endfor ?>
                  </div>
                  <p>
                    <?= $item['deskripsi']; ?>
                  </p>
                </div>
                <?php endforeach ?>

                <?php if ($review == null): ?>
                <div class="reviews-submitted">
                  <p>Review Kosong</p>
                </div>
                <?php endif ?>

              </div>
            </div>
          </div>
        </div>

        <div class="product">
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

              $tost = $home->review_star($item['id_produk']);
              ?>

            <div class="col-lg-3" style="max-width: 100%;">
              <div class="product-item">
                <div class="product-title">
                  <a href="<?= base_url('Katalog/' . $item['id_produk']); ?>">
                    <?= $item['nama_produk']; ?>
                  </a>
                  <div class="ratting">
                    <?= $tost; ?>
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
    </div>
  </div>
</div>
<!-- Product Detail End -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
listVarian = <?= json_encode($detailProduk); ?>;

function search(nameKey = '', myArray) {
  for (let i = 0; i < myArray.length; i++) {
    if (myArray[i].id_produk_detail === nameKey) {
      return myArray[i];
    }
  }
};

const formatter = new Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',
});

$('.btn.warna').on('click', function(param) {
  console.log(param.target.id)
  console.log(listVarian)
  $('#id_produk_detail').val(param.target.id);
  res = search(param.target.id, listVarian);

  document.getElementById('stok').innerHTML = res.stok_produk;
  document.getElementById('price').innerHTML = formatter.format(res.harga_produk);
});
</script>

<?= $this->endSection(); ?>