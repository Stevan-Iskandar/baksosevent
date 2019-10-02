<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $menu_; ?></h1>

  <div class="row">
    <div class="col-lg">
      <?= form_open_multipart("admin/editevent/" . $dataEventEdit["id"]); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group row">
              <div class="col-sm-3">
                <img src="<?= base_url("assets/img/event/") . $dataEventEdit["image"]; ?>" class="img-thumbnail">
              </div>
              <div class="col-sm-9">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                  <label for="image" class="custom-file-label">Choose file</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="text-gray-900">Nama Kegiatan</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value("nama", $dataEventEdit["nama"]); ?>">
              <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label class="text-gray-900">Lokasi Kegiatan</label>
              <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= set_value("lokasi", $dataEventEdit["lokasi"]); ?>">
              <?= form_error('lokasi', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label class="text-gray-900">Tanggal Kegiatan</label>
              <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= set_value("tanggal", $dataEventEdit["tanggal"]); ?>">
              <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label class="text-gray-900">Jam Pelaksanaan</label>
              <input type="text" class="form-control" id="waktu" name="waktu" value="<?= set_value("waktu", $dataEventEdit["waktu"]); ?>">
              <?= form_error('waktu', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="summernote" class="text-gray-900">Deskripsi :</label>
              <textarea id="summernote" id="deskripsi" name="deskripsi"><?= set_value("deskripsi", $dataEventEdit["deskripsi"]); ?></textarea>
              <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label class="text-gray-900">Data donasi</label>
              <input type="text" class="form-control" id="data_donasi" name="data_donasi" value="<?= set_value("data_donasi", $dataEventEdit["data_donasi"]); ?>">
              <?= form_error('data_donasi', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="<?= base_url("admin"); ?>" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Summernote script -->
<script>
  $('#summernote').summernote({
    tabsize: 5,
    height: 100
  });

  $('.selectpicker').selectpicker();
</script>