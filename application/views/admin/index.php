<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $menu_; ?></h1>
  <div class="row">
    <div class="col-lg-10 overflow-auto">
      <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('lokasi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('tanggal', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('waktu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('deskripsi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('data_donasi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata("message"); ?>
      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newEventModal">Add New Event</a>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Pembuat</th>
            <th scope="col">Active</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="scroll-table-y">
          <?php $i = 1;
          foreach ($event as $e) :
            if ($e["maker"] != "admin") {
              $class = 'class="font-weight-bold table-info"';
            } else {
              $class = '';
            }
            ?>
            <tr <?= $class; ?>>
              <th scope="row"><?= $i; ?></th>
              <td>
                <img class="img-profile rounded-circle ml-1" src="<?= base_url("assets/img/event/") . $e["image"]; ?>" style="width:25px; height:25px">
              </td>
              <td><?= $e["nama"]; ?></td>
              <td><?= $e["tanggal"]; ?></td>
              <td><?= $e["maker"]; ?></td>
              <td>
                <div class="custom-control custom-switch ml-2">
                  <?php if ($e["is_active"] == 1) {
                      $checked = "checked='checked'";
                    } else {
                      $checked = "";
                    } ?>
                  <input type="checkbox" class="custom-control-input" id="customSwitch<?= $i; ?>" <?= $checked; ?> data-event="<?= $e["id"]; ?>">
                  <label class="custom-control-label" for="customSwitch<?= $i; ?>"></label>
                </div>
              </td>
              <td>
                <a href="<?= base_url("admin/pesertaevent/") . $e["id"]; ?>" class="badge badge-info">Peserta</a>
                <a href="<?= base_url("admin/editevent/") . $e["id"]; ?>" class="badge badge-success">Edit</a>
                <a href="<?= base_url("admin/deleteevent/") . $e["id"]; ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete this account?')">Delete</a>
              </td>
            </tr>
          <?php $i++;
          endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal add data -->
<div class="modal fade" id="newEventModal" tabindex="-1" role="dialog" aria-labelledby="newEventModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1200px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEventModalLabel">Add New Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart("admin"); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">

            <div class="form-group row">
              <div class="col-sm-3">
                <img src="<?= base_url("assets/img/event/") . "default.jpg"; ?>" class="img-thumbnail">
              </div>
              <div class="col-sm-9">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                  <label for="image" class="custom-file-label">Choose file</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama kegiatan" value="<?= set_value('nama'); ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi kegiatan" value="<?= set_value('lokasi'); ?>">
            </div>
            <div class="md-form">
              <input type="text" class="form-control datepicker mb-3" id="tanggal" name="tanggal" placeholder="Tanggal kegiatan" value="<?= set_value('tanggal'); ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="waktu" name="waktu" placeholder="Jam pelaksanaan" value="<?= set_value('waktu'); ?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="deskripsi">Deskripsi :</label>
              <textarea class="form-control" rows="3" id="deskripsi" name="deskripsi"><?= set_value('deskripsi'); ?></textarea>
            </div>
            <div class="form-group">
              <label for="data_donasi">Data donasi :</label>
              <input type="text" class="form-control" id="data_donasi" name="data_donasi" placeholder="123xxxxx a/n Nama | BCA" value="<?= set_value('data_donasi'); ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(".custom-control-input").on("click", function() {
    const id = $(this).data("event");

    $.ajax({
      url: "<?= base_url("admin/changeactivationevent"); ?>",
      type: "post",
      data: {
        id: id
      },
      success: function() {
        document.location.href = "<?= base_url("admin"); ?>";
      }
    });
  });
</script>