<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>PUSAT SARUNG TENUN MAMASA - SULAWESI BARAT</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="PUSAT SARUNG TENUN MAMASA" name="keywords">
  <meta content="PUSAT SARUNG TENUN MAMASA - SULAWESI BARAT" name="description">

  <!-- Favicon -->
  <link href="<?= base_url() ?>img/favicon.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap"
    rel="stylesheet">

  <!-- CSS Libraries -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>lib/slick/slick.css" rel="stylesheet">
  <link href="<?= base_url() ?>lib/slick/slick-theme.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url() ?>/node_modules/sweetalert2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/node_modules/toastr/build/toastr.min.css">
  <!-- Template Stylesheet -->
  <link href="<?= base_url() ?>css/style.css" rel="stylesheet">
</head>

<body>
  <?php
  $db = \Config\Database::connect();
  $get = $db->table('informasi_toko')->where('id_toko', 1)->get()->getRowArray();
  ?>
  <?= $this->include('web/layouts/navbar'); ?>

  <?= $this->renderSection('content'); ?>

  <?= $this->include('web/layouts/footer'); ?>

  <div class="floating-button">
    <a href="https://wa.me/<?= $get['kontak']; ?>" target="_blank">
      <i class="fab fa-whatsapp fa-2x"></i>
      <span class="text">Hubungi Kami</span>
    </a>
  </div>

  <!-- Back to Top -->
  <a href="<?= base_url() ?>#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- JavaScript Libraries -->
  <script src="<?= base_url() ?>node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>/node_modules/toastr/build/toastr.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>lib/easing/easing.min.js"></script>
  <script src="<?= base_url() ?>lib/slick/slick.min.js"></script>

  <!-- Template Javascript -->
  <script src="<?= base_url() ?>js/main.js"></script>

  <?= $this->renderSection('script'); ?>

  <script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>

  <?php
  if (session()->getFlashdata('dataMessage')) {
    foreach (session()->getFlashdata('dataMessage') as $item) {
      echo '<script>toastr["' .
        session()->getFlashdata('type-status') . '"]("' . $item . '")</script>';
    }
  }
  if (session()->getFlashdata('message')) {
    echo '<script>toastr["' .
      session()->getFlashdata('type-status') . '"]("' . session()->getFlashdata('message') . '")</script>';
  }
  ?>
</body>

</html>