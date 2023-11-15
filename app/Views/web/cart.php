<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<?php
$cart = \Config\Services::cart();
$db = \Config\Database::connect();
$isShow5 = false;
$isShow7 = false;
$getOngkir = $db->table('ongkir')->where('id_ongkir', session()->get('id_ongkir'))->get()->getRowArray();
$diskon = 0;

?>

<div class="cart-page">
  <div class="container-fluid">
    <div class="col lg 12">
      <?php while (session()->get('stok_status') == 'Tidak Mencukupi'): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Ada Stok Produk tidak cukup!</strong> kuantitas produk automatis menyusuaikan stok yang ada
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <br>
        <?php session()->set('stok_status', null); ?>
      <?php endwhile; ?>

      <?php if ($cart->totalItems() < 5): ?>
        <?php
        $kurang = 5 - $cart->totalItems();
        $isShow5 = true;
        ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <strong>Info!</strong> Kuantitas produk pada keranjangmu kurang
          <?= $kurang; ?> untuk mendapatkan diskon 5%
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif ?>

      <?php if ($cart->totalItems() < 7 && $isShow5 == false): ?>
        <?php
        $kurang = 7 - $cart->totalItems();
        $isShow7 = true;
        ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <strong>Info!</strong> Kuantitas produk pada keranjangmu kurang
          <?= $kurang; ?> untuk mendapatkan diskon 10%
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif ?>

      <?php if ($cart->totalItems() < 10 && $isShow7 == false && $isShow5 == false): ?>
        <?php
        $kurang = 10 - $cart->totalItems();
        ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <strong>Info!</strong> Kuantitas produk pada keranjangmu kurang
          <?= $kurang; ?> untuk mendapatkan diskon 20%
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif ?>

      <?php if ($notice_delete): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Pemberitahuan!</strong> Kuantitas produk pada keranjangmu melebihi stok produk, dan automatis terhapus,
          silahkan tambahkan ulang produk
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif ?>

    </div>
    <form action="<?= base_url('Cart/Update'); ?>" method="post">
      <div class="row">
        <div class="col-lg-8">
          <div class="cart-page-inner">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th>Produk</th>
                    <th>Varian</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Total</th>
                    <th>Hapus</th>
                  </tr>
                </thead>
                <tbody class="align-middle">
                  <?php if ($cart->contents() == null): ?>
                    <tr>
                      <td colspan="7">Keranjang Kosong</td>
                    </tr>
                  <?php endif;
                  $total = [];
                  $i = 0; ?>

                  <?php foreach ($cart->contents() as $data): ?>
                    <input type="hidden" name="rowid[<?= $i; ?>]" value="<?= $data['rowid']; ?>">
                    <input type="hidden" name="stok[<?= $i; ?>]" value="<?= $data['stok']; ?>">
                    <input type="hidden" value="<?= $data['qty']; ?>" name="qtybutton[<?= $i ?>]">
                    <tr>
                      <td>
                        <div class="img">
                          <a href="#"><img src="<?= base_url('uploads/' . $data['gambar']); ?>" alt="Image"></a>
                          <p>
                            <a href="<?= base_url('Katalog/' . $data['id_produk']); ?>">
                              <?= $data['name']; ?>
                            </a>
                          </p>
                        </div>
                      </td>
                      <td>
                        <?= $data['label_varian'] ?? ''; ?>
                      </td>
                      <td>
                        <?= $data['stok']; ?>
                      </td>
                      <td>Rp.
                        <?= number_format($data['price'], 0, ',', '.'); ?>
                      </td>
                      <td>
                        <div class="qty">
                          <button type="button" class="btn-minus"><i class="fa fa-minus"></i></button>
                          <input type="text" value="<?= $data['qty']; ?>" name="qtybutton[<?= $i; ?>]">
                          <button type="button" class="btn-plus"><i class="fa fa-plus"></i></button>
                        </div>
                      </td>
                      <td>Rp.
                        <?php $subTotal = $data['price'] * $data['qty'];
                        echo number_format($subTotal, 0, ',', '.') ?>
                      </td>
                      <td><a href="<?= base_url('Cart/Delete/' . $data['rowid']); ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $total[] = $subTotal;
                    $i++; ?>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <?php

        $total_harga = array_sum($total);
        $total_bayar = $total_harga + $getOngkir['biaya_ongkir'];
        $total_diskon = 0;

        if ($cart->totalItems() >= 10) {
          $diskon = 20;
          $total_diskon = $total_harga * (20 / 100);
          $total_bayar = ($total_harga - $total_diskon) + $getOngkir['biaya_ongkir'];

        } else if ($cart->totalItems() >= 7) {
          $diskon = 10;
          $total_diskon = $total_harga * (10 / 100);
          $total_bayar = ($total_harga - $total_diskon) + $getOngkir['biaya_ongkir'];

        } else if ($cart->totalItems() >= 5) {
          $diskon = 5;
          $total_diskon = $total_harga * (5 / 100);
          $total_bayar = ($total_harga - $total_diskon) + $getOngkir['biaya_ongkir'];

        }

        ?>

        <div class="col-lg-4">
          <div class="cart-page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="coupon">
                  <a class="btn btn-outlined-danger p-3" href="<?= base_url('Panel/Cart/Simpan'); ?>">Simpan
                    Keranjang</a>
                </div>
              </div>
              <div class="col-md-12">
                <div class="cart-summary">
                  <div class="cart-content">
                    <h1>Detail Keranjang</h1>
                    <p>Diskon<span>
                        <?= $diskon; ?>%
                      </span></p>
                    <p>Sub Total<span>Rp
                        <?= number_format(array_sum($total), 0, ',', '.'); ?>
                      </span></p>
                    <p>Potongan<span>Rp
                        <?= number_format($total_diskon, 0, ',', '.'); ?>
                      </span></p>
                    <p>Biaya Pengiriman<span>Rp
                        <?= number_format($getOngkir['biaya_ongkir'], 0, ',', '.'); ?>
                      </span></p>
                    <h2>Grand Total<span>Rp
                        <?= number_format($total_bayar, 0, ',', '.'); ?>
                      </span></h2>
                  </div>
                  <div class="cart-btn">
                    <button type="submit">Update Keranjang</button>
                    <a class="btn btn-outlined-danger p-3" href="<?= base_url('Panel/Checkout'); ?>">Checkout</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection(); ?>