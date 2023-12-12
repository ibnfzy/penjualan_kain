<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF</title>
  <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url(''); ?>/jspdf/examples/libs/jspdf.umd.js"></script>
  <script src="<?= base_url(''); ?>/jspdf/dist/jspdf.plugin.autotable.js"></script>
</head>

<body>
  <?php
  $db = \Config\Database::connect();
  $total = [];
  $i = 1;
  ?>
  <table id="datatable">
    <thead>
      <tr>
        <th>No</th>
        <th>ID Customer</th>
        <th>Nama Customer</th>
        <th>Nama Produk</th>
        <th>Waktu</th>
        <th>Kuantitas Produk</th>
        <th>Subtotal</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php if ($data == null) : ?>
        <tr>
          <td colspan="5">DATA KOSONG</td>
        </tr>
      <?php endif ?>

      <?php foreach ($data as $item) : ?>

        <?php $cust = $db->table('customer')->where('id_customer', $item['id_customer'])->get()->getRowArray(); ?>
        <?php $total[] = $item['total_bayar'] ?>
        <?php
        $get = $db->table('transaksi_detail')->where('id_transaksi', $item['id_transaksi'])->get()->getResultArray();
        $arr = [];

        foreach ($get as $key => $value) {
          $arr[$value['nama_produk']][] = $value['label_varian'];
        }
        ?>
        <tr>
          <td>
            <?= $i++; ?>
          </td>
          <td>
            <?= $item['id_customer']; ?>
          </td>
          <td>
            <?= $cust['fullname']; ?>
          </td>
          <td>
            <?php foreach ($arr as $key => $values) : ?>
              <li><?= "$key\n" ?> (
                <?php foreach ($values as $o => $value) : ?>
                  <?= $value ?>
                  <?php if ($o != count($values) - 1) : ?>
                    ,
                  <?php endif ?>
                <?php endforeach ?> ) <br>
              </li>
            <?php endforeach ?>
          </td>
          <td>
            <?= $item['tgl_checkout']; ?>
          </td>
          <td>
            <?= $item['total_produk']; ?>
          </td>
          <td colspan="2">Rp
            <?= number_format($item['total_bayar'], 0, ',', '.'); ?>
          </td>
        </tr>

      <?php endforeach ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="6">TOTAL PENDAPATAN</th>
        <th>Rp
          <?= number_format(array_sum($total), 0, ',', '.'); ?>
        </th>
      </tr>
    </tfoot>
  </table>

  <script>
    $(document).ready(function() {
      const d = new Date()
      const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
        "Oktober",
        "November", "December"
      ];
      let month = months[d.getMonth()];
      let fulldate = d.getDate() + ' ' + month + ' ' + d.getFullYear();
      var typeDate = ('<?= $type ?>' == 'bulan') ? 'Bulan' : 'Tahun';
      var dateLaporan = '<?= $date ?>';
      var doc = new jspdf.jsPDF();


      doc.setFontSize(17)
      doc.text('LAPORAN TRANSAKSI', 110, 10, 'center');
      doc.text('PUSAT SARUNG TENUN MAMASA', 110, 15, 'center');
      doc.setFontSize(12)
      doc.text('SULAWESI BARAT', 110, 20, 'center');
      doc.text(`Berdasarkan ${typeDate} ${dateLaporan}`, 110, 26, 'center');

      doc.autoTable({
        html: '#datatable',
        margin: {
          top: 30
        },
        autoPaging: 'text',
        cellWidth: 'auto'
      })

      var finalY = doc.lastAutoTable.finalY

      doc.setFontSize(12)
      doc.text('Makassar, ' + fulldate, 140, finalY + 20)
      doc.text('Admin', 140, finalY + 35)

      var string = doc.output('datauristring', 'laporan.pdf');
      var iframe = "<iframe width='100%' height='100%' src='" + string + "'></iframe>"
      window.document.open();
      window.document.write(iframe);
      window.document.close();
    });
  </script>
</body>

</html>