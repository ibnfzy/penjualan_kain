<?= $this->extend('owner/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect(); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <button class="btn btn-danger" onclick="tableToPDF()"><i class="fas fa-file-pdf"></i> Download PDF</button>
      </div>

      <div class="card-body table-responsive">
        <table id="datatable" class="table table-bordered text-nowrap">
          <thead>
            <tr>
              <th>No.</th>
              <th>ID Customer</th>
              <th>Nama Customer</th>
              <th>Total Transaksi</th>
              <th>Total Produk Yang dibeli</th>
              <th>Tanggal Transaksi Terakhir</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $i = 1;
            foreach ($data as $item):
              $get = $db->table('transaksi')->where('id_customer', $item['id_customer'])->orderBy('id_transaksi', 'DESC')->get()->getResultArray();
              $total = count($get);
              $jenis = 'Pelanggan';
              $total_barang = $db->table('transaksi')->selectSum('total_produk', 'total_d')->where('id_customer', $item['id_customer'])->get()->getRowArray();

              if ($total <= 1) {
                $jenis = 'Pelanggan';
              } else if ($total <= 5) {
                $jenis = 'Pelanggan Lama';
              } else if ($total <= 10) {
                $jenis = 'Pelanggan Loyal';
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
                  <?= $item['fullname']; ?>
                </td>
                <td>
                  <?= $total; ?>
                </td>
                <td>
                  <?= $total_barang['total_d'] ?? 0; ?>
                </td>
                <td>
                  <?= $get[0]['tgl_checkout'] ?? 'Belum Ada Transaksi'; ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
  function tableToPDF() {
    const d = new Date()
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
      "Oktober",
      "November", "December"
    ];
    let month = months[d.getMonth()];
    let fulldate = d.getDate() + ' ' + month + ' ' + d.getFullYear();
    var doc = new jspdf.jsPDF();


    doc.setFontSize(17)
    doc.text('LAPORAN PELANGGAN', 110, 10, 'center');
    doc.text('PUSAT SARUNG TENUN MAMASA', 110, 15, 'center');
    doc.setFontSize(12)
    doc.text('SULAWESI BARAT', 110, 20, 'center');

    doc.autoTable({
      html: '#datatable',
      margin: {
        top: 30
      },
      autoPaging: 'text'
    })

    var finalY = doc.lastAutoTable.finalY

    doc.setFontSize(12)
    doc.text('Makassar, ' + fulldate, 140, finalY + 20)
    doc.text('Admin', 140, finalY + 35)

    doc.save('laporan_pelanggan.pdf')
  }
</script>

<?= $this->endSection(); ?>