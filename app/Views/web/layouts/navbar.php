<!-- Nav Bar Start -->
<div class="nav">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
      <a href="<?= base_url() ?>#" class="navbar-brand">MENU</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto">
          <a href="<?= base_url() ?>" class="nav-item nav-link">Home</a>
          <a href="<?= base_url('Katalog') ?>" class="nav-item nav-link">Katalog Produk</a>
        </div>
        <div class="navbar-nav ml-auto">
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Akun</a>
            <div class="dropdown-menu">
              <a href="<?= base_url() ?>#" class="dropdown-item">Login</a>
              <a href="<?= base_url() ?>#" class="dropdown-item">Register</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</div>
<!-- Nav Bar End -->

<!-- Bottom Bar Start -->
<div class="bottom-bar">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-md-3">
        <div class="logo">
          <a href="<?= base_url() ?>">
            <h5 class="font-weight-bold text-lg-center">PUSAT SARUNG <br> TENUN MAMASA</h5>
          </a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="search">
          <form action="<?= base_url('Search'); ?>" method="POST">
            <input type="text" placeholder="Cari berdasarkan nama produk" name="search">
            <button><i class="fa fa-search"></i></button>
          </form>
        </div>
      </div>
      <div class="col-md-3">
        <div class="user">
          <a href="<?= base_url('Cart') ?>" class="btn cart">
            <i class="fa fa-shopping-cart"></i>
            <span>(0)</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Bottom Bar End -->