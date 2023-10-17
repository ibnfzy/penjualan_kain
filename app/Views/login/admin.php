<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('') ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page bg-gradient-orange">
  <div class="login-box">
    <div class="login-logo">
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-header bg-gradient-gray">
        <h4>HALAMAN LOGIN ADMIN</h4>

      </div>
      <div class="card-body login-card-body">
        <!-- <p class="login-box-msg">Sign in to start your session</p> -->

        <form action="<?= base_url('Adm/Login') ;?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <a href="<?= base_url(); ?>" class="btn btn-secondary">Kembali ke halaman utama</a>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn bg-gradient-orange btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('') ?>dist/js/adminlte.min.js"></script>
</body>

</html>