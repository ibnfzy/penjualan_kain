<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<?php $cart = \Config\Services::cart(); ?>

<div class="cart-page">
  <div class="container-fluid">
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
                    <td colspan="6">Keranjang Kosong</td>
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
                          <a href="<?= base_url('Katalog/'.$data['id_produk']) ;?>">
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
                    <td><a href="<?= base_url('Cart/Delete//' . $data['rowid']); ?>"><i class="fa fa-trash"></i></a>
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
                    <p>Sub Total<span>Rp
                        <?= number_format(array_sum($total), 0, ',', '.'); ?>
                      </span></p>
                    <p>Biaya Pengiriman<span>Rp
                        <?= number_format(40000, 0, ',', '.'); ?>
                      </span></p>
                    <h2>Grand Total<span>Rp
                        <?= number_format(array_sum($total) + 40000, 0, ',', '.'); ?>
                      </span></h2>
                  </div>
                  <div class="cart-btn">
                    <button type="submit">Update Cart</button>
                    <a class="btn btn-outlined-danger p-3" href="">Checkout</a>
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