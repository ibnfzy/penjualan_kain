<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
      </div>

      <div class="card-body table-responsive">
        <div class="row">
          <div class="col-md-2">
            <form action="<?= base_url('AdmPanel/LaporanTransaksi/render'); ?>" method="post">

              <div class="form-group">
                <label for="">Tampilkan Berdasarkan</label>
                <select class="form-control" name="views-control" id="views-control">
                  <option value="bulan">Bulan</option>
                  <option value="tahun">Tahun</option>
                </select>
              </div>

              <div id="bulan" class="form-group">
                <label for="">Pilih Bulan</label>
                <input type="month" name="bulan" class="form-control">
              </div>

              <div id="tahun" class="form-group">
                <label for="">Pilih Tahun</label>
                <select name="tahun" class="form-control">
                  <?php if ($data == null): ?>
                    <option value="2023">2023</option>
                  <?php endif ?>
                  <?php foreach ($data as $item): ?>
                    <option value="<?= $item['tahun']; ?>">
                      <?= $item['tahun']; ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>

              <button type="submit" class="btn btn-primary">Tampilkan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $('#tahun').attr('hidden', '')
  $('#bulan').removeAttr('hidden')

  $('#views-control').change(function (e) {
    e.preventDefault();
    const views_control = $('#views-control').val();

    switch (views_control) {
      case 'bulan':
        $('#tahun').attr('hidden', '')
        $('#bulan').removeAttr('hidden')
        break;

      case 'tahun':
        $('#bulan').attr('hidden', '')
        $('#tahun').removeAttr('hidden')
        break;

      default:
        $('#tahun').attr('hidden', '')
        $('#bulan').removeAttr('hidden')
        break;
    }

  });
</script>
<?= $this->endSection(); ?>