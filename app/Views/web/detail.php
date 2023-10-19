<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<?php
$db = \Config\Database::connect();

$get = $db->table('produk_detail')->where('id_produk', $data['id_produk'])->get()->getResultArray();

$getFirst = $db->table('produk_detail')->where('id_produk', $data['id_produk'])->get()->getFirstRow('array');

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
                  <?php foreach ($get as $item): ?>
                    <img src="<?= base_url('uploads/' . $item['gambar_produk']) ?>" alt="Product Image">
                  <?php endforeach ?>

                </div>
                <div class="product-slider-single-nav normal-slider">
                  <?php foreach ($get as $item): ?>
                    <div class="slider-nav-img"><img src="<?= base_url('uploads/' . $item['gambar_produk']) ?>"
                        alt="Product Image"></div>
                  <?php endforeach ?>

                </div>
              </div>
              <form action="" method="POST">
                <input type="hidden" name="id_detail">
                <div class="">
                  <div class="product-content">
                    <div class="title">
                      <h2>
                        <?= $data['nama_produk']; ?>
                      </h2>
                    </div>
                    <div class="ratting">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
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
                        <?php foreach ($get as $item): ?>
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
                <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#reviews">Reviews (1)</a>
              </li>
            </ul>

            <div class="tab-content">
              <div id="description" class="container tab-pane active">
                <h4>Product description</h4>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In
                  efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus. Nulla tristique
                  viverra nisl, sit amet bibendum ante suscipit non. Praesent in faucibus tellus, sed gravida lacus.
                  Vivamus eu diam eros. Aliquam et sapien eget arcu rhoncus scelerisque. Suspendisse sit amet neque
                  neque. Praesent suscipit et magna eu iaculis. Donec arcu libero, commodo ac est a, malesuada finibus
                  dolor. Aenean in ex eu velit semper fermentum. In leo dui, aliquet sit amet eleifend sit amet, varius
                  in turpis. Maecenas fermentum ut ligula at consectetur. Nullam et tortor leo.
                </p>
              </div>
              <div id="reviews" class="container tab-pane fade">
                <div class="reviews-submitted">
                  <div class="reviewer">Phasellus Gravida - <span>01 Jan 2020</span></div>
                  <div class="ratting">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                  <p>
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                    totam rem aperiam.
                  </p>
                </div>
                <div class="reviews-submit">
                  <h4>Give your Review:</h4>
                  <div class="ratting">
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                  </div>
                  <div class="row form">
                    <div class="col-sm-6">
                      <input type="text" placeholder="Name">
                    </div>
                    <div class="col-sm-6">
                      <input type="email" placeholder="Email">
                    </div>
                    <div class="col-sm-12">
                      <textarea placeholder="Review"></textarea>
                    </div>
                    <div class="col-sm-12">
                      <button>Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="product">
          <div class="section-header">
            <h1>Rekomendasi Produk</h1>
          </div>

          <div class="row align-items-center product-slider product-slider-4">
            <div class="col-lg-3">
              <div class="product-item">
                <div class="product-title">
                  <a href="#">Product Name</a>
                  <div class="ratting">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                </div>
                <div class="product-image">
                  <a href="product-detail.html">
                    <img src="<?= base_url('') ?>img/product-10.jpg" alt="Product Image">
                  </a>
                  <div class="product-action">
                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                    <a href="#"><i class="fa fa-heart"></i></a>
                    <a href="#"><i class="fa fa-search"></i></a>
                  </div>
                </div>
                <div class="product-price">
                  <h3><span>$</span>99</h3>
                  <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="product-item">
                <div class="product-title">
                  <a href="#">Product Name</a>
                  <div class="ratting">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                </div>
                <div class="product-image">
                  <a href="product-detail.html">
                    <img src="<?= base_url('') ?>img/product-8.jpg" alt="Product Image">
                  </a>
                  <div class="product-action">
                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                    <a href="#"><i class="fa fa-heart"></i></a>
                    <a href="#"><i class="fa fa-search"></i></a>
                  </div>
                </div>
                <div class="product-price">
                  <h3><span>$</span>99</h3>
                  <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="product-item">
                <div class="product-title">
                  <a href="#">Product Name</a>
                  <div class="ratting">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                </div>
                <div class="product-image">
                  <a href="product-detail.html">
                    <img src="<?= base_url('') ?>img/product-6.jpg" alt="Product Image">
                  </a>
                  <div class="product-action">
                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                    <a href="#"><i class="fa fa-heart"></i></a>
                    <a href="#"><i class="fa fa-search"></i></a>
                  </div>
                </div>
                <div class="product-price">
                  <h3><span>$</span>99</h3>
                  <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="product-item">
                <div class="product-title">
                  <a href="#">Product Name</a>
                  <div class="ratting">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                </div>
                <div class="product-image">
                  <a href="product-detail.html">
                    <img src="<?= base_url('') ?>img/product-4.jpg" alt="Product Image">
                  </a>
                  <div class="product-action">
                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                    <a href="#"><i class="fa fa-heart"></i></a>
                    <a href="#"><i class="fa fa-search"></i></a>
                  </div>
                </div>
                <div class="product-price">
                  <h3><span>$</span>99</h3>
                  <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="product-item">
                <div class="product-title">
                  <a href="#">Product Name</a>
                  <div class="ratting">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                </div>
                <div class="product-image">
                  <a href="product-detail.html">
                    <img src="<?= base_url('') ?>img/product-2.jpg" alt="Product Image">
                  </a>
                  <div class="product-action">
                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                    <a href="#"><i class="fa fa-heart"></i></a>
                    <a href="#"><i class="fa fa-search"></i></a>
                  </div>
                </div>
                <div class="product-price">
                  <h3><span>$</span>99</h3>
                  <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                </div>
              </div>
            </div>
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
  listVarian = <?= json_encode($get); ?>;

  function search(nameKey = '', myArray) {
    for (let i = 0; i < myArray.length; i++) {
      if (myArray[i].id_produk_detail === nameKey) {
        return myArray[i];
      }
    }
  }

  const formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
  });

  $('.btn.warna').on('click', function (param) {
    // console.log(param.target.id)
    // console.log(listVarian)
    res = search(param.target.id, listVarian);

    document.getElementById('stok').innerHTML = res.stok_produk;
    document.getElementById('price').innerHTML = formatter.format(res.harga_produk);
  });
</script>

<?= $this->endSection(); ?>